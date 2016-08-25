<?php

$user = new User();
$res = $user->getUsers();


include __DIR__ . '../../views/users.php';
