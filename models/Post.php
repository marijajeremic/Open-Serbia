<?php

//klasa Post nasledjuje klasu Model
class Post extends Model
{
    //metoda koja nam dobavlja sve postove
    public function getPosts()
    {
        //selektujemo sve postove koje je admin odobrio
        $query = $this->db->prepare('SELECT * FROM posts WHERE  is_deleted=0 AND admin_approved=1 ;');

        //ukoliko nema gresaka izvrsavamo query
        if( $query && $query->execute([]) ) {
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    // metoda koja nam vraca sve postove odredjenog korisnika,ulazni parametar je id tog korisnika
    public function getPostsByUserId($user_id)
    {
        // pripremamo query,selektujemo sve iz tabele 'posts' po odredjenom useru i uslovom da post nije obrisan
        $query = $this->db->prepare('SELECT * FROM posts WHERE user_id=? AND is_deleted=0 ');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$user_id])) {
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    //metoda nam vraca odredjeni post po id posta koji je i ulazni parametar ove f-je
    public function getPostById($post_id)
    {
        //pripremamo query,selektujemo sve iz tabele 'posts' gde je id posta zadati id
       $query = $this->db->prepare('SELECT * FROM posts WHERE post_id=?');
        //ukoliko nema gresaka izvrsavamo query
       if($query && $query->execute([$post_id])) {
           //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
        return $query->fetch(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
       return null;
    }

    //metoda koja nam vraca postove po zadatoj  kategoriji,ulazni parametar je id kategorije
    public function getPostsByCategory($id_category)
    {
        //slektujemo sve iz zadate kategorije postove koji nisu obrisani i odobreni su od strane admina
        $query = $this->db->prepare('SELECT * FROM posts WHERE id_category=? AND is_deleted=0 AND admin_approved=1;');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$id_category])){
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    //metoda koja nam vraca sve postove iz zadatog mesta,ulazni parametar je id tog mesta
    public function getPostsByPlace($id_place)
    {
        //slektujemo sve iz zadatog mesta postove koji nisu obrisani i odobreni su od strane admina
        $query = $this->db->prepare('SELECT * FROM posts WHERE id_place=? AND is_deleted=0 AND admin_approved=1;');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$id_place])){
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    //metoda koja nam vraca sve postove iz zadatog mesta i kategorije,ulazni parametri su id mesta i kategorije
    public function getPostsByIDCategoryAndPlace($id_category, $id_place)
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id_category=? AND id_place=?AND admin_approved=1  ;');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$id_category, $id_place])){
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    //metoda koja sluzi za upis posta u bazu,prima 10 parametara
    public function addPost($title, $content, $user_id, $id_category, $id_place, $address, $lat, $lon, $post_img, $descript)
    {
        //pripremamo query za upis
        $query = $this->db->prepare('INSERT INTO posts (title, content, user_id, id_category, id_place, address, post_img, descript, lat, lon) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?)');
        //ukoliko nema gresaka izvrsavamo query
        if ($query->execute([$title, $content, $user_id, $id_category, $id_place, $address, $post_img, $descript, $lat, $lon])) {
            return $this->db->lastInsertId();
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    //metoda treba da obrise post odnosno sluzi da korisniku porikaze da je post obrisan
    public function deletePost($post_id)
    {
       // pripremamo query,radimo update polja is_deleted u 1
        $query= $this->db->prepare('UPDATE posts SET is_deleted=1 WHERE post_id=?');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$post_id])){
            return true;
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    //metoda sluzi za izmenu posta
    public function editPost( $title, $content, $descript, $post_id)
    {
        //pripremamo query
        $query = $this->db->prepare('UPDATE posts SET title = ?, content = ?, descript = ? WHERE post_id=?');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute([$title, $content,  $descript, $post_id]))
        {
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }    

    //metoda nam sluzi da dobavimo sve postove koji cekaju odobrenje
    public function getAllPostsNotApproved()
    {
        //pripremamo query
        $query = $this->db->prepare('SELECT * FROM posts WHERE is_deleted=0 AND admin_approved=0');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute()){
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    //metoda vraca sve postove koji su obrisani od strane korisnika
    public function getAllDeletedPosts()
    {
        //pripremamo query
        $query = $this->db->prepare('SELECT * FROM posts WHERE is_deleted=1');
        //ukoliko nema gresaka izvrsavamo query
        if($query && $query->execute()){
            //dobijene rezultate zelimo u asocijativnom nizu da dobijemo
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    //metoda sluzi da obrise trajno post koji smo izabrali
   public function deletePostForever($post_id)
   {
       //pripremanmo query
       $query = $this->db->prepare('DELETE FROM posts WHERE post_id=?');
       //ukoliko nema gresaka izvrsavamo query
       if($query && $query->execute([$post_id])){
           return true;
       }
       //ukoliko je doslo do greske zelimo da nam f-ja vrati null
       return null;
   }
}