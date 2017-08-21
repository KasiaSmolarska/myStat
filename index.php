<?php

if (count($_GET) == 0 ) {
   header('Content-Type: text/html; charset=utf-8');
   include 'templates/index.php';
} else {
   header('Content-Type: application/javascript; charset=utf-8');
   if(!isset($_GET['action'])){
       echo '{"error" : "jakiś błąd - nie podałeś akcji!"}';
       exit;
   }
   include 'engine/database.php';
   include 'controllers/tasks.php';
   include 'actions/' . $_GET['action'] . '.php';
}