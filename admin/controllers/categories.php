<?php
$category = new Location();
$cat = $category->getCategory();

$action = filter_input(INPUT_GET, 'action');




include __DIR__ . '../../views/categories.php';