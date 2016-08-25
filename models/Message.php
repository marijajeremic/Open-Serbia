<?php

//klasa Message nasledjuje klasu Model
class Message extends Model
{
    //f-ja koju koristimo za slanje poruke,ima 4 ulazna parametra,id korisnika koji salje,id primaoca,naslov poruke i sadrzaj
    public function sendMessage($sender_id, $reciever_id, $title, $content)
    {
        // pripremamo upit ka bazi po zadatim parametrima
        $query = $this->db->prepare('INSERT INTO messages (sender_id, reciever_id, title, content) VALUES (?, ?, ?, ?)');

        // ukiliko nema greske izvrsavamo upit ,dolazi do upisa podataka u tabelu
        if ($query->execute([$sender_id, $reciever_id, $title, $content])) {
            // vraca nam zadnji uneti id
            return $this->db->lastInsertId();
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    // metoda koja nam vraca sve poruke
    public function getAllMessages()
    {
        // pripremamo upit ka bazi i selektujemo sve iz tabele 'messages' sortirano po najsvezijim podacima
        $query = $this->db->prepare('SELECT * FROM messages ORDER BY id DESC');

        // ukiliko nema greske izvrsavamo upit
        if($query && $query->execute([])){
            //dobijeni rezultat biramo da nam vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    // ovde pravimo metodu koja ima zadatak  da pokaze kako mozemo skratiti kod,
    //obzirom da se kod stalno ponavlja u nekim delovima taj deo koda smo ispisali
    // ovde i sledeci put mozemo samo pozvati ovu f-ju na mesto gde nam je potrebna
    private function executeQuery($query, array $parameters, $returnValue = null)
    {
        $query = $this->db->prepare($query);

        if ($query->execute($parameters)) {
            return true;
        }

        return $returnValue;
    }

    //ovde je primer kako mozemo da iskoristimo prethodno napisanu metodu
    // i time skracujemo kod na jednu linijiu koda
    //f-ja ima zadatak da obrise poslate poruke,tj da ih korisniku prikaze kao obrisane
    public function deleteSentMessage($id)
    {
        return $this->executeQuery('UPDATE messages SET is_deleted=1 WHERE id=?', [$id]);
    }

    //metoda sluzi za brisanje primljenih poruka,poruke ostaju u bazi ali korisnik ih vidi kao obrisane
    public function deleteRecievedMessage($id)
    {
        return $this->executeQuery('UPDATE messages SET is_deletedr=1 WHERE id=?', [$id]);
    }
    
    //metoda koja nam vraca primljene poruke odredjenog korisnika
    public function getInboxMsg($id)
    {
        // vrsimo upit ka bazi,pripremamo query
        $query = $this->db->prepare('SELECT * FROM messages WHERE reciever_id = ? AND is_deletedr = 0 ORDER BY id DESC');

        // ukiliko nema greske izvrsavamo upit
        if($query && $query->execute([$id])){
            //dobijeni rezultat biramo da nam vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    //metoda koja nam vraca poslate poruke i iprima 1 parametar a to je id korisnika koji je poslao poruku
    public function getOutboxMsg($id)
    {
        // vrsimo upit ka bazi,pripremamo query
        $query = $this->db->prepare('SELECT * FROM messages WHERE sender_id = ? AND is_deleted = 0 ORDER BY id DESC');

        // ukiliko nema greske izvrsavamo upit
        if($query && $query->execute([$id])){
            //dobijeni rezultat biramo da nam vrati u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    // metoda sluzi da procitamo izabranu poruku ,prima 1 parametar id poruke
    public function readMessage($id)
    {
        //najpre menjamo status is_read u 1 sto nam pokazuje da je ooruka procitana
        $query = $this->db->prepare('UPDATE messages SET is_read=1 WHERE id=?');
        //ukoliko je uredno prosao upit izvrsavamo dalje
        if ($query->execute([$id])) {
            //potom selektujemo tu procitanu poruku 
            $q = $this->db->prepare('SELECT * FROM messages WHERE id=? AND is_read =1');
            
                if($q->execute([$id])){
                    //rezultat zelimo u asocijativnom nizu
                    return $q->fetch(PDO::FETCH_ASSOC);
                }
            // ukoliko je doslo do greske zelimo da nam f-ja vrati null
            return null;
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    
    // metoda nam vraca poruku po id poruke i to je ulazni parametar
    public function getMessage($id)
    {
        //pripremamo upit selekttujuci sve iz tabele 'messages' sa zadatim id
        $query = $this->db->prepare('SELECT * FROM messages WHERE id=?');

        //ukoliko je uredno prosao upit izvrsavamo dalje
        if($query && $query->execute([$id])){
            //rezultat zelimo u asocijativnom nizu
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }    
    
    //metoda sluzi za slanje poruke adminu,to se koristi na kontak strani sajta,ima 4 ulazna parametra
    // ime korisnika koji salje poruku,email,naslov i sama poruka
    public function sendMessagetoAdmin($name, $email, $title, $content)
    {
        //pripremamo upit
        $query = $this->db->prepare('INSERT INTO site_messages (name, email, title, content) VALUES (?, ?, ?, ?)');
        //ukoliko je uredno prosao upit izvrsavamo dalje
        if($query && $query->execute([$name, $email, $title, $content])){
            return $this->db->lastInsertId();
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }

    // metoda koja se koristi za prikaz adminovih ooruka
    public function getAdminMessages()
    {
        // pripremamo upit
        $query = $this->db->prepare('SELECT * FROM site_messages');
        //ukoliko nema greske izvrsavamo upit
        if($query && $query->execute([])){
            //rezultat zelimo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }
    // metoda sluzi za citanje poruka od strane admina
    public function  readSiteMessage($id)
    {
        //pripremamo query,selektujemo poruku po id
        $query = $this->db->prepare('SELECT * FROM site_messages WHERE id=?');
        
        if($query && $query->execute([$id])){
            //rezultat zelimo u asocijativnom nizu
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        // ukoliko je doslo do greske zelimo da nam f-ja vrati null
        return null;
    }    
}