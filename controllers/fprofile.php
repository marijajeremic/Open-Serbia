<?php

$users = new User();
$user = $users->getUserById($_GET['id']);
$post= new Post();
$posts=$post->getPostsByUserId($_GET['id']);


include __DIR__ . '/../views/fprofile.php';