<?php

$status = addTask($_POST['title'], $_POST['status'], $_POST['group']);

echo json_encode($status);