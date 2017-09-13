<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#0296dc">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,300i,400,400i,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="templates/css/index.css">
    <script src="templates/js/ejs.min.js"></script>
    <script src="templates/js/ajax.js"></script>
    <script src="templates/js/message.js"></script>



    <?php $ejsTemplates = ["taskTemplate", "modalTemplate", "modalConfirm", "modalAlert", "addNewTask", "editTaskTemplate", "userData", "editUserData"] ?>

    <?php foreach ($ejsTemplates as $templateName) : ?>
        <noscript id="<?php echo $templateName ?>">
        <?php include 'templates/ejs/'.$templateName.'.ejs' ?>
        </noscript>

    <?php endforeach ?>

</head>
<body>
    <?php include 'templates/subpages/' . $htmlTemplate . '.html'?>

    <div class="message">
    <div class="message__content">
        <div class="message__icon"><i style="font-size:22px; "class="mdi mdi-alarm-light"></i></div>
    </div>
</div>
</body>
</html>