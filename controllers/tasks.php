<?php

function getTask(){
    return dbQuery("SELECT * FROM task_list");
}