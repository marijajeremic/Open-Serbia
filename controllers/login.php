<?php

$errorArray = [];
$messageArray = [];

if (false === empty($_SESSION['isLogged'])) {

}

if(isset($_POST['email']) && isset($_POST['password'])) {
    $user1 = new User();
    $password = md5($_POST['password'] . 'toNeMozeteProvaliti');
    $res = $user1->getUserByEmal($_POST['email']);

   if($res['status'] == 0) {

    if (false === empty($res) ) {
        if ($password === $res['password']) {
            unset($res['password']);

            $_SESSION = $res;
        

            $_SESSION['isLogged'] = true;

            $users = new User();
            $user=$users->updateUserStatusOnline($_SESSION['id']);
            header('Location: index.php?page=profile');

            return;
        } else {
            $errorArray['password'] = 'Lozinka nije tacna.';
        }
    } else {
        $errorArray['email'] = "Email {$_POST['email']} nije pronadjen";
    }
}else{
       echo "Vas profil je blokiran ili obrisan.Proverite sa adminima vas status.";
   }
}

if (false === empty($_GET['registered'])) {
    $messageArray['registered'] = 'Uspesno ste se registrovali.';
}

if (false === empty($_GET['logout'])) {
    $messageArray['logout'] = 'Uspesno ste se izlogovali.';
}

include __DIR__ . '/../views/login.php';
