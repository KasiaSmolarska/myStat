<?php

$tasks = getTask($_POST['sort'], $_POST['sortDir'], $_POST['filterStatus'], $_POST['filterGroup'], $_POST['filterDateFrom'], $_POST['filterDateTo'], $_POST['searcher']);
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
