<?php

$posts = new Post();
$pos = $posts->getPostById($_GET['post_id']);

$comments = new Comments();

$a= json_decode($pos['post_img'],true);
$comm=$comments->showPostComments($_GET['post_id']);

include __DIR__ . '../../views/post.php';