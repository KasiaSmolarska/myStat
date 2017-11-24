<?php

$status = addOverTime($_POST['description'], $_POST['client'], $_POST['day'], $_POST['timeFrom'], $_POST['timeTo'], $_POST['weekend']);

echo json_encode($status);