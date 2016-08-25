<?php

if (empty($_SESSION['isLogged'])) {
    echo json_encode(['success' => false]);

    return;
}

$user = new User();

$userData = $user->getUserById($_SESSION['id']);

$data = [
    'success' => true,
    'blocked' => (bool) $userData['is_blocked']
];

if ($data['blocked']) {
    session_destroy();
}

echo json_encode($data);