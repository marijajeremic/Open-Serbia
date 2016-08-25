<?php
$c = new Location();
$category = $c->getCategory();
$l = new Location();
$location = $l->getLocation();

$post = new Post();



//proveravamo da li je post prazan
if (!empty($_POST)) {
    $error = false;
    $errorArray = [];
    //proveravamo da li je 'title' prazan ili ima manje od 5 karaktera
    if (empty($_POST['title']) || strlen($_POST['title']) < 5) {
        $error = true;
        $errorArray['title'] = 'Naslov treba da ima minimum 5 katarktera';

    }
    //proveravamo da li je 'content' prazan ili ima manje od 50 karaktera
    if (empty($_POST['content']) || strlen($_POST['content']) < 50) {
        $error = true;
        $errorArray['content'] = 'Sadrzaj treba da sadrzi minimum 50 katarktera';

    }
    //proveravamo da li je 'descript' prazan ili ima manje od 10 karaktera
    if (empty($_POST['descript']) || strlen($_POST['descript']) < 10) {
        $error = true;
        $errorArray['descript'] = 'Opis treba da sadrzi minimum 30 katarktera';
    }

    $newImageNames = [];
    //obzirom da imamo multiupload za slike,prolazimo petljom foreach  kroz svaku
    foreach ($_FILES['file']['name'] as $index => $name) {

        // Uveravamo se da je zadati fajl slika
        if (substr($_FILES['file']['type'][$index], 0, 6) !== 'image/') {
            continue;
        }
        // dodeljujemo slici unikatno  ime pomocu php f-je uniqid()-koja generise unikatni id
        $img_name = uniqid(null, true) . "-{$name}";
        //tako dobijena nova imena slika pakujemo u niz
        $newImageNames[] = $img_name;
        $user_id = $_SESSION['id'];
        //konacno slike iz privremenog fajla smestamo u nas folder koji smo napravili na putanji 'images/post/'
        move_uploaded_file($_FILES['file']['tmp_name'][$index], 'images/post/' . $img_name);
    }
    //sve slike pakujemo u json nis koji nam sluzi kako bi vise slika mogli da ubacimo u jedno polje tabele 'posts'
    // gde cuvamo slike i smestamo u promenljivu 'post_img'
    $post_img = json_encode($newImageNames);

    //ukoliko nema gresaka,dodeljujemo vrednost promenljivama
    if ((!$error)) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['id'];
        $id_category = (int)$_POST['category_id'];
        $id_place = $_POST['id'];
        $address = $_POST['address'];
        $lat = $_POST['lat'];
        $lon = $_POST['lon'];

        $post = new Post();
        $descript = $_POST['descript'];

        //nad objektom 'post' pozivamo metodu 'addPost' koja treba da izvrsi upis u bazu novog posta
        if ($post->addPost($title, $content, $user_id, $id_category, $id_place, $address, $lat, $lon, $post_img, $descript)) {
            echo "Uspesno ste dodali post.";
        } else {
            echo "Neuspesno dodavanje.";
        }
    }
}

//proveravamo da li je korisnik admin
if($_SESSION['admin'] == 1){
    //ukoliko je admin i nije prazan post moze da izvrsi dodavanje nove lokacije
    if(isset($_POST['location']) && false === empty($_POST['name'])) {

        $name = $_POST['name'];
        
        //pravimo nov objekat klase 'location'
        $location = new Location();
        
        //nad objektom pozivamo metodu 'addLocation' koja ukoliko su svi uslovi prethodno ispunjeni 
        //izvrsava upis nove lokacije u bazu
        if($location->addLocation($name)){
            echo "Uspesno ste dodali novu lokaciju.";
        }else{
            echo "Neuspesno dodavanje.";
        }

    }
}



//proveravamo da li je korisnik admin
if($_SESSION['admin'] == 1) {
    //ukoliko je admin i nije prazan post moze da izvrsi dodavanje nove kategorije
    if (isset($_POST['new_category']) && false === empty($_POST['category_name'])) {

        $category_name = $_POST['category_name'];
        $creator = $_SESSION['id'];
        
        //pravimo nov objekat klase 'location'
        $category = new Location();

        //nad objektom pozivamo metodu 'addCategory' koja ukoliko su svi uslovi prethodno ispunjeni 
        //izvrsava upis nove kategorije u bazu
        if($category->addCategory($category_name,$creator)){
            echo "Uspesno ste dodali novu kategoriju.";
        }else{
            echo "Neuspesno dodavanje.";
        }
    }

}


include __DIR__ . '/../views/addpost.php';
?>