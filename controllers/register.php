<?php

if (!empty($_POST)) {
    $error = false;
    $errorArray = [];

    if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
        $error = true;
        $errorArray['name'] = 'Ime treba da ima minimum 3 katarktera';
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $errorArray['email'] = 'Email nije validan';
    }
    if (empty($_POST['password']) || strlen($_POST['password']) < 5) {
        $error = true;
        $errorArray['password'] = 'Password treba da ima minimum 5 katarktera';
    }
    if(empty($_FILES['file']['type'])){
        $image= 'img.jpg';
        $password = md5($_POST['password'] . 'toNeMozeteProvaliti');
        if (!$error) {
            $user = new User();


            if ($user->createUser($_POST['name'], $_POST['email'], $password, $image)) {
                header("Location: index.php?page=login&registered=1");

                return;
            }
        }

    }else {

        if (substr($_FILES['file']['type'], 0, 6) == 'image/') {
            if ((($_FILES['file']['type']) == 'image/gif')
                || ($_FILES['file']['type'] == 'image/png')
                || ($_FILES['file']['type'] == 'image/jpeg')
                || ($_FILES['file']['type'] == 'image/pjpeg')
                && ($_FILES['file']['size'] < 200000)
            ) {

                $name = $_FILES['file']['name'];
                $image = date('Ymd-His', time()) . mt_rand() . "-" . $name;

                move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $image);




            }
        }

        $password = md5($_POST['password'] . 'toNeMozeteProvaliti');
        if (!$error) {
            $user = new User();


            if ($user->createUser($_POST['name'], $_POST['email'], $password, $image)) {
                header("Location: index.php?page=login&registered=1");

                return;
            }
        }
    }
}


include __DIR__ . '/../views/register.php';