<?php


//klasa 'Friends ' nasledjuje klasu 'Model'
class Friends extends Model
{
    //f-ja sluzi da se posalje zahtev za prijateljstvo odredjenom korisniku,prima 2 ulazna parametra id posiljaoca i id
    // korisniku kome saljemo zahtev
    public function sentFriendRequest($sender_id,$recipient_id)
    {
        //preipremamo upit,selektujemo sve iz tabele 'friend_request' gde korisnik moze da se pojavi
        // u ulozi oosiljaoca ili u ulozi primaoca i gde je status razlicit od 2 sto znaci da nije ignorisan zahtev
        $query = $this->db->prepare('SELECT * FROM friend_requests WHERE ((sender_id=? AND recipient_id=?) OR (sender_id = ? AND recipient_id = ?)) AND status != 2;');

        //ukoliko nema greske izvrsavamo kod ,prosledjujuci podatke ,parametre stvljamo u uglastoj zagradi jer f-ja
        // execute ocekuje jedan parametar zato joj prosledjujemo niz
        if($query && $query->execute([$sender_id,$recipient_id, $recipient_id, $sender_id])){
        // zeljene rezultate zelimo da dobijemo kao asocijativni niz
         $freq = $query->fetch(PDO::FETCH_ASSOC);
            //ukoliko nije prazan rezultat koji smo dobili znaci da  upit ne moze da se izvrsi
            //jer je zahtev vec upucen i ne zelimo da korisnik vise puta istom korisniku moze da posalje zahtev
            if(!empty($freq)){
                return null;
            }
            //ukoliko je prazan dobijeni rezultat dozvoljavamo da se izvrsi upis,pripremamo Query
            $query = $this->db->prepare('INSERT INTO friend_requests (sender_id,recipient_id) VALUES (?, ?)');
            //ukoliko nema gresaka,izvrsavamo upis
            if($query && $query->execute([$sender_id,$recipient_id]))
            {
                //vracamo zadnji upisani id,posto ocekujemo samo jedan rezultat
                return $this->db->lastInsertId();
            }
        }
    // ukoliko je doslo do greske i nije prosao upis treba da nam vrati nulll
        return null;
    }

    //f-ja sluzi da prihvatimo zahtev za prijateljsvo,obavezni ulazni parametri koje prosledjujemo f-ji su id zahteva i id usera
    public function acceptFriendRequest($id,$user_id)
    {
        //najpre selektujemo sve iz tabele 'friend_request' gde je id tog zahteva zadati id i gde je id primaoca prosledjeni id
        $query = $this->db->prepare('SELECT * FROM friend_requests WHERE id = ? AND recipient_id = ?');

        //ukoliko je proslo bez greske izvrsavamo select
        if ($query && $query->execute([$id, $user_id])) {

            //rezultat stavljamo u promenljivu '$friendRequest' koja ce nam posluziti u nastavku koda
            //koristimo fetch jer ocekujmo samo jedan rezultat
            $friendRequest = $query->fetch(PDO::FETCH_ASSOC);
            //ukoliko je dobijeni rezultat prazan treba da vrati null
            if (empty($friendRequest)) {
                return null;
            }
            //ukoliko imamo rezultat radimo promenu statusa  u 1 sto znaci da je prihvacen zahtev i update vremena,kako bi videli
            //tacno vreme kada se promena desila
            $query = $this->db->prepare('UPDATE friend_requests SET status = 1, status_update_date = now() WHERE id = ?');
            //ukoliko je doslo do greske  treba da nam vrsti null
            if (false === $query || ($query && false === $query->execute([$id]))) {
                return null;
            }
            // ukoliko je upit prosao radimo pripremu za upis u novu tabelu 'friends' korisnika koji su postali prijatelji
            $query = $this->db->prepare('INSERT INTO friends (user_id, friend_id) VALUES (?, ?)');
            //ukoliko je query prosao bez greske sada izvrsamo query i koristimo podatke dobijene iz promenljive koje smo malopre napravili
            // iz prethodnog dobijenog querija da dobavimo id oba korisnika,prosledjujemo te podatke
            if ($query && $query->execute([$friendRequest['sender_id'], $friendRequest['recipient_id']])) {
                // ukliko je upis prosao treba da nam vrati poslednji upis
                return $this->db->lastInsertId();
            }
        }
    // ukoliko je doslo do greske treba da nm vrati null
        return null;
    }

    // f-ju koristimo za ignorisanje zahteva za prijateljstvo,obavezan ulazni parametar f-je nam je id tog zahteva
    public function ignoreFriendRequest($id)
    {
        //najpre pripremamo query i vrsimo promenu statusa sa 0 na 2 0-predstavlja poslat zahtev,
        //zahtev na cekanju 2- predstavlja da je na zahtev odgovoreno sa ignore
        $query = $this->db->prepare('UPDATE friend_requests SET status = 2,status_update_date = now() WHERE id=?');

        // ukoliko nema gresaka izvrsice se update,prosledjujemo parametar id
        if ($query && $query->execute([$id])) {

            //zeljeni rezultat zelim kao asocijativni niz...
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske vratice nam null
        return null;
    }


    //f-ja koja brise brijatelja iz liste prijatelja,obavezni ulazni parametri jesu id oba korisnika
    public function deleteFriend($userId, $friendId)
    {
        //pripremamo query  za brisanje,prosledjujemo id korisnika ,gde u obe uloge moze korisnik da se nadje...
        $query = $this->db->prepare('DELETE FROM friends WHERE (user_id = ? AND friend_id = ? ) OR (user_id = ? AND friend_id = ?);');
        //ukoliko je sve proslo bez gresaka izvrsavamo brisanje,prosledjujuci id korisnika
        if ($query && $query->execute([$userId, $friendId, $friendId, $userId])) {
            // ukoliko je brisanje uspesno vraca nam true
            return true;
        }
        //ukoliko nije uspelo brisanje ili je doslo do greske vraca nam false
        return false;
    }

    //f-ja sluzi za prikaz zahteva za prijateljstvo odredjenog korisnika gde je obavezni ulazni parametar id korisnika kome zelimo
    //da prikazemo njegove zahteve
    public function usersFriendsRequests($recipient_id)
    {
        //pripremamo  upit,radimo selekt iz tabele 'friend_requests' gde postoje zahtevi ka tom korisniku
        // i gde je status 0 sto znaci da jos uvek nije odgovoreno na poslate zahteve
        $query = $this->db->prepare("SELECT * FROM friend_requests WHERE recipient_id = ? AND status = 0");

        //ukoliko nema gresaka izvrsava se kod dalje
        if($query && $query->execute([$recipient_id])){
            //zeljeni rezultat zelimo kao asocijativni niz...
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko ima gresaka f-ja nam vraca null
        return null;    
    }

    //f-ja sluzi da nam vrati sve prijatelje za odredjenog korisnika,prima jedan ulazni obavezni
    // parametar to je id tog korisnika 
    public function friendList($user_id)
    {
        //pripremamo upit,selektujemo sve iz tabele friends gde je id korisnika parametar koji cemo proslediti
        $query = $this->db->prepare('SELECT * FROM friends WHERE (user_id = ? OR friend_id = ? )');

        //ukoliko je query prosao kako treba izvrsavamo upit dalje
        if($query && $query->execute([$user_id,$user_id])){
            //zeljeni rezultat zelimo kao asocijativni niz...
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        //ukoliko je doslo do greske i nije uspeo da se izvrsi upit f-ja treba da nam vrati null
        return null;
    }
    
    
    

    
}