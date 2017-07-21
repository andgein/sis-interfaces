<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?></title>

    <link href="<?= $assets_base_url ?>/css/reset.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/fonts.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/common.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/tables.css" rel="stylesheet">

    <link href="<?= $assets_base_url ?>/css/schedule.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/links.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/teachers.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/events.css" rel="stylesheet">
    <link href="<?= $assets_base_url ?>/css/lessons.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <?= $menu ?>
    </header>
    
    <main>
        <?= $content ?>
    </main>
</body>
</html>
