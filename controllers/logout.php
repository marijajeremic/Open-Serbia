<?php
$users= new User();

$user=$users->updateUserStatusOffline($_SESSION['id']);

session_destroy();

header('Location: index.php?page=login&logout=1');