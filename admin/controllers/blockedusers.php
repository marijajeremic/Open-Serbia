<?php
$users= new Admin();
$user=$users->getAllBlockedUsers();
include __DIR__ . '../../views/blockedusers.php';