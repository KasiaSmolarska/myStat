<?php

if($htmlTemplate === 'login' ||  $htmlTemplate === 'register'){
    include 'templates/login-register.php';
} else{
    include 'templates/panel.php';
}