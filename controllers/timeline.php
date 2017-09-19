<?php

function getTimeline(){

   return dbQuery("SELECT * FROM timeline");
}