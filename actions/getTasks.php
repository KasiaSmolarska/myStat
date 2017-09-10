<?php

$tasks = getTask($_POST['sort'], $_POST['sortDir']);
/* $mappedTasks = [];

foreach ($tasks as $task) {
    $currentGroup = $task['Groups'];
    if(isset($mappedTasks[$currentGroup]) === false){
        $mappedTasks[$currentGroup] = [];
    }
    $mappedTasks[$currentGroup][] = $task;
}
*/



echo json_encode($tasks);
