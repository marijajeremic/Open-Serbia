<?php
    $c = new Location();
    $category = $c->getCategory();

    $l = new Location();
    $location = $l->getLocation();
    $p = new Post();


if (!empty($_POST) && isset($_POST['submit'])) {
    if (!empty($_POST['category_id']) && !empty($_POST['id'])) {
        $post = $p->getPostsByIDCategoryAndPlace($_POST['category_id'], $_POST['id']);
    } elseif (!empty($_POST['category_id'])) {
        $post = $p->getPostsByCategory($_POST['category_id']);
    } elseif (!empty($_POST['id'])) {
        $post = $p->getPostsByPlace($_POST['id']);
    }
}else{
    $post = $p->getPosts();
}


$rating = new Rating();

$action = filter_input(INPUT_GET, 'action');

$rate = filter_input(INPUT_GET, 'rate');

$postId = filter_input(INPUT_GET, 'post_id');

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

            echo json_encode([
                'success' => true,
                'postId' => $postId,
                'rating' => $rating
            ]);

            return;
        }

    } else if (isAjaxCall()) {
        echo json_encode(['success' => false, 'message' => 'Vec ste ocenili.']);

        return;
    }
}



include __DIR__ . '/../views/home.php';