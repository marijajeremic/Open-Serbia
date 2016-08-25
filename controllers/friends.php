<?php


$user = new User();

$users = $user->getUsers();

$friends = new Friends();
$myfriends = $friends->friendList($_SESSION['id']);



$friendRequests = $friends->usersFriendsRequests($_SESSION['id']);

$action = filter_input(INPUT_GET, 'action');

if($action == 'addfriend'){
    $friend = $friends->sentFriendRequest($_SESSION['id'],$_GET['id']);

}elseif($action == 'accept'){
    $friend = $friends->acceptFriendRequest($_GET['id'],$_SESSION['id']);
   header('Location: index.php?page=friends');
}elseif($action == 'ignore'){
    $friend= $friends->ignoreFriendRequest($_GET['id']);
    header('Location: index.php?page=friends');
}

include __DIR__ . '/../views/friends.php';