<?php

//klasa User nasledjuje klasu Model
class User extends Model
{
    //metoda sluzi za registraciju korisnika,prima 4 parametra iz forme koju korisnik submituje,ime,email,pass i sliku
    public function createUser($name, $email, $password, $image)
    {
        //pripremamo queru za upis prema datim parametrima
        $query = $this->db->prepare('INSERT INTO user (name, email, password, image) VALUES (?, ?, ?, ?)');

        //ukoliko nema gresaka,izvrsavamo query upisujuci u bazu u tabelu user podatke
        if ($query && $query->execute([$name, $email, $password, $image])) {
            //vraca nam zadnji uneti id
            return $this->db->lastInsertId();
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda vraca sve iz tabele user
    public function getUsers()
    {
        //pripremamo query,selektujemo sve iz tabele user
        $query = $this->db->prepare('SELECT * FROM user;');

        //ukoliko nema gresaka izvrsavamo upit
        if( $query && $query->execute() ) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda nam vraca podatke o odredjenom korisniku po njegovom id koji je i ulazni parametar te metode
    public function getUserById($id){
        //pripremamo upit,selektujemo sve iz tabele user po zadatom id
        $query = $this->db->prepare('SELECT * FROM user WHERE id=?;');
        //ukoliko nema gresaka izvrsavamo upit
        if( $query && $query->execute([$id]) ) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda nam vraca podatke o odredjenom korisniku po njegovom emailu koji je i ulazni parametar te metode
    public function getUserByEmal($email)
    {
        //pripremamo upit,selektujemo sve iz tabele user po zadatom email-u
        $query = $this->db->prepare('SELECT * FROM user WHERE email=?;');
        //ukoliko nema gresaka izvrsavamo upit
        if( $query && $query->execute([$email]) ) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda nam vraca podatke o korisniku po njegovom emailu i pass,koji su ulazni parametri metode
    public function getUserByEmailAndPassword($email, $password)
    {
        //pripremamo upit,selektujemo sve iz tabele user po zadatom email-u i pass
        $query = $this->db->prepare('SELECT * FROM user WHERE email=? AND password=?');
        //ukoliko nema gresaka izvrsavamo upit
        if ($query && $query->execute([$email, $password])) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda brise usera,tj. obelezava u bazi da je izbrisan,podatke o njemu i dalje cuvamo
    public function deleteUser($id)
    {
        //pripremamo upit
        $query = $this->db->prepare('UPDATE user SET is_deleted=1 AND status=1 WHERE id=?');
        //ukoliko nema gresaka izvrsavamo upit
        if($query && $query->execute([$id])){
            return true;
        }
        //ukoliko je doslo do greske vraca nam false
        return false;
    }
    //metoda sluzi za dodavanje profilne slike,prima 2 parametra,ime slike i id korisnika
    public function addProfileImage($image,$id)
    {
        //pripremamo upit
        $query = $this->db->prepare('UPDATE user SET image=? WHERE id=?');
        //ukoliko nema gresaka izvrsavamo upit
        if ($query->execute([ $image,$id])) {
            return true;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda sluzi za dodavanje slika ,pravljenje galerije
    public function addImages($img_name,$user_id)
    {
        //pripremamo upit
        $query = $this->db->prepare('INSERT INTO images (img_name, user_id) VALUES (?, ?)');
        //ukoliko nema gresaka izvrsavamo upit
        if ($query->execute([$img_name,$user_id])) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //metoda nam vraca slike odredjenog korisnika prilikom prikazivana galerije
    public function getUserImages($user_id)
    {
        //pripremamo upit
        $query = $this->db->prepare('SELECT * FROM images WHERE user_id=?');
        //ukoliko nema gresaka izvrsavamo upit
        if ($query && $query->execute([$user_id])) {
            //dobijene rezultate zelimo da nam metoda vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }

    //podesavamo da kada je korisnik ulogovan nam vrati taj podatak o online korisnicima
    public function updateUserStatusOnline($user_id)
    {
        //pripremamo upit
        $query = $this->db->prepare('UPDATE user set is_logged=1 WHERE id=?');
        //ukoliko nema gresaka izvrsavamo upit
        if($query && $query->execute([$user_id])){
            return true;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }
    //podesavamo da kada je korisnik izlogovan nam vrati taj podatak o offline korisnicima
    public function updateUserStatusOffline($user_id)
    {
        //pripremamo upit
        $query = $this->db->prepare('UPDATE user set is_logged=0 WHERE id=?');
        //ukoliko nema gresaka izvrsavamo upit
        if($query && $query->execute([$user_id])){
            return true;
        }
        //ukoliko je doslo do greske vraca nam null
        return null;
    }
    
}