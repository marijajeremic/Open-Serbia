<?php

$user = new User();

$users = $user->getUsers();
include __DIR__ . '/../views/users.php';