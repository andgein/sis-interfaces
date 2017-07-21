<?php
    require_once 'inc/common.php';
    require_once 'templates/blocks/lessons.helpers.php';
?>
                
<section class="links">

    <div class="section__title">
        <?= $title ?>
        <?php
            if (isset($total_results_url) && $total_results_url) {
                ?>
                <div class="additional-info">
                    <a href="<?= $total_results_url ?>">Общие результаты</a>
                </div>
                <?php
            }
        ?>
    </div>

    <div class="section__body">
        <?php
            foreach (array_reverse($lessons) as $lesson) {
                print_lesson($lesson);
            }
        ?>
    </div>
</section>
