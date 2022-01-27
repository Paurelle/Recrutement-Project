<?php

require_once 'Database.php';

class Admin {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Find user by email or username
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data){
        $this->db->query('INSERT INTO users (Id_Role, Email, Password) 
        VALUES (:role, :email, :password)');
        //Bind values
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Register recruiter
    public function registerConsultant($id_user){
        $this->db->query('INSERT INTO consultants (Id_User) 
        VALUES (:id_user)');
        //Bind values
        $this->db->bind(':id_user', $id_user);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}
