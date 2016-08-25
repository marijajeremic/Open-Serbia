<?php
$comm = new Admin();
$comment= $comm->getAllComments();



include __DIR__ . '../../views/comments.php';