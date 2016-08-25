<?php
$admins = new Admin();

$admin = $admins->getAdmin();

//proveravamo da li je korisnik admin
if($admin['admin'] == 1){
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

include __DIR__ . '../../views/addlocation.php';