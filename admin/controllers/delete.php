<?php


$action = filter_input(INPUT_GET, 'action');


if($action == 'delete_user'){
    $user = new User();
    $u = $user->deleteUser($_GET['user_id']);
    header('Location: home.php?page=users');
}elseif($action == 'location'){
    $location = new Location();
    $l = $location->deleteLocation($_GET['location_id']);
}elseif($action == 'post'){
    $post = new Post();
    $p = $post->deletePost($_GET['post_id']);
}elseif($action == 'category'){
    $categ= new Location();
    $category=$categ->deleteCategory($_GET['category_id']);

}elseif($action == 'block_user'){
    $user = new Admin();
    $users=$user->blockUser($_GET['user_id']);
    header('Location: home.php?page=users');
}elseif($action == 'unblock_user'){
    $user = new Admin();
    $users=$user->unblockUser($_GET['user_id']);
    header('Location: home.php?page=users');
}elseif($action == 'comm_delete'){
    $comm= new Comments();
    $comment = $comm->deleteComm($_GET['com_id']);
    header('Location: home.php?page=comments' );
}elseif($action == 'delete_post'){
    $posts=new Post();
    $post=$posts->deletePostForever($_GET['post_id']);
    header('Location: home.php?page=deletedposts' );
}