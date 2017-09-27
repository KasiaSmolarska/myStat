<?php

$status = addNewTimelineNote($_POST['title'], $_POST['description'], $_POST['date']);

echo json_encode($status);