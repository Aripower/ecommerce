<?php

function existEmail($pdo, $email){
	$max = $pdo->prepare(" SELECT 1 FROM users where email = :email");
    $max->bindParam(':email', $email);
    $max->execute();
    $exist = (int) $max->fetch();
    return $exist;
}

function isAdmin($pass) {
   
 	if(password_verify('administrador', $pass) || password_verify('administrador@gmail.com', $pass)  ){
        return true;
    }

    return false;
}

?>