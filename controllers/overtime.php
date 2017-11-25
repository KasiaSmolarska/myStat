<?php 

function addOvertime($description, $client, $day, $timeFrom, $timeTo, $weekend) {

    $userID = getLoginId();

    if ($userID === -1) {
        return ['error' => 'nie jestes zalogowany'];
    }

    if (strlen($description) < 10) {
        return ['error' => 'wpisałeś zbyt krótki opis, podaj opis, który ma co najmniej 10 znaków'];
    }

    if ($weekend != 0 && $weekend != 1) {
        return ['error' => 'nieprawidłowa wartość pola "weekend"'];
    }

    dbQuery("INSERT INTO `overtime` (`ID`, `User_id`, `Description`, `Client`, `Day`, `Time_from`, `Time_to`, `Weekend`) VALUES (NULL, '$userID', '$description', '$client', '$day', '$timeFrom', '$timeTo', '$weekend');");
    
    echo ($timeFrom);
    return ['status' => 'ok'];
}

function getOvertimeMonth($month, $year){

}

function deleteOvertime($id){

}

function editOvertime($id, $description, $client, $day, $timeFrom, $timeTo, $weekend){

}