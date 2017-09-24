<?php

function accountRegister($email,$password){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['Status' => 'Error', 'Description' => 'Przesłano niepoprawny adres email :'. $email];
    }  
    $hashPassword = md5($password);
    try {
        $email = trim( $email );
        $email = strtolower( $email ); 
        $hashEmail = md5( $email );
        $emailLink = "https://www.gravatar.com/avatar/$hashEmail?s=250";
         dbQuery("INSERT INTO `users`(`ID`, `Email`, `Password`, `FirstName`, `SecondName`, `Sex`, `City`, `Job`, `Avatar`, `RegisterDate`) VALUES (null, '$email', '$hashPassword', '','','0','','','$emailLink',NOW())");

    } catch(Exception $e){
        return ['Status' => 'Error', 'Description' => 'Nie udało się stworzyć konta, być może masz już konto założone na ten adres email'];
    }
    
    
    return ['Status' => 'OK', 'Description' => 'Brawo. Zostałeś zarejestrowany!'];
}

function accountLogin($email, $password){
    $hashPassword = md5($password);
    $user = dbQuery("SELECT ID , FirstName, SecondName, Avatar FROM users WHERE Email='$email' AND Password='$hashPassword'");

    if(count($user) === 0){
        return ['Status' => 'Error', 'Description' => 'Niepoprawne dane logowania'];
    }
    
    $_SESSION['id'] = $user[0]['ID'];
    $_SESSION['FirstName'] = $user[0]['FirstName'];
    $_SESSION['SecondName'] = $user[0]['SecondName'];
    $_SESSION['Avatar'] = $user[0]['Avatar'];

    return ['Status' => 'OK', 'Description' => 'Wszystko OK'];
}

function getLoginId(){
    return isset($_SESSION['id']) ? $_SESSION['id'] : -1;
}

function logOut(){
    session_destroy();
}

function getUserData(){
     $userData =  dbQuery("SELECT * FROM users WHERE ID = '" . getLoginId() . "'");

     return $userData;
}

function editUserData($FirstName, $SecondName, $Sex, $City, $Job){
    $userId = getLoginId();



    createAvatarWithLetter($FirstName[0], $userId);

    return dbQuery("UPDATE `users` SET `FirstName`= '$FirstName',`SecondName`= '$SecondName',`Sex`= $Sex,`City`= '$City',`Job`= '$Job' WHERE `ID`=$userId");
}

function setAvatarPhoto($base64){

    if(file_exists('templates/avatars') === false){
        mkdir('templates/avatars');
    }

    $data = $base64;
    $userId = getLoginId();
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    list(,$type) = explode('/', $type);
    $path='templates/avatars/' . $userId . '.' . $type;
    
    
    file_put_contents($path, $data);

    $path = addslashes($path);

    return dbQuery("UPDATE `users` SET Avatar = '$path' WHERE `ID`=$userId" );
}

function createAvatarWithLetter($letter, $ID){
    $imageWithLetter = imagecreate(250,250);

    $background = imagecolorallocate($imageWithLetter, rand ( 0 , 210 ),rand ( 0 , 210 ),rand ( 0 , 210 ));
    $letterColor = imagecolorallocate($imageWithLetter, 255,255,255);

    imagefilledrectangle($imageWithLetter,0,0,250,250, $background);

    $fontSize = 70;
    $fontPath = 'templates/tmp/Roboto-Bold.ttf';

    $sizeBox = imagettfbbox ( $fontSize , 0 , $fontPath , $letter );

    $width = $sizeBox[2];
    $height = $sizeBox[5];


    imagefttext ( $imageWithLetter , $fontSize , 0 , 125 - ($width/2) , 125 - ($height / 2), $letterColor , $fontPath , $letter );

    imagepng($imageWithLetter,'templates/avatars/letter'. $ID.'.png');
}