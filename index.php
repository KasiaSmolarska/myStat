<?php

session_start();
if (count($_GET) == 0 ) {
   header('Content-Type: text/html; charset=utf-8');
   $htmlTemplate = 'index';
   include 'templates/templates.php';
   //include 'templates/index.html';
   
} else if (isset($_GET['page'])) {
   
   header('Content-Type: text/html; charset=utf-8');
   $htmlTemplate = $_GET['page'];
   include 'templates/templates.php';
   //include 'templates/' . $_GET['page'] .'.html';
} else {
 
   header('Content-Type: application/javascript; charset=utf-8');
   if(!isset($_GET['action'])){
       echo '{"error" : "jakiś błąd - nie podałeś akcji!"}';
       exit;
   }
   if (!file_exists('actions/' . $_GET['action'] . '.php')) {
       echo '{"error" : "podałeś akcję, lecz ona nie istnieje!"}';
       exit;
   }
   include 'engine/database.php';
   include 'controllers/tasks.php';
   include 'controllers/account.php';
   include 'actions/' . $_GET['action'] . '.php';
}