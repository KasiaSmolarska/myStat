<?php

editTask($_POST['id'], $_POST['title'], $_POST['status'], $_POST['groups']);
echo '{"status" : "ok"}';