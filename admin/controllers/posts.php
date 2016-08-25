<?php

$post = new Admin();
$pos = $post->getAllPostsAdminPage();
$user = new User();
$category = new Location();





include __DIR__ . '../../views/posts.php';


