<nav class="<?= $class ?>">
    <ul>
        <?php
            if (! isset($prefix))
                $prefix = '';
            if (! isset($postfix))
                $postfix = '';
            if (! isset($additional_element)) 
                $additional_element = '';

            print($additional_element);

            foreach ($links as $key => $link) {
                $is_current = $current == $key;
                print('<li' . ($is_current ? ' class="current"' : '') . '>');


                if (! $is_current || $current_is_link) {
                    $a_tag = '<a href="' . $link['link'] . '">';
                } elseif ($put_empty_link_tag_for_current) {
                    $a_tag = '<a>';
                } else {
                    $a_tag = '';
                }

                print($a_tag . $prefix . $link['html'] . $postfix . ($a_tag != '' ? '</a>' : ''));
                print('</li>');
            }
        ?>
    </ul>
</nav>
