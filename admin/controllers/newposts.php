<?php

$post = new Post();
$pos = $post->getAllPostsNotApproved();

$user = new User();
$category = new Location();



include __DIR__ . '../../views/newposts.php';