<?php

if (!empty($_POST)) {



    if (isset($_POST['send'])) {


        $name = $_POST['name'];
        $email=$_POST['email'];
        $title = $_POST['title'];
        $content = $_POST['content'];



        $msg = new Message();

        if ($msg->sendMessagetoAdmin($name, $email,$title, $content)) {
            echo "Hvala sto ste nas kontaktirali.";
        } else {
            echo "Neuspesno .";
        }


    }
}


include __DIR__ . '/../views/contact.php';