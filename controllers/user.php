<?php

function getUserData(){
     $userData =  dbQuery("SELECT * FROM users WHERE ID = '" . getLoginId() . "'");

     return $userData;
}
