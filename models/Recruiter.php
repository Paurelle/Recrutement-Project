<?php

require_once 'Database.php';

class Recruiter {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function displayProfile($userId)
    {
        $this->db->query('SELECT Email, Company_Name, Address FROM users, recruiters WHERE recruiters.Id_User = :userId AND users.Id_User = :userId ');
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function checkRecruiterValidation($userId)
    {
        $this->db->query('SELECT Is_Checked FROM recruiters WHERE Id_User = :userId');
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function recruiterCheck($userId)
    {
        $this->db->query('UPDATE recruiters set Is_Checked = :is_checked WHERE Id_User = :id_user');
            //Bind values
            $this->db->bind(':id_user', $userId);
            $this->db->bind(':is_checked', 1);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        
    }

    public function recruiterDelete($userId) 
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
            $this->db->query('UPDATE recruiters set Company_Name = :company_name, Address = :company_address WHERE Id_User = :id_user');
            //Bind values
            $this->db->bind(':company_name', $data['company_name']);
            $this->db->bind(':company_address', $data['company_address']);
            $this->db->bind(':id_user', $data['userId']);

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
