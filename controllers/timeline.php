<?php

function getTimeline(){

    if(file_exists('templates/timelineImages') === false){
        mkdir('templates/timelineImages');
    }

   return dbQuery("SELECT * FROM timeline");
}