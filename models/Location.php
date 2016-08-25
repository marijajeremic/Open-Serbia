<?php

//klasa Location nasledjuje klasu Model
class Location extends Model
{
    //f-ja sluzi za dodavanje nove kategorije i prima 2 ulazna obavezna parametra
    // a to su ime kategorije i korisnik koji je kreira odnosno njegov id
    public function addCategory($category_name, $creator)
    {
        //pripremamo upit za upis u bazu, potrebo je u tabelu 'categories' uneti podatke koje prosledjujemo
        $query = $this->db->prepare('INSERT INTO categories (category_name, creator) VALUES (?, ?)');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upis
        if($query && $query->execute([$category_name, $creator])){
            //kao rezultat zelimo da nam vrati poslednji id koji je upisan u bazu
            return $this->db->lastInsertId();
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    //f-ja sluzi za dodavanje nove lokacije i prima 1 parametar a to je ime samog mesta koje unosimo
    public function addLocation($name)
    {
        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upis
        $query = $this->db->prepare('INSERT INTO places (name) VALUES (?)');

        if($query && $query->execute([$name])){
            //kao rezultat zelimo da nam vrati poslednji id koji je upisan u bazu
            return $this->db->lastInsertId();
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    //f-ja sluzi za pregled svih kategorija
    public function getCategory()
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'categories' ukoliko nije izbrisana neka kategorija
        $query = $this->db->prepare('SELECT * FROM categories WHERE is_deleted=0');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if ($query && $query->execute()){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }
    //f-ja sluzi za pregled svih lokacija
    public function getLocation()
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'places' ukoliko nije izbrisano neko od mesta
        $query = $this->db->prepare('SELECT * FROM places WHERE is_deleted=0');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if ($query && $query->execute()){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    // f-ja nam dobavlja kategoriju po imenu,prima jedan parametar -ime te kategorije
    public function getCategoryByCategoryName($category_name)
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'categories' po zadatom imenu
        $query = $this->db->prepare('SELECT * FROM categories WHERE category_name=? AND is_deleted=0 ;');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$category_name])){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    // f-ja nam dobavlja kategoriju po id,prima jedan parametar -id te kategorije
    public function getCategoryByCategoryId($category_id)
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'categories' po zadatom id
        $query = $this->db->prepare('SELECT * FROM categories WHERE category_id=? AND is_deleted=0 ;');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$category_id])){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    //f-ja koja dobavlja lokaciju odnosno grad po imenu,ulazni parametar je ime
    public function getLocationByName($name)
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'places' po zadatom imenu
        $query = $this->db->prepare('SELECT * FROM places WHERE name=? AND is_deleted=0;');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$name])){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    //dobavljamo lokaciju po njenom id,f-ja prima 1 parametar id te lokacije
    public function getLocationByLocationId($id)
    {
        //pripremamo upit ka bazi,selektujemo sve iz tabele 'places' po zadatom id
        $query = $this->db->prepare('SELECT * FROM places WHERE id=? AND is_deleted=0;');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$id])){
            //zeljeni rezultat zelimo u asocijativnom nizu da dobijemo
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati null
        return null;
    }

    //f-ja koja brise navodno mesto,navodno jer zelimo da nam ostane u bazi ipak samo vrsiomo
    // update polja is_deleted i na klijentskoj strani ce se nece prikazati
    public function deleteLocation($id)
    {
        //pripremamo upit ka bazi,menjamo polje iz tabele 'places' po zadatom id is_deleted iz 0 u 1
        $query = $this->db->prepare('UPDATE places SET is_deleted=1 WHERE id=?');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$id])){
            return true;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati false
        return false;
    }

    //f-ja koja brise navodno kategoriju,navodno jer zelimo da nam ostane u bazi ipak samo vrsiomo
    // update polja is_deleted i na klijentskoj strani ce se nece prikazati
    public function deleteCategory($category_id)
    {
        //pripremamo upit ka bazi,menjamo polje iz tabele 'categories' po zadatom id is_deleted iz 0 u 1
        $query = $this->db->prepare('UPDATE categories SET is_deleted=1 WHERE category_id=?');

        //ukoliko je query prosao ok i nije bilo gresaka izvrsava se upit
        if($query && $query->execute([$category_id])){
            return true;
        }
        //ukoliko je doslo do greske f-ja treba da nam vrati false
        return false;
    }
}