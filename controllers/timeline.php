<?php

function getTimeline(){
    
    $userID = getLoginId();
    if ($userID === -1) {
        return ['Status' => 'Error', 'Description' => 'Nie jesteś zalogowany!'];
    }

   return dbQuery("SELECT * FROM timeline WHERE `UserId` = '$userID' ORDER BY Date DESC");
}


function addNewTimelineNote($title,$description,$date){

    if(file_exists('templates/timelineImages') === false){
        mkdir('templates/timelineImages');
    }
    
    $userID = getLoginId();
    if ($userID === -1) {
        return ['Status' => 'Error', 'Description' => 'Nie jesteś zalogowany!'];
    }
    if (strlen($title) < 5) {
        return ['Status' => 'Error', 'Description' => 'Tytuł notki musi mieć więcej niż 4 znaki, obecnie ma: '. strlen($title)];
     }

     if (strlen($description) < 21) {
        return ['Status' => 'Error', 'Description' => 'Opis nowej notki musi mieć więcej niż 20 znaków, obecnie ma: '. strlen($description)];
     }

      dbQuery("INSERT INTO `timeline` (`ID`, `UserId`, `Title`, `Description`, `Date`, `Image`) VALUES (NULL,'$userID', '$title', '$description', '$date', '$photo');");
      return ['Status' => 'OK', 'Description' => 'Nowe notka została dodana do tablicy timeline'];
 }