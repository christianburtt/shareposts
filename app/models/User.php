<?php
class User{
    private $db;

    public function __construct(){
        $this->db = new Db();
    }

    // resgister user
    public function register( array $data){
        $this->db->query('INSERT INTO users (name, email, pw) VALUES (:name, :email, :pw)');
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':pw',$data['pw']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function findUserByEmail($mail){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$mail);
        $row = $this->db->getRow();

        //check if the row is there
        if($this->db->getRowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function login($email,$pw_plaintext){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);
        $row = $this->db->getRow();

        $hashed_pw = $row->pw;
        if(password_verify($pw_plaintext,$hashed_pw)){
            return $row;
        }else{
            return false;
        }
    }

    public function getUser($user_id){
        $this->db->query('SELECT * FROM users WHERE user_id=:userID');
        $this->db->bind(':userID',$user_id);
        $row = $this->db->getRow();
        return $row;
    }
}