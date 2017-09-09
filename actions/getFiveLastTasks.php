<?php

$serverTasks = getFiveLastTasksByGroup('server');
$websiteTasks = getFiveLastTasksByGroup('website');
$bugsTasks = getFiveLastTasksByGroup('bugs');
$otherTasks = getFiveLastTasksByGroup('other');

$mappedTasks = ['Server' => $serverTasks,
                'Website' => $websiteTasks,
                'Bugs' => $bugsTasks,
                'Other' => $otherTasks];

echo json_encode($mappedTasks);