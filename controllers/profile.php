<?php
$user = new User();
$users = $user->getUsers();
if (!empty($_POST)) {
    $error = false;
    if ((($_FILES['file']['type']) == 'image/gif')
        || ($_FILES['file']['type'] == 'image/jpeg')
        || ($_FILES['file']['type'] == 'image/pjpeg')
        && ($_FILES['file']['size'] < 200000)
    ) {
        move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name']);
        if (!$error) {
            $user = new User();
            $image = $_FILES['file']['name'];
            $id = $_SESSION['id'];

            if ($user->addProfileImage($image,$id)) {
                header("Location: index.php?page=logout");

                return;
            }
        }
    }
}
include __DIR__ . '/../views/profile.php';