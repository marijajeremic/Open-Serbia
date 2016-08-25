<?php


class Comments extends Model
{
    //f-ja sluzi za dodavanje komentara,kada neko ispise komentar na post to ce se upisati u bazu u tabelu 'comments'
    public function addComment($user_id, $content, $post_id)
    {
        $query = $this->db->prepare('INSERT INTO comments (user_id, content, post_id) VALUES (?, ?, ?)');
        //ukoliko je query uspesno prosao desava se upis
        if($query && $query->execute([$user_id, $content, $post_id])){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    //f-ja sluzi za prikaz komentara izabranog posta,post biramo pomocu id koji prosledjujemo kao obavezni parametar ove f-je
    public function showPostComments($post_id)
    {
        //selektujemo sve iz tabele comments gde je id tog posta onaj koji smo prosledili f-ji i uslov je da je
        //comment_id=0 sto znaci da selektujemo samo komentare a ne komentar komentara,status 1 oznacava da je komentar odobren
        $query = $this->db->prepare('SELECT * FROM comments WHERE post_id=? AND comment_id=0 AND status=1 ORDER by id DESC');
        
        if($query && $query->execute([$post_id])){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

    //f-ja sluzi za komentarisanje komentara gde su obavezni ulazni parametri id komentara,id usera,sam komentar i post na koji se odnosi komentar
   public function CommentComment($comment_id, $user_id, $content, $post_id )
   {
       //vrsimo pripremu za upis podataka
       $query = $this->db->prepare('INSERT INTO comments (comment_id, user_id, content, post_id) VALUES (?, ?, ?, ?)');
        //ukoliko je query uspesno prosao desava se upis
       if($query && $query->execute([$comment_id, $user_id, $content, $post_id])){
           //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
           return $query->fetch(PDO::FETCH_ASSOC);
       }
       return null;
   }

    //f-ja sluzi za prikaz komentara na komentare,ulazni parametar je id posta  za koji zelimo da se prikazu komentari
    public function showComenntsOfComments($post_id)
    {
        //selektujemo sve iz tabele comments gde je comment_id razlicit od 0 jer nam to pokazuje da se radi o komentaru komentara
        //comment_id drzi broj odnosno id komentara ,postoji relacija izmedju njih
        $query = $this->db->prepare('SELECT * FROM comments WHERE post_id=? AND comment_id !=0 AND status=1');

        if($query && $query->execute([$post_id])){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

   
    //f-ja koja kao rezultat vraca sve komentare i podkomentare odredjenog posta
    public function showAllComments($post_id)
    {
        //selektujemo sve gde je status 1 sto znaci komentare koji su odobreni od strane admina
        $query = $this->db->prepare('SELECT * FROM comments WHERE post_id=? status=1 ORDER by id DESC');

        if($query && $query->execute([$post_id])){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
    
    //f-ja koja selektuje sve odobrene podkomentare za odredjeni post
    public function commOfComm($post_id, $comment_id)
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE post_id=? AND comment_id=? AND status=1');

        if($query && $query->execute([$post_id,$comment_id])){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;


    }
    // ovde je uradjen pogled,selektuju se svi komentari sa imenom korisnika koji je komentarisao,zato je uradjen join 
    // kako bi se umesto id usera ispisalo ime
    public function getAllComments()
    {
        $query = $this->db->prepare('SELECT comments.id, user.name, comments.content, comments.date FROM comments INNER JOIN user ON comments.user_id=user.id ');

        if($query && $query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
    
    //odobravanje komentara
    public function approvedComm($id)
    {
        //promenom statusa na 1 za odredjeni komentar se vrsi odobrenje od strane admina
        $query = $this->db->prepare('UPDATE comments SET status=1 WHERE id=?');

        if($query && $query->execute([$id])){
            return true;
        }
        return null;
    }
    
    //f-ja koja vrsi brisanje komentara,ne radi stvarno brisanje iz baze,vec samo tako izgleda klijentu,sve poruke
    // i komentarise cuvaju osim ukoliko admin ne odluci da zaista obrise trajno kom.
    public function deleteComm($id)
    {
        $query= $this->db->prepare('UPDATE comments SET is_deleted=1 WHERE id=?');
        // nakon promene da je kom. obrisan neophodno je i status promeniti u 0 kako ne bi ostao na strani prikaz
        // komentara koji imaju status 1 i prikazuju se kao odobreni komentari
        if($query && $query->execute([$id])){
            $q = $this->db->prepare('UPDATE comments SET status=0 WHERE id=?');
            $q->execute([$id]);
        }
        return null;
    }
    
    //f-ja koja sluzi da nam pokaze sve neodobrene komentare 
    public function getNoApprovedComm()
    {
        //radi se selektovanje svih komentara koji imaju staus 0 i nisu obrisani
        $query = $this->db->prepare('SELECT * FROM comments WHERE status=0 AND is_deleted=0');

        if($query && $query->execute()){
            //dobijene rezultate zelimo da dobijemo u asocijativnom nizu
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
}