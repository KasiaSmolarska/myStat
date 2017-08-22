<?php

function dbQuery($query){
    $connect = mysqli_connect("localhost", "root", "", "my_stats");
    mysqli_query($connect, "SET NAMES utf8");
    $result = mysqli_query($connect, $query);

    if ($result === false) {
        echo "Błąd wykonywania zapytanie : " . mysqli_error($connect);
        return $result;
    }

    if ($result === true) {
        return $result;
    }

    $mapper = [];

    while ($row=mysqli_fetch_assoc($result)) {
        $mapper[] = $row;
    }
    return $mapper;
}
