<!doctype html>
<html>
    <head>
        <!-- salvando a funcao directory -->
        <?php $home = get_template_directory_uri(); ?>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $home; ?>/reset.css">
        <link rel="stylesheet" type="text/css" href="<?= $home; ?>/style.css">

        <!-- chamando o menu admin quando tiver logado -->
        <?php wp_head(); ?>
    </head>
<body>