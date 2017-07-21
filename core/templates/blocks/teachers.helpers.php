<?php
    function print_teacher($teacher, $assets_base_url) {
        ?>
        <div class="teachers__teacher">
            <img src="<?= $assets_base_url ?>/images/teachers/<?= $teacher['image'] ?>" title="<?= $teacher['name'] ?>" class="avatar" />

            <div class="teachers__teacher__name"><?= $teacher['name'] ?></div>

            <?php
                foreach ($teacher['info'] as $info) {
                    ?>
                    <div class="teachers__teacher__info">
                        <?= $info ?>
                    </div>
                    <?php
                }
            ?>

            <div class="teachers__teacher__social">
                <?php 
                    foreach ($teacher['social'] as $social) {
                        ?>
                        <a href="<?= $social['url'] ?>">
                            <img src="<?= $assets_base_url ?>/images/social/<?= $social['type'] ?>.png" title="<?= $social['title'] ?>">
                        </a>                        
                        <?php
                    }
                ?>
            </div>
        </div>

        <?php
    }
