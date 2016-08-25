<?php

$post = new Post();
$posts=$post->getAllDeletedPosts();

$user = new User();
$category = new Location();

include __DIR__ . '../../views/deletedposts.php';