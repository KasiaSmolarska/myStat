<?php

function accountRegister($email,$password){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['Status' => 'Error', 'Description' => 'Przesłano niepoprawny adres email :'. $email];
    }  
    $hashPassword = md5($password);
    try {
         dbQuery("INSERT INTO `users`(`ID`, `Email`, `Password`, `FirstName`, `SecondName`, `City`, `Avatar`, `RegisterDate`) VALUES (null, '$email', '$hashPassword', '','','','',NOW())");

    } catch(Exception $e){
        return ['Status' => 'Error', 'Description' => 'Nie udało się stworzyć konta, być może masz już konto założone na ten adres email'];
    }
   
    return ['Status' => 'OK', 'Description' => 'Brawo. Zostałeś zarejestrowany!'];
}

function accountLogin($email, $password){
    $hashPassword = md5($password);
    $user = dbQuery("SELECT ID , FirstName, SecondName FROM users WHERE Email='$email' AND Password='$hashPassword'");

    if(count($user) === 0){
        return ['Status' => 'Error', 'Description' => 'Niepoprawne dane logowania'];
    }
    
    $_SESSION['id'] = $user[0]['ID'];
    $_SESSION['FirstName'] = $user[0]['FirstName'];
    $_SESSION['SecondName'] = $user[0]['SecondName'];

    return ['Status' => 'OK', 'Description' => 'Wszystko OK'];
}

function getLoginId(){
    return isset($_SESSION['id']) ? $_SESSION['id'] : -1;
}

function logOut(){
    session_destroy();
}