<?php

function getTask(){
    return dbQuery("SELECT * FROM task_list");
}

function addTask($title,$status,$group){
   
   if ($status != 1 && $status != 0) {
       return ['Status' => 'Error', 'Description' => 'Status może mieć wartość 1 lub 0, przekazano :'. $status];
   }
   if (strlen($title) < 5) {
       return ['Status' => 'Error', 'Description' => 'Tytuł musi mieć więcej niż 4 znaki, obecnie ma: '. strlen($title)];
    }
    $allowedGroup = ['Bugs' => 1, 'Website' => 2, 'Server' => 3, 'Other' => 4];
   if (!isset($allowedGroup[$group])) {
       return ['Status' => 'Error', 'Description' => 'Wybrano grupę spoza zakresu '];
    }
     dbQuery("INSERT INTO `task_list` (`ID`, `Title`, `Description`, `Date`, `Status`, `Groups`) VALUES (NULL, '$title', '', NOW(), '$status', '$group');");
     return ['Status' => 'OK', 'Description' => 'Wszystko OK'];
}

function removeTask($id){
    return dbQuery("DELETE FROM task_list WHERE id = $id");
}

function editTask($id, $title, $status, $groups){
    return dbQuery("UPDATE task_list SET Title='$title', Status='$status', Groups='$groups' WHERE id=$id");
}