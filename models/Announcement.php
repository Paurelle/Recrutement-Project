<?php

require_once 'Database.php';

class Announcement {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function announcementsInfo(){
        $this->db->query('SELECT * FROM announcements');

        $row = $this->db->resultSet();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function checkAnnouncementValidation($announcementId)
    {
        $this->db->query('SELECT Is_Checked FROM announcements WHERE Id_Announcement = :announcementId');
        $this->db->bind(':announcementId', $announcementId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function announcementCheck($announcementId) 
    {
        $this->db->query('UPDATE announcements set Is_Checked = :is_checked WHERE Id_Announcement = :id_announcement');
            //Bind values
            $this->db->bind(':id_announcement', $announcementId);
            $this->db->bind(':is_checked', 1);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function announcementDelete($announcementId) 
    {
        $this->db->query('DELETE FROM announcements WHERE Id_Announcement = :id_announcement');
            //Bind values
            $this->db->bind(':id_announcement', $announcementId);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
    }


    public function findAnnouncementInfo($id_user){
        $this->db->query('SELECT * FROM announcements WHERE Id_Recruiter = :id_user');
        $this->db->bind(':id_user', $id_user);

        $row = $this->db->resultSet();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function findAnnouncementInfoById($announcement){
        $this->db->query('SELECT * FROM announcements WHERE Id_Announcement = :announcement');
        $this->db->bind(':announcement', $announcement);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
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

    //Register Announcement
    public function register($data){
        $this->db->query('INSERT INTO announcements (Id_Recruiter, Title, Company_Name, Workplace, Schedule, Salary, Description, Is_Checked) 
        VALUES (:userId, :title, :company_name, :workplace, :schedule, :salary, :description, :is_checked)');
        //Bind values
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':company_name', $data['company_name']);
        $this->db->bind(':workplace', $data['workplace']);
        $this->db->bind(':schedule', $data['schedule']);
        $this->db->bind(':salary', $data['salary']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':is_checked', 0);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}
