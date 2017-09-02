<?php

function getTask(){
    return dbQuery("SELECT * FROM task_list WHERE User_id = '" . getLoginId() . "' ORDER BY Date ASC");
}

function addTask($title,$status,$group){
   
   $userID = getLoginId();
   if ($userID === -1) {
       return ['Status' => 'Error', 'Description' => 'Nie jesteś zalogowany!'];
   }
   if ($status > 3 && $status < 0) {
       return ['Status' => 'Error', 'Description' => 'Status może mieć wartość z zakresu 0-3, przekazano :'. $status];
   }
   if (strlen($title) < 5) {
       return ['Status' => 'Error', 'Description' => 'Tytuł musi mieć więcej niż 4 znaki, obecnie ma: '. strlen($title)];
    }
    $allowedGroup = ['Bugs' => 1, 'Website' => 2, 'Server' => 3, 'Other' => 4];
   if (!isset($allowedGroup[$group])) {
       return ['Status' => 'Error', 'Description' => 'Wybrano grupę spoza zakresu '];
    }
     dbQuery("INSERT INTO `task_list` (`ID`,`User_id`, `Title`, `Description`, `Date`, `Status`, `Groups`) VALUES (NULL, '$userID', '$title', '', NOW(), '$status', '$group');");
     return ['Status' => 'OK', 'Description' => 'Wszystko OK'];
}

function removeTask($id){
    $userID = getLoginId();
    return dbQuery("DELETE FROM task_list WHERE id = '$id' AND User_id = '$userID'");
}

function editTask($id, $title, $status, $groups){
    $userID = getLoginId();
    return dbQuery("UPDATE task_list SET Title='$title', Status='$status', Groups='$groups' WHERE id = '$id' AND User_id = '$userID'");
}