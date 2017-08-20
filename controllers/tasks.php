<?php

function getTask(){
    return dbQuery("SELECT * FROM task_list");
}

function addTask($title,$status,$group){
   
   if ($status !== 1 || $status !== 0) {
       return;
   }
   if (count($title) < 5) {
       return;
    }
    $allowedGroup = ['Bugs' => 1, 'Website' => 2, 'Server' => 3, 'Other' => 4];
   if (!isset($allowedGroup[$group])) {
       return;
    }
     dbQuery("INSERT INTO `task_list` (`ID`, `Title`, `Description`, `Date`, `Status`, `Groups`) VALUES (NULL, '$title', '', NOW(), '$status', '$group');");
}