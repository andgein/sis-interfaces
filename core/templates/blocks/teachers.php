<?php
    require_once 'inc/common.php';
    require_once 'templates/blocks/teachers.helpers.php';
?>
                
<section class="teachers">

    <div class="section__title">
        <?= $title ?>
    </div>

    <div class="section__body">
        <?php
            foreach ($teachers as $teacher) {
                print_teacher($teacher, $assets_base_url);
            }
        ?>
    </div>
</section>
