<?php
    require_once 'inc/common.php';
    require_once 'config/teachers.php';

    define('TOTAL_RESULTS_URL_TEMPLATE', '/stand.php?from=%FROM%&to=%TO%&title=%TITLE%');

    class Block {
        function __construct($config) {
            $this->config = $config;
        }

        function render() {
            ob_start();
            print('<pre>');
            print_r($this->config);
            print('</pre>');
            return ob_get_clean();
        }
    }

    class LessonsBlock extends Block {
        function __construct($config) {
            if (! is_array($config))
                throw new Exception('В конструктор new LinksBlock() нужно передать массив');

            $config = replace_html_values_in_array($config);

            if (! array_key_exists('lessons', $config))
                $config = ['lessons' => $config];

            set_default_value($config, 'title', 'Занятия');
            set_default_value($config, 'start_ejudge_contest', 0);

            if (! array_key_exists('total_results_url', $config)) {
                $url = TOTAL_RESULTS_URL_TEMPLATE;
                $url = str_replace('%FROM%', $config['start_ejudge_contest'], $url);
                $url = str_replace('%TO%', ((int) $config['start_ejudge_contest']) + 100, $url);
                $url = str_replace('%TITLE%', 'Таблица результатов параллели', $url);
                $config['total_results_url'] = $url;
            }

            $index = 0;
            foreach ($config['lessons'] as &$lesson) {
                $index++;

                if (! is_array($lesson))
                    $lesson = ['title' => $lesson];

                set_default_value($lesson, 'index', $index);
                $contest_id = $config['start_ejudge_contest'] + $index;
                set_default_value($lesson, 'contest_url', ejudge_contest_url($contest_id));
                set_default_value($lesson, 'results_url', ejudge_results_url($contest_id));
                set_default_value($lesson, 'statements_url', 'statements/' . $lesson['index'] . '.pdf');
                set_default_value($lesson, 'additional_links', []);

                $lesson = replace_html_values_in_array($lesson);

                if (! is_array($lesson['additional_links']))
                    throw new Exception('У урока в блоке LessonsBlock аттрибут additional_links должен быть массивом');

                $additional_links = [];
                foreach ($lesson['additional_links'] as $key => $value) {
                    if (! is_array($value))
                        $additional_links[] = ['title' => $key, 'link' => $value];
                    else
                        $additional_links[] = replace_html_values_in_array($value);
                }

                $lesson['additional_links'] = $additional_links;
            }

            parent::__construct($config);
        }

        function render() {
            return template('blocks/lessons.php', [
                'title' => $this->config['title'],
                'lessons' => $this->config['lessons'],
                'start_ejudge_contest' => $this->config['start_ejudge_contest'],
                'total_results_url' => $this->config['total_results_url'],
            ]);
        }
    }

    class LinksBlock extends Block {
        function __construct($config) {
            if (! is_array($config))
                throw new Exception('В конструктор new LinksBlock() нужно передать массив');

            $config = replace_html_values_in_array($config);

            if (array_key_exists('title', $config)) {
                if (! array_key_exists('links', $config)) 
                    throw new Exception('Конструктор new LinksBlock(): раз передали title, надо передать и links — массив со ссылками');
            } else {
                $config = [
                    'title' => 'Ссылки', 
                    'links' => $config,
                ];
            }     

            parent::__construct($config);
        }

        function render() {
            return template('blocks/links.php', [
                'title' => $this->config['title'],
                'links' => $this->config['links'],
            ]);
        }
    }

    class TeachersBlock extends Block {
        function __construct($config) {
            global $TEACHERS;

            if (! is_array($config))
                throw new Exception('В конструктор new TeachersBlock() нужно передать массив');

            if (! array_key_exists('teachers', $config))
                $config = ['teachers' => $config];
            set_default_value($config, 'title', 'Преподаватели');

            foreach ($config['teachers'] as &$teacher) {
                if (is_array($teacher)) {
                    $built_teacher = [];

                    if (array_key_exists('extend', $teacher)) {
                        $built_teacher = $TEACHERS[$teacher['extend']];
                        unset($teacher['extend']);
                    }

                    foreach ($teacher as $key => $value)
                        $built_teacher[$key] = $value;

                    $teacher = $built_teacher;
                } else {
                    $teacher = $TEACHERS[$teacher];
                }

                set_default_value($teacher, 'info', '');
                if (! is_array($teacher['info']))
                    $teacher['info'] = [$teacher['info']];

                set_default_value($teacher, 'name', 'Имя не определено');
                set_default_value($teacher, 'image', $teacher['name'] . '.jpg');

                set_default_value($teacher, 'social', []);
                if (! is_array($teacher['social']))
                    throw new Exception('У преподавателя список социальных ссылок (social) должен быть массивом');
                $built_social = [];
                foreach ($teacher['social'] as $type => $value)
                {
                    if (! in_array($type, array('vk', 'fb', 'telegram')))
                        throw new Exception('Неизвестный тип социальной ссылки у преподавателя: ' . $type);

                    if ($type == 'vk') $url = 'https://vk.com/' . (is_numeric($value) ? 'id' . $value : $value);
                    if ($type == 'fb') $url = 'https://facebook.com/' . $value;
                    if ($type == 'telegram') $url = 'https://t.me/' . $value;
                    $built_social[] = ['type' => $type, 'title' => $teacher['name'], 'url' => $url];
                }
                $teacher['social'] = $built_social;


            }

            parent::__construct($config);
        }

        function render() {
            return template('blocks/teachers.php', [
                'title' => $this->config['title'],
                'teachers' => $this->config['teachers'],
                'assets_base_url' => ASSETS_BASE_URL,
            ]);
        }
    }