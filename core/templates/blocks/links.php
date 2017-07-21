<?php
    require_once 'inc/common.php';
    require_once 'templates/blocks/links.helpers.php';
?>
                
<section class="links">

    <div class="section__title"><?= $title ?></div>

    <div class="section__body">
        <ul class="links-tree">
            <?php print_links_tree($links) ?>
        </ul>
    </div>
</section>
