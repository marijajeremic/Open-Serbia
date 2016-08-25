<?php
$u=new User();
$user=$u->getUserImages($_SESSION['id']);

if (!empty($_POST)) {

    $newImageNames = [];

             foreach ($_FILES['file']['name'] as $file => $name) {

                 if (substr($_FILES['file']['type'][$file], 0, 6) !== 'image/') {
                     continue;
                 }

                 $img_name = date('Ymd-His', time()) . mt_rand() . "-" . $name;

                 $newImageNames[] = $img_name;
                 $user_id = $_SESSION['id'];
                 if (move_uploaded_file($_FILES['file']['tmp_name'][$file], 'images/' . $img_name)) {
                     $img = new User();
                     $query = $img->addImages($img_name, $user_id);

                     header("Location: index.php?page=profile");
                 }

         }

  }










include __DIR__ . '/../views/galery.php';

