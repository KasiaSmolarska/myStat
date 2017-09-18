<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#0296dc">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,700,700i,900&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="templates/css/index.css">
    <script src="templates/js/ejs.min.js"></script>
    <script src="templates/js/ajax.js"></script>
    <script src="templates/js/message.js"></script>


    <?php $ejsTemplates = ["taskTemplate", "modalTemplate", "modalConfirm", "modalAlert", "addNewTask", "editTaskTemplate", "userData", "editUserData", "taskTile", "noResultFound"] ?>

    <?php foreach ($ejsTemplates as $templateName) : ?>
        <noscript id="<?php echo $templateName ?>">
        <?php include 'templates/ejs/'.$templateName.'.ejs' ?>
        </noscript>

    <?php endforeach ?>

</head>
<body>
    <?php include 'templates/elements/staticElements.html'; ?>
    <div class="layoutPanel">
        <aside class="layoutPanel__aside aside">
           <a class="aside__item" href="index.php">
               <span class="aside__icon"><i class="mdi mdi-home"></i></span> <span class="aside__name">Strona główna</span>
           </a>
           <a class="aside__item" href="index.php?page=UserData">
               <span class="aside__icon"><i class="mdi mdi-account"></i></span> <span class="aside__name">Profil użytkownika</span>
           </a>
           <a class="aside__item" href="index.php?page=tasks">
               <span class="aside__icon"><i class="mdi mdi-format-list-checks"></i></span> <span class="aside__name">Lista zadań</span>
           </a>
        </aside>
        <div class="layoutPanel__content">
            <div class="layoutPanel__container">
                <?php include 'templates/subpages/' . $htmlTemplate . '.html'?>
                <div class="message">
                    <div class="message__content">
                        <span class="message__close">
                            <i class="mdi mdi-window-close"></i>
                        </span>
                        <div class="message__icon"><i style="font-size:22px; "class="mdi mdi-alarm-light"></i></div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>