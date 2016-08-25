<?php

class Admin extends Model
{
    public function getAdmin()
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE admin=1');
        
        if($query and $query->execute()){
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function getAllPostsAdminPage()
    {
        $query = $this->db->prepare('SELECT * FROM posts');
        if( $query && $query->execute([]) ) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;

    }
    
    public function getOnlineUsers()
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE is_logged=1');

        if($query && $query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function getOfflineUsers()
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE is_logged=0');

        if($query && $query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function approvedPost($post_id)
    {
        $query= $this->db->prepare('UPDATE posts SET admin_approved=1 WHERE post_id=?');

        if($query && $query->execute([$post_id])){
            return true;
        }
        return null;
    }

    public function approvedComments($id)
    {
        $query= $this->db->prepare('UPDATE comments SET status=1 WHERE id=?');

        if($query && $query->execute([$id])){
            return true;
        }
        return null;
    }

    public function blockUser($id)
    {
        $query = $this->db->prepare('UPDATE user SET is_blocked=1, status=1 WHERE id=?');

        if($query && $query->execute([$id])){

           return true;
        }
        return null;
    }

    public function unblockUser($id)
    {
        $query = $this->db->prepare('UPDATE user SET is_blocked=0, status=0 WHERE id=?');

        if($query && $query->execute([$id])){
            return true;
        }
        return null;
    }

    public function getAllBlockedUsers()
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE is_blocked=1');
        
        if($query && $query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function getAllComments()
    {
        $query = $this->db->prepare('SELECT * FROM comments ');

        if($query && $query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
    
    public function makeUserAdmin($id)
    {
        $query = $this->db->prepare('UPDATE user SET admin=1 WHERE id=?');

        if($query && $query->execute([$id])){

            return true;
        }
        return null;
    }

    public function makeUserNoAdmin($id)
    {
        $query = $this->db->prepare('UPDATE user SET admin=0 WHERE id=?');

        if($query && $query->execute([$id])){

            return true;
        }
        return null;
    }
    
    
}