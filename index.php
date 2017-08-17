<?php

if (count($_GET) == 0 ) {
   include 'templates/index.php';
} else {
   include 'engine/database.php';
   include 'controllers/tasks.php';
   include 'actions/getTasks.php';
}