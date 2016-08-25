<?php
session_start();
require_once '../config.php';




?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
</head>
<body>

<div id="wrapper">
<?php
    if($_SESSION['admin'] == 1) {
        $users = new User();
        $a = $users->getUserById($_SESSION['id']);
        ?>

        <div id="admin_header">
            <div id="logo">

            </div><!-- kraj #logo -->


            <div class="nav" id="admin_nav">
                <ul>

                    <li><a href="home.php?page=home">Pocetna</a></li>

                    <li><a href="home.php?page=categories">Kategorije</a></li>
                    <li><a href="home.php?page=locations">Lokacije</a></li>
                    <li><a href="home.php?page=users">Korisnici</a></li>
                    <li><a href="home.php?page=posts">Postovi</a></li>
                    <li><a href="home.php?page=comments">Komentari</a></li>
                    <li><a href="home.php?page=inbox">Poruke</a></li>
                    <li><a href="../index.php">Sajt</a></li>
                   

                </ul>
            </div><!-- kraj #nav -->


        </div><!-- kraj #headera -->

        <div class="content_admin">
            <div class="sidebar">
                <div class="nav">
                    <?php

                    echo "<img class='prof' src='../images/" . $a['image'] . "'><br>";
                    echo "<h2 class='admin'>ADMIN:</h2>";
                    echo "<span class='font'>Ime: </span><span class='admin_text'>" . $a['name'] . "</span><br>";
                    echo "<span class='font'>Email: </span><span class='admin_text'>" . $a['email'] . "</span><br>";

                    ?>

                </div>
            </div><!-- kraj #sidebar -->
            <div class="main">
                <?php

                ?>
                <?php require_once __DIR__ . '/controllers/' . $_GET['page'] . '.php'; ?>
            </div><!-- kraj #main -->


        </div> <!-- kraj #content -->
        <?php
    }else{
        echo "<p class='err_admin'>Ne mozete pristupiti stranici  ukoliko niste admin.</p>";
    }
?>
</div> <!-- kraj #wrappera -->

</body>
</html>
