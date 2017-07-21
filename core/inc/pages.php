<?php
    require_once 'inc/common.php';
    require_once 'inc/page.php';

    class ParallelPage extends Page {
        function __construct($config) {
            if (! is_array($config))
                throw new Exception('В конструктор new ParallelPage() нужно передать массив');

            if (! array_key_exists('parallel', $config))
                throw new Exception('Отсутстует параметр parallel у ParallelPage');
            $parallel = $config['parallel'];

            set_default_value($config, 'teachers', []);
            set_default_value($config, 'links', []);
            set_default_value($config, 'lessons', []);
            set_default_value($config, 'start_ejudge_contest', 0);

            $first_column = [
                new LessonsBlock([
                    'lessons' => $config['lessons'],
                    'start_ejudge_contest' => $config['start_ejudge_contest'],
                    'title' => 'Занятия',
                ]),
                new LinksBlock($config['links']),
            ];
        
            $second_column = [
                new TeachersBlock(['title' => 'Преподаватели ' . $parallel, 'teachers' => $config['teachers']]),
            ];

            $parent_config = [
                'title' => 'Параллель ' . $parallel,
                'layout' => [
                    [$first_column, $second_column]
                ],
                'base_url' => '/' . $parallel . '/',
                'main_menu' => [
                    'current' => 'study',
                    'current_is_link' => true,
                ],
                'parallels_menu' => [
                    'current' => $parallel,
                ],
            ];

            parent::__construct($parent_config);
        }
    }