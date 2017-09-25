<?php

editUserData($_POST['FirstName'], $_POST['SecondName'], $_POST['Sex'], $_POST['City'], $_POST['Job']);

if (strpos($_POST['imageBase64'] , 'data:') !== false) {
    $decode = str_replace(' ', '+',  $_POST['imageBase64']);
    setAvatarPhoto($decode );
}


echo '{"status" : "ok"}';
