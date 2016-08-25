<?php
$users= new Admin();
$user=$users->getOfflineUsers();
include __DIR__ . '../../views/offlineusers.php';