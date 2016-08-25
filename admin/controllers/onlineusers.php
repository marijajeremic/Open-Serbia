<?php
$users= new Admin();
$user=$users->getOnlineUsers();
include __DIR__ . '../../views/onlineusers.php';