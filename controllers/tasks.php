<?php

function getTask($sort, $sortDir){
    return dbQuery("SELECT * FROM task_list WHERE User_id = '" . getLoginId() . "' ORDER BY `$sort` $sortDir");
}

function addTask($title,$status,$group){
   
   $userID = getLoginId();
   if ($userID === -1) {
       return ['Status' => 'Error', 'Description' => 'Nie jesteś zalogowany!'];
   }
   if ($status > 3 && $status < 0) {
       return ['Status' => 'Error', 'Description' => 'Status zadania może mieć wartość z zakresu 0-3, przekazano :'. $status];
   }
   if (strlen($title) < 5) {
       return ['Status' => 'Error', 'Description' => 'Tytuł zadania musi mieć więcej niż 4 znaki, obecnie ma: '. strlen($title)];
    }
    $allowedGroup = ['Bugs' => 1, 'Website' => 2, 'Server' => 3, 'Other' => 4];
   if (!isset($allowedGroup[$group])) {
       return ['Status' => 'Error', 'Description' => 'Wybrano grupę spoza zakresu! '];
    }
     dbQuery("INSERT INTO `task_list` (`ID`,`User_id`, `Title`, `Description`, `Date`, `Status`, `Groups`) VALUES (NULL, '$userID', '$title', '', NOW(), '$status', '$group');");
     return ['Status' => 'OK', 'Description' => 'Nowe zadanie zostało dodane do grupy: ' . $group];
}

function removeTask($id){
    $userID = getLoginId();
    return dbQuery("DELETE FROM task_list WHERE id = '$id' AND User_id = '$userID'");
}

function editTask($id, $title, $status, $groups){
    $userID = getLoginId();
    return dbQuery("UPDATE task_list SET Title='$title', Status='$status', Groups='$groups' WHERE id = '$id' AND User_id = '$userID'");
}

function getTasksStatistic(){
    $userID = getLoginId();
    $taskSummary = dbQuery("SELECT COUNT(*) AS 'TaskSummary' FROM `task_list` WHERE `User_id` = '$userID'");
    $taskSummary =  $taskSummary[0]['TaskSummary'];
    $taskDone = dbQuery("SELECT COUNT(*) AS 'taskDone' FROM `task_list` WHERE `User_id` = '$userID' AND (`Status` = 1 OR `Status` = 3)");
    $taskDone = $taskDone[0]['taskDone'];
    $taskUndone = $taskSummary - $taskDone;

    $procentage = getTaskPercentage($taskSummary, $taskDone, $taskUndone);
    return ['taskSummary' => $taskSummary, 'taskDone' => $taskDone, 'taskUndone' => $taskUndone, 'procentage' => $procentage];
}

function getTaskPercentage($taskSummary, $taskDone, $taskUndone){
    $done = round($taskDone / $taskSummary * 100, 2) . '%';
    $undone = round($taskUndone / $taskSummary * 100, 2) . '%';

    return [ 'done' => $done, 'undone' => $undone];
}

function getFiveLastTasksByGroup($groupName){
    return dbQuery("SELECT * FROM task_list WHERE User_id = '" . getLoginId() . "' and Groups = '". $groupName . "' ORDER BY Date DESC LIMIT 5");
}