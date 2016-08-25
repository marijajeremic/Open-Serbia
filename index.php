<?php
//startujemo sesiju
session_start();
//ukljucujemo 'config.php' -fajl u mom se nalaze ukljucene sve klase,kako bi nam bile dostupne
require_once 'config.php';

//definisemo varijablu $isAjax koja u sebi sadrzi poziv f-je koja proverava da li je ajax poziv u pitanju
$isAjax = isAjaxCall();

// Uzimamo parametar "page" iz $_GET
$page = filter_input(INPUT_GET, 'page');

if (false == $page) {
    // Ako nema parametra stavimo ga na "home"
    $page = 'home';
}
//ukoliko nije Ajax potrebno je da se ucita html 
if (false === $isAjax) :
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OPEN SERBIA</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href=" http://www.google.com/webfonts">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
        //postavljamo interval od 1 sekunde koja putem ajaxa proverava da li je korisnik blokiran
        setInterval(function () {
            // $.ajax je jQuery metoda koja startuje ajax upit
            $.ajax({
                //putanja na koju treba da se uputi Ajax
                url: 'index.php?page=stats',
               // Metoda kojom pozivamo
                type: 'GET',
                // Tip vracenih podataka od servera, ukoliko jQuery ne bude mogao da parsira response, tj da ga pretvori u
                // json objekat, metoda success se nece pozvati
                dataType: 'json',
                // Metoda koja se poziva ako je poziv zavrsio uspesno
                success: function (response) {
                    if (response && response.success) {
                        if (response.blocked) {
                            //ukoliko je vracena vrednost blocked odnosno true prelocirace korisnika na login stranu a pre toga ce izlogovati korisika
                            window.location = 'index.php?page=login';

                            return;
                        }
                    }
                }
            });
        }, 1000);
    </script>

          <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
          <script>tinymce.init({ selector:'textarea' });</script>
    
    </head>
    <body>
    <div id="wrapper">

        <div class="header">
            
        <div class="nav">
            <ul>
                <li><a href="cover.php">OPEN SERBIA</a>
                    <ul >
                        <li >
                            <a href="index.php?page=about">O Nama</a>
                        </li>
                        <li>
                            <a href="index.php?page=contact">Kontakt</a>
                        </li>
                    </ul>
                </li>
                <li><a href="index.php">Pocetna</a></li>

                <?php
                //ako je korisnik ulogovan u navigaciji ce se pojaviti 'dodajte znamenitost'
                if(!empty($_SESSION['isLogged'])) {?>
                    <li >
                        <a href="index.php?page=addpost">Dodajte Znamenitost</a>
                    </li>
                <?php } ?>
            </ul>
        </div><!-- kraj #nav -->
        <div class="nav" id="navright">
            <ul>
                <?php 
                //ukoliko je korisnik ulogovan i admin pojavice se admin u navigaciji
                if(!empty($_SESSION['isLogged']) && $_SESSION['admin'] == 1){
                    ?>
                    <li>
                        <a  href="admin/home.php?page=home" target="_blank">Admin</a>
                    </li>

                    <?php
                }
                ?>
                <?php 
                //ukoliko korisnik nije ulogovan,ucitace se sledece stavke u navigaciji
                if(empty($_SESSION['isLogged'])) {?>

                    <li>
                        <a href="index.php?page=register">Registracija</a>
                    </li>
                    <li >
                        <a href="index.php?page=login">Ulogujte se</a>
                    </li>
                <?php }else{ ?>
                    <li >
                        <a href="index.php?page=profile">Profil</a>
                        <ul >
                            <li><a href="index.php?page=inbox">Primljene</a> </li>
                            <li><a href="index.php?page=outbox">Poslate</a> </li>
                            <li><a href="index.php?page=friends">Prijatelji</a></li>
                            <li><a href="index.php?page=users">Korisnici</a></li>
                            <li><a href="index.php?page=galery">Galerija</a></li>
                            <li><a href="index.php?page=post">Postovi</a></li>
                        </ul>
                    </li>
                    <li >
                        <a class="logout" href="index.php?page=logout">Izlogujte se</a>
                    </li>
                <?php }?>
            </ul>

        </div><!-- kraj #navright -->

        <p class="titlehome">OPEN SERBIA</p>
        <p class="titlehome" id="title2">OPEN SERBIA</p>
    </div><!-- kraj #headera -->
    <?php

                
    ?>
    <div id="content">
<?php endif ?>
<?php 
//u kontekt delu ucitava stranicu koja je putem 'get' parametra 'page' dobijena
require_once __DIR__ . '/controllers/' . $page . '.php'; ?>
<?php 
// ponovo proveravamo da li je ajax zahtev ukoliko nije treba da ucita footer
if (false === $isAjax) : ?>

    </div> <!-- kraj #content -->


</div> <!-- kraj #wrappera -->

</body>
</html>
<?php endif ?>