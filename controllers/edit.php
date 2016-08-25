<?php
$c = new Location();
$category = $c->getCategory();
$l = new Location();
$location = $l->getLocation();




if($_GET['action'] == 'edit_post') {
    $posts = new Post();
    $post = $posts->getPostById($_GET['post_id']);

    if ($_SESSION['id'] == $post['user_id']) {
        if (isset($_POST['send'])) {

            $post_id = $post['post_id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $descript = $_POST['descript'];

            $user_id = $_SESSION['id'];
            $posts->editPost($title, $content, $descript, $post_id);

        }

    }
}


include __DIR__ . '/../views/edit.php';