<?php

function getTimeline(){

    if(file_exists('templates/timelineImages') === false){
        mkdir('templates/timelineImages');
    }

   return dbQuery("SELECT * FROM timeline ORDER BY Date DESC");
}


function addNewTimelineNote($title,$description,$date){
    
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

      dbQuery("INSERT INTO `timeline` (`ID`, `Title`, `Description`, `Date`, `Image`) VALUES (NULL, '$title', '$description', '$date', '$photo');");
      return ['Status' => 'OK', 'Description' => 'Nowe notka została dodana do tablicy timeline'];
 }