<?php

editUserData($_POST['FirstName'], $_POST['SecondName'], $_POST['Sex'], $_POST['City'], $_POST['Job']);
echo '{"status" : "ok"}';
