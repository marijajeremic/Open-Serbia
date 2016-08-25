<?php


$message = new Message();
$messages = $message->getOutboxMsg($_SESSION['id']);
$user = new User();
$users = $user->getUsers();
include __DIR__ . '/../views/outbox.php';