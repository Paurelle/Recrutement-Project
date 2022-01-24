<?php

require_once 'Database.php';

class Applied_candidate {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
        
    }

    public function findApply($id_candidate)
    {
        $this->db->query('SELECT * FROM applied_candidates WHERE Id_candidate = :id_candidate ');
        $this->db->bind(':id_candidate', $id_candidate);

        $row = $this->db->resultSet();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function findCandidate($email)
    {
        $this->db->query('SELECT * FROM users WHERE Email = :email ');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function applyCandidate($id_candidate, $id_announcement){
        $this->db->query('INSERT INTO applied_candidates (Id_Candidate, Id_Announcement, Is_Checked) 
        VALUES (:id_candidate, :id_announcement, :is_checked)');
        //Bind values
        $this->db->bind(':id_candidate', $id_candidate);
        $this->db->bind(':id_announcement', $id_announcement);
        $this->db->bind(':is_checked', 0);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}
