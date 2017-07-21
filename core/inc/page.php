<?php
    require_once 'inc/common.php';

    class Page {
        function __construct($config) {
            if (! is_array($config))
                throw new Exception('В конструктор new Page() нужно передать массив');

            if (! array_key_exists('layout', $config))
                throw new Exception('В параметрах страницы должен быть ключ layout');

            $config = replace_html_values_in_array($config);        

            $this->layout = $config['layout'];
            if (! is_array($this->layout))
                $this->layout = [$this->layout];

            set_default_value($config, 'main_menu', []);
            set_default_value($config, 'parallels_menu', []);
            $this->main_menu = $config['main_menu'];
            $this->parallels_menu = $config['parallels_menu'];

            // TODO: default page title
            $this->title = array_key_exists('title', $config) ? $config['title'] : 'ЛКШ 2017';
            $this->assets_base_url = array_key_exists('assets_base_url', $config) ? $config['assets_base_url'] : ASSETS_BASE_URL;
        }

        public function render() {
            $menu = $this->render_main_menu() . $this->render_parallels_menu();
            $content = $this->render_content();
            return template('page.php', [
                'title.html' => $this->title,
                'menu.html' => $menu,
                'content.html' => $content,
                'assets_base_url' => $this->assets_base_url,
            ]);
        }

        private function render_content() {
            $rendered_content = '';

            foreach ($this->layout as $row) {
                if (is_array($row)) {
                    if (sizeof($row) != 2)
                        throw new Exception('Если в разметке страницы (параметр layout) вы определяете столбцы, то в каждой строке должно быть ровно два столбца');

                    $rendered_content .= $this->render_row($row[0], $row[1]);
                } elseif (is_subclass_of($row, 'Block')) {
                    $block = $row;
                    $rendered_content .= $block->render();
                } else {
                    throw new Exception('В разметке страницы (параметр layout) могут быть только блоки и массивы, состояющие из двух блоков');
                }
            }

            return $rendered_content;
        }

        private function render_row($first_column, $second_column) {
            $rendered_first_column = $this->render_column($first_column);
            $rendered_second_column = $this->render_column($second_column);
            return template('row.php', [
                'first_column.html' => $rendered_first_column,
                'second_column.html' => $rendered_second_column,
            ]);
        }

        private function render_column($blocks) {
            if (is_array($blocks)) {
                $rendered_content = '';
                foreach ($blocks as $block) {
                    if (! is_subclass_of($block, 'Block'))
                        throw new Exception('В разметке страницы (параметр layout), в каждой колонке могут быть только блоки (наследники класса Block)');
                    $rendered_content .= $block->render();
                }
                return $rendered_content;
            }

            /* Otherwise $blocks is just one block. Let's check that */
            $block = $blocks;
            if (! is_subclass_of($block, 'Block'))
                throw new Exception('В разметке страницы (параметр layout), в каждой колонке могут быть только блоки (наследники класса Block)');
            
            return $block->render();
        }

        private function render_main_menu() {
            if ($this->main_menu == null)
                return '';

            set_default_value($this->main_menu, 'current', '');
            set_default_value($this->main_menu, 'current_is_link', false);
            return template('menu.php', [
                'links' => [
                    'study' => ['html' => 'Учёба', 'link' => '/'],
                    'events' => ['html' => '<span class="hidden-on-small-menu">Спецкурсы</span><span class="visible-on-small-menu">С/к</span> и клубы</a>', 'link' => '/events/'],
                    'tournaments' => ['html' => '<span class="hidden-on-small-menu">Спорт и турниры</span><span class="visible-on-small-menu">Турниры</span>', 'link' => '/tournaments/'],
                ],
                'class' => 'main-menu',
                'current' => $this->main_menu['current'],
                'current_is_link' => $this->main_menu['current_is_link'],
                'put_empty_link_tag_for_current' => true,
            ]);
        }

        private function render_parallels_menu() {
            if ($this->parallels_menu == null)
                return '';

            set_default_value($this->parallels_menu, 'current', '');
            set_default_value($this->parallels_menu, 'current_is_link', false);
            return template('menu.php', [
                'links' => [
                    'A' => ['html' => 'A', 'link' => '/A/'],
                    'A\'' => ['html' => 'A\'', 'link' => '/A\'/'],
                    'B' => ['html' => 'B', 'link' => '/B/'],
                    'B\'' => ['html' => 'B\'', 'link' => '/B\'/'],
                    'C.py' => ['html' => 'C.py', 'link' => '/C.py/'],
                    'C.cpp' => ['html' => 'C.cpp', 'link' => '/C.cpp/'],
                    'P' => ['html' => 'P', 'link' => '/P/'],
                ],
                'additional_element.html' => '<li class="parallels-menu-image"><img src="assets/images/parallels-menu.png" /></li>',
                'prefix.html' => '<span class="parallel-name">',
                'postfix.html' => '</span>',
                'class' => 'parallels-menu',
                'current' => $this->parallels_menu['current'],
                'current_is_link' => $this->parallels_menu['current_is_link'],
                'put_empty_link_tag_for_current' => false,
            ]);
        }
    }