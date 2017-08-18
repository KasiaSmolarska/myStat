<?php

function dbQuery($query){
    $connect = mysqli_connect("localhost", "root", "", "my_stats");
    mysqli_query($connect, "SET NAMES utf8");
    $result = mysqli_query($connect, $query);

    $mapper = [];

    while ($row=mysqli_fetch_assoc($result)) {
        $mapper[] = $row;
    }
    return $mapper;
}
