<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="templates/css/index.css">
    <script src="templates/js/ejs.min.js"></script>
    <script src="templates/js/ajax.js"></script>


    <?php $ejsTemplates = ["taskTemplate", "modalTemplate", "modalConfirm", "modalAlert", "addNewTask", "editTaskTemplate"] ?>

    <?php foreach ($ejsTemplates as $templateName) : ?>
        <noscript id="<?php echo $templateName ?>">
        <?php include 'templates/ejs/'.$templateName.'.ejs' ?>
        </noscript>

    <?php endforeach ?>

</head>
<body>
    <?php include 'templates/' . $htmlTemplate . '.html'?>
</body>
</html>