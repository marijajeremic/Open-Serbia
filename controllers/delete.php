<?php

//proveravamo da li je 'get' parametar action jednak 'msg'
if($_GET['action'] == 'msg') {
    // pravmo nov objekat klase 'Message' 
    $message = new Message();
    //nad tim objektom pozivamo metodu 'deleteSentMessage' koja prima jedan parametar 'id'
    //koji treba da nam ukaze na to koju tacno poruku,odnosno nad kojim id poruke treba da se izvrsi brisanje
    $msg = $message->deleteSentMessage($_GET['id']);
    //preusmeravamo korisnika na stranicu 'outbox'
    header('Location: index.php?page=outbox');
    
    //proveravamo da li je 'get' parametar action jednak 'msgr'  
}elseif ($_GET['action'] == 'msgr'){
    // pravmo nov objekat klase 'Message'
    $message = new Message();
    //nad tim objektom pozivamo metodu 'deleteRecievedMessage' koja prima jedan parametar 'id'
    //koji treba da nam ukaze na to koju tacno poruku,odnosno nad kojim id poruke treba da se izvrsi brisanje
    $msg = $message->deleteRecievedMessage($_GET['id']);
    //preusmeravamo korisnika na stranicu 'inbox'
    header('Location: index.php?page=inbox');
    
    //proveravamo da li je 'get' parametar action jednak 'delete_post'    
}elseif($_GET['action'] == 'delete_post'){
    // pravmo nov objekat klase 'Post'
    $post = new Post();
    //nad tim objektom pozivamo metodu 'deletePost' koja prima jedan parametar 'id'
    //koji treba da nam ukaze na to koji tacno post,odnosno nad kojim id posta treba da se izvrsi brisanje
    $pos = $post->deletePost($_GET['post_id']);
    //preusmeravamo korisnika na stranicu 'post'
    header('Location: index.php?page=post');
    //proveravamo da li je 'get' parametar action jednak 'del_user'
}elseif ($_GET['action'] == 'del_friend'){
    // pravmo nov objekat klase 'Friends'
    $friend = new Friends();
    $friends=$friend->deleteFriend($_SESSION['id'], $_GET['user_id']);
}