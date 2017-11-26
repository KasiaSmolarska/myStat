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
    
    return ['status' => 'ok'];
}

function getOvertimeMonth($month, $year){

    $userID = getLoginId();
    
    if ($userID === -1) {
        return ['error' => 'nie jestes zalogowany'];
    }

    return dbQuery("SELECT `Description`, `Client`, `Day`, `Time_from`, `Time_to`, `Weekend` FROM `overtime` WHERE User_id = '$userID' AND Day >= '$year-$month-01' AND Day <= '$year-$month-31'");
}

function deleteOvertime($id){

}

function editOvertime($id, $description, $client, $day, $timeFrom, $timeTo, $weekend){

}