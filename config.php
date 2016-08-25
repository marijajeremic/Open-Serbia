<?php
//ukljucujemo sve klase iz modela a config ukljucujemo u index.php kako bi svakoj strani bilo dostupno sve iz pomenutog modela
require_once 'models/Connect.php';
require_once 'models/Model.php';
require_once 'models/User.php';
require_once 'models/Post.php';
require_once 'models/Location.php';
require_once 'admin/models/Admin.php';
require_once 'models/Message.php';
require_once 'models/Friends.php';
require_once 'models/Comments.php';
require_once 'models/Rating.php';


 // Proverava da li je ajax poziv

function isAjaxCall()
{
    return (false === empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}




