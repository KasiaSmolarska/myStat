<?php

if ($_POST['password'] === $_POST['repeatPassword']) {
   $status = accountRegister($_POST['email'], $_POST['password']);

   if($status['Status'] === 'OK'){
       accountLogin($_POST['email'], $_POST['password']);
   }
   
   
   echo json_encode($status);
}

else{
    echo '{"Status" : "Error", "Description" : "Podane hasła są różne"}';
}


