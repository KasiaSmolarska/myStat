<?php

$status = addOverTime($_POST['description'], $_POST['client'], $_POST['day'], $_POST['dateFrom'], $_POST['dateTo'], $_POST['weekend']);

echo json_encode($status);