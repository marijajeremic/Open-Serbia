<?php

$posts = new Post();

$action = filter_input(INPUT_GET, 'action');

$rate = filter_input(INPUT_GET, 'rate');

$postId = filter_input(INPUT_GET, 'post_id');


$pos = $posts->getPostById($_GET['post_id']);

$a= json_decode($pos['post_img'],true);
$comments = new Comments();


$comm=$comments->showPostComments($_GET['post_id']);

if($action == 'comment'){
    if( isset($_POST['send']) && !empty($_POST['content'])){


        $user_id = $_SESSION['id'];
        $content = $_POST['content'];
        $post_id = $_GET['post_id'];
        $comment=$comments->addComment($user_id,$content,$post_id);

    }
}

if($action == 'commentsc'){
    if( isset($_POST['submit']) && !empty($_POST['comment'])){
        $comment_id=$_GET['comment_id'];
        $user_id = $_SESSION['id'];
        $content = $_POST['comment'];
        $post_id = $_GET['post_id'];

        $comm = $comments->CommentComment($comment_id,$user_id,$content,$post_id);

    }
}


$rating = new Rating();


if ($action == 'rate') {
    if ($rate < 1) {
        $rate = 1;
    } else if ($rate > 5) {
        $rate = 5;
    }

    $result=$rating->getRatingByUserAndPost($postId,$_SESSION['id']);
    if(empty($result)) {

        $rating->ratePost($postId, (int)$rate, $_SESSION['id']);

        if (isAjaxCall()) {

            $r = new Rating();

            $rat = $r->viewRatingPost($postId);

            $totalRatingScore = 0;

            $totalRatings = count($rat);

            foreach ($rat as $value) {
                $totalRatingScore += $value['rating_post'];
            }

            $rating = 0;

            if ($totalRatings) {
                $rating = $totalRatingScore / $totalRatings;
            }

            echo $rating;

            return;
        }
    }
}








include __DIR__ . '/../views/readmore.php';