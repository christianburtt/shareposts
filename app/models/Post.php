<?php
class Post{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
        
    }

    public function getPosts($user_id=0){
        $this->db->query('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id ORDER BY posts.created_at DESC');
        $results = $this->db->getResultSet();
        return $results;
    }

    public function addPost(array $data){
        $this->db->query('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :userid)');
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':userid',$data['user_id']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getPost(int $post_id){
        $this->db->query('SELECT * FROM posts WHERE post_id=:postid');
        $this->db->bind(':postid',$post_id);
        $row = $this->db->getRow();
        return $row;
    }

    public function updatePost(array $data){
        $this->db->query('UPDATE posts SET title=:title, body=:body WHERE post_id=:postID');
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':postID',$data['post_id']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deletePost(int $post_id){
        $this->db->query('DELETE FROM posts WHERE post_id=:postID');
        
        $this->db->bind(':postID',$post_id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}