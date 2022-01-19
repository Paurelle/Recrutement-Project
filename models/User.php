<?php

require_once 'Database.php';

class User {
    
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
    public function registerRecruiter($id_user){
        $this->db->query('INSERT INTO recruiters (Id_User, Is_Checked) 
        VALUES (:id_user, :is_checked)');
        //Bind values
        $this->db->bind(':id_user', $id_user);
        $this->db->bind(':is_checked', 0);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Register candidate
    public function registerCandidate($id_user){
        $this->db->query('INSERT INTO candidates (Id_User, Is_Checked) 
        VALUES (:id_user, :is_checked)');
        //Bind values
        $this->db->bind(':id_user', $id_user);
        $this->db->bind(':is_checked', 0);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($email, $password){
        $row = $this->findUserByEmail($email);

        if($row == false) return false;

        $hashedPassword = $row->Password;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail){
        $this->db->query('UPDATE users SET users_pwd=:pwd WHERE users_email=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}
