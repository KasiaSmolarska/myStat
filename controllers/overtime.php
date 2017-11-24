<?php 

function addOvertime($description, $client, $day, $timeFrom, $timeTo, $weekend) {

    $userID = getLoginId();

    if ($userID === -1) {
        return ['error' => 'nie jestes zalogowanszy'];
    }

    dbQuery("INSERT INTO `overtime` (`ID`, `User_id`, `Description`, `Client`, `Day`, `Time_from`, `Time_to`, `Weekend`) VALUES (NULL, '$userID', '$description', '$client', '$day', '$timeFrom', '$timeTo', '$weekend');");
    
    return ['status' => 'ok'];
}

function getOvertimeMonth($month, $year){

}

function deleteOvertime($id){

}

function editOvertime($id, $description, $client, $day, $timeFrom, $timeTo, $weekend){

}