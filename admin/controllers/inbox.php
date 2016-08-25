<?php


$mess = new Message();
$message=$mess->getAdminMessages();
include __DIR__ . '../../views/inbox.php';