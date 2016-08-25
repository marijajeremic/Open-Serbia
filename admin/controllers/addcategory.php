<?php
$admins = new Admin();

$admin = $admins->getAdmin();

//proveravamo da li je korisnik admin
if($admin['admin'] == 1) {
    //ukoliko je admin i nije prazan post moze da izvrsi dodavanje nove kategorije
    if (isset($_POST['new_category']) && false === empty($_POST['category_name'])) {

        $category_name = $_POST['category_name'];
        $creator = $admin['id'];

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



include __DIR__ . '../../views/addcategory.php';