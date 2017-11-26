<?php

$data = getOvertimeMonth($_POST['month'], $_POST['year']);

echo json_encode($data);