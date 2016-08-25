<?php
//klasa Rating nasledjuje klasu Model
class Rating extends Model
{
    //metoda koja sluzi za upis rejtinga u  tabelu ,ulazni parametri su id posta koji je rejtovan,sam rejting i korisnik koji je glasao
    public function ratePost($post_id, $rating_post, $user_id)
    {
        //pripremamo query po zadatim parametrima
        $query = $this->db->prepare('INSERT into rating_posts ( post_id, rating_post, user_id) VALUES (?, ?, ?)');
        //ukoliko nema gresaka izvrsavamo upis
        if($query && $query->execute([$post_id, $rating_post, $user_id])){
            //pravimo nov objekat klase Rating
            $r = new Rating();
            //nad napravljenim objektom pozivamo metodu koja taj rejting treba da upise u drugu tabelu-'posts'
            $res = $r->updateRate($post_id);
           // metoda treba da nam vrati tako dobijeni rezultat
            return $res;
            
        }
        //ukoliko je doslo do greske,treba  da nam vrati null
        return null;
    }

    //metoda koja nam vraca rejting odredjenog posta,ulazni paramet. je id posta za koji zelimo da nam se prikaze rejting
    public function viewRatingPost($post_id)
    {
        //pripremamo query po zadatom id posta,selektujemo rejting
        $query = $this->db->prepare('SELECT rating_post FROM rating_posts WHERE post_id = ?');
        //ukoliko nema gresaka dalje izvrsavamo upit
        if($query && $query->execute([$post_id])){
          //zelimo kao rezultat da podatke dobijemo u asocijativnom nizu
          return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko dodje do greske i ne izvrsi se upit zelim da nam metoda vrati null
        return null;
    }

    // metoda koja nam ispisuje,vraca rejting za zadati post,ulazni parametar je id posta
    public function returnRating($postId)
    {
        //pravimo nov objekat klase Rating
        $r = new Rating();
        //nad tim objektom pozivamo metodu kojom dobavljamo rejting za odredjeni post
        $rat = $r->viewRatingPost($postId);
        // pravimo novu varijablu koja predstavlja krajnji rezultat rejtinga i dodeljujemo joj vrednost 0
        $totalRatingScore = 0;
        //nad dobijenim rezultatom iz prethodno koriscene metode koristimo f-ju count
        $totalRatings = count($rat);
        //provlacimo dobijeni rejting kroz foreach petlju
        foreach ($rat as $value){
            //dodajemo za svaki post svaki rejting -sve ocene
            $totalRatingScore += $value['rating_post'];
        }

        $rating = 0;

        if ($totalRatings) {
            //izracunavamo koliki je prosecan rejting za zadati post
            $rating = $totalRatingScore / $totalRatings;
        }
    //vracamo dobijeni rezultat
        return $rating;


    }

    //metoda sluzi za upis rejtinga u tabeli posts svaki put kada se rejting promeni treba da update-je taj vec postojeci rejting
    public function updateRate($postId)
    {
        //pravimo nov objekat klase Rating
        $r = new Rating();
        //nad tim dobijenim objektom pozivamo metodu 'returnRating' koja izracunava trenutni rejting
        $rat =$r->returnRating($postId);

        //pripremamo query za upis
        $query = $this->db->prepare('UPDATE posts SET rating=? WHERE post_id = ?');
        //ukoliko nema gresaka izvrsavamo upit
        if($query && $query->execute([$rat,$postId])){
            //ukoliko je sve u redu metoda ce nam vratiti bool vrednost true
            return true;
        }
        //ukoliko je doslo do greske vraca nam false
        return false;
    }

    //metoda vraca rejting za odredjeni post od strane odredjenog usera
    public function getRatingByUserAndPost($post_id,$user_id)
    {
        //pripremamo query,selektujemo iz tabele rating_posts rejting od odrejenog korisnika i posta
        $query = $this->db->prepare('SELECT * FROM rating_posts WHERE post_id =? AND user_id=?');
        //ukoliko nema gresaka izvrsava se query
        if($query && $query->execute([$post_id,$user_id])){
            //dobijeni rezultat zelimo u asocijativnom nizu 
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // ukoliko dodje do greske metoda vraca false
        return false;
    }    
        

}