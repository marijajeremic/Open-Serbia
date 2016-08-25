<?php

$message = new Message();
$messages = $message->getInboxMsg($_SESSION['id']);
$user = new User();
$users = $user->getUsers();

if (!empty($_POST)) {



    if (isset($_POST['send'])) {


        $sender_id = $_SESSION['id'];
        $reciever_id = $_POST['reciever'];
        $title = $_POST['title'];
        $content = $_POST['content'];



        $msg = new Message();

        if ($msg->sendMessage($sender_id, $reciever_id,$title, $content)) {
            echo "Uspesno ste poslali poruku.";
        } else {
            echo "Neuspesno .";
        }


    }
}



include __DIR__ . '/../views/inbox.php';