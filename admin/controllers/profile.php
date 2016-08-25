<?php

$users = new User();

$user= $users->getUserById($_GET['user_id']);

include __DIR__ . '../../views/profile.php';?>