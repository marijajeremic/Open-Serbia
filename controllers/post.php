<?php

$posts = new Post();
$post = $posts->getPostsByUserId($_SESSION['id']);

include __DIR__ . '/../views/post.php';