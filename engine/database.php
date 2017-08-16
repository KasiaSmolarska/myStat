<?php

$connect = mysqli_connect("localhost", "root", "", "my_stats");

$result = mysqli_query($connect, "SELECT * FROM task_list");
