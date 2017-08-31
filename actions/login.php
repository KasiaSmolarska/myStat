<?php

$status = accountLogin($_POST['email'], $_POST['password']);
   
echo json_encode($status);