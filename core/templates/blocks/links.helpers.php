<?php
    /* This function is magic. Be carefull */
    function print_links_tree($links) {
        if (! is_array($links))
            throw new Exception('Ссылки (links) имеют странную структуру в этом месте: ' . $links . '. Не смог разобраться, ожидал массив');

        foreach ($links as $key => $value) {
            print('<li>');

            if (is_array($value))
                $value = replace_html_values_in_array($value, ['html']);

            if (! is_numeric($key)) {
                if (! is_array($value))
                    $value = ['link' => $value];
                elseif (! array_key_exists('link', $value) && ! array_key_exists('links', $value))
                    $value = ['links' => $value];
                if (array_key_exists('title', $value))
                    throw new Exception('У ссылки не могут одновременно быть текстовый ключ и аттрибут title');

                $value['title'] = $key;
            } elseif (is_array($value)) {
                if (! array_key_exists('title', $value) && ! array_key_exists('html', $value))
                    throw new Exception('У ссылки нет аттрибутов title и html. Хотя бы один должен присутствовать');
            } else {
                throw new Exception('Ссылка не описана как массив, а ключ — не текстовый. Так нельзя');
            }
            
            if (array_key_exists('html', $value)) {
                print($value['html']);
            } elseif (array_key_exists('link', $value)) {
                print('<a href="' . $value['link'] . '">' . $value['title'] . '</a>');
            } else {
                print('<span class="list-title">' . $value['title'] . '</span>');
            }

            if (array_key_exists('links', $value)) {
                print('<ul>');
                print_links_tree($value['links']);
                print('</ul>');
            }            

            print('</li>');
        }
    }
