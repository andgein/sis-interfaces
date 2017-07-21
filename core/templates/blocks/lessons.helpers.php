<?php
    function print_lesson($lesson) {
        ?>
        <div class="lessons__lesson">
            <div class="lessons__lesson__title">
                <div class="lessons__lesson__index"><?= $lesson['index'] ?></div>
                <a href="<?= $lesson['statements_url'] ?>"><?= $lesson['title'] ?></a>
            </div>

            <div class="lessons__lesson__additional-info">
                <?php
                    if ($lesson['contest_url']) {
                        ?>
                        <a href="<?= $lesson['contest_url'] ?>">вход</a>
                        <?php
                    }
                ?>
                <?php
                    if ($lesson['results_url']) {
                        ?>
                        <a href="<?= $lesson['results_url'] ?>">результаты</a>
                        <?php
                    }
                ?>
            </div>

            <?php
                foreach ($lesson['additional_links'] as $link)
                {
                    ?>
                    <div class="lessons__lesson__additional-info">
                        <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
    }
