<?php
//startujemo sesiju
session_start();
//ukljucujemo 'config.php' -fajl u mom se nalaze ukljucene sve klase,kako bi nam bile dostupne
require_once 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OPEN SERBIA</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="wrapper">
    <div class="header" id="homeheader">
        <div class="nav" id="os">
            <ul>
                <li><a href="cover.php">Open Serbia</a></li>



                <li >
                    <a href="index.php">Pocetna</a>
                </li>

            </ul>

        </div><!-- kraj #nav -->
        <div class="nav" id="navos">
            <ul>
                <li class="active">
                    <a href="index.php?page=about">O Nama</a>
                </li>
                <li class="active">
                    <a href="index.php?page=contact">Kontakt</a>
                </li>
            </ul>
        </div>
    </div><!-- kraj #headera -->

    <div id="content">




    </div> <!-- kraj #content -->

    <section id="videoback" class="negativ">
        <video autoplay loop muted poster="background.jpg" id="bgvid">
            <source src="video/background.webm" type="video/webm">
            <source src="video/background.mp4" type="video/mp4">
        </video>

        <div class="wrapper">
            <p><img src="" alt=""></p>
            <h1 class="openserbia">OPEN SERBIA</h1>
            <p>Dobrodosli na nas sajt.</p>
        </div>

    </section>
    <div class="hometext">
        
    </div>

    <div class="footer" id="homefooter">
        <p>Copyright &copy; 2016 -Marija Jeremic</p>

    </div><!-- kraj #footera -->
</div> <!-- kraj #wrappera -->
















</body>
</html>