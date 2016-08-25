<?php

$action = filter_input(INPUT_GET, 'action');

switch ($action) {
    case 'get_all':
        $post = new Post();

        $posts = $post->getPosts();

        $returnPosts = [];

        foreach ($posts as $post) {
            $postImage = '';

            $postImages = json_decode($post['post_img'], true);

            if (false === empty($postImages[0])) {
                $postImage = $postImages[0];
            }

            $returnPosts[] = [
                'id' =>$post['post_id'],
                'lat' => $post['lat'],
                'lng' => $post['lon'],
                'image' => $postImage,
                'title' => trim($post['title'])
            ];
        }

        echo json_encode($returnPosts);

        return;
}

