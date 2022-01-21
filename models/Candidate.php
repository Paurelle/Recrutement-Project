<?php

require_once 'Database.php';

class Candidate {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function displayProfile($userId)
    {
        $this->db->query('SELECT Email, Name, Lastname, CV_Name FROM users, candidates WHERE candidates.Id_User = :userId AND users.Id_User = :userId ');
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function checkCandidateValidation($userId)
    {
        $this->db->query('SELECT Is_Checked FROM candidates WHERE Id_User = :userId');
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function candidateCheck($userId) 
    {
        $this->db->query('UPDATE candidates set Is_Checked = :is_checked WHERE Id_User = :id_user');
            //Bind values
            $this->db->bind(':id_user', $userId);
            $this->db->bind(':is_checked', 1);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
    }

    public function candidateDelete($userId) 
    {
        $this->db->query('DELETE FROM users WHERE Id_User = :id_user');
            //Bind values
            $this->db->bind(':id_user', $userId);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
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

    //Register User UPDATE users, candidates set users.Email = 'p@gmail.com', candidates.Name = 'pierre' WHERE candidates.Id_User = 5;
    public function updateProfile($data){
        $this->db->query('UPDATE users set Email = :email WHERE Id_User = :id_user');
        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id_user', $data['userId']);
        //Execute
        if($this->db->execute()){
            $this->db->query('UPDATE candidates set Name = :name,  Lastname = :lastname, CV_Id = :cvId, CV_Name = :cvName WHERE Id_User = :id_user');
            //Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':id_user', $data['userId']);
            $this->db->bind(':cvId', $data['cvId']);
            $this->db->bind(':cvName', $data['cvName']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
