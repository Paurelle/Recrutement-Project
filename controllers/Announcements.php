<?php

    session_start();

    require_once '../models/Announcement.php';
    require_once 'helpers/session_helper.php';

    class Announcements {

        private $AnnouncementModel;

        public function __construct(){
            $this->AnnouncementModel = new Announcement;
        }

        public function validateAnnouncement() {
            $row = $this->AnnouncementModel->announcementCheck($_POST['id_announcement']);
            if ($row) {
                echo json_encode("validate");
            }
        }

        public function refuseAnnouncement() {
            $row = $this->AnnouncementModel->announcementDelete($_POST['id_announcement']);
            if ($row) {
                echo json_encode("refuse");
            }
        }
        
        public function createAnnouncement()
        {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'userId' => $_SESSION['userId'],
                'title' => trim($_POST['title']),
                'company_name' => trim($_POST['company_name']),
                'workplace' => trim($_POST['workplace']),
                'schedule' => trim($_POST['schedule']),
                'salary' => trim($_POST['salary']),
                'description' => trim($_POST['description']) 
            ];
            
            // Validate inputs
            if (empty($data['title']) || empty($data['company_name']) ||
            empty($data['workplace']) || empty($data['schedule']) || 
            empty($data['salary'] || empty($data['description']))) {
                flash("announcement", "Veuillez remplir toutes les entrées");
                redirect("../createAnnouncement.php");
            }

            
            if(!preg_match("/^[\sa-zA-Z0-9éèçàê.,-]*$/", $data['title']) || strlen($data['title']) >= 100){
                flash("announcement", "Invalid title");
                redirect("../createAnnouncement.php");
            }

            if(!preg_match("/^[\sa-zA-Z0-9éèçàê.,-]*$/", $data['company_name']) || strlen($data['company_name']) >= 100){
                flash("announcement", "Invalid company name");
                redirect("../createAnnouncement.php");
            }

            if(!preg_match("/^[\sa-zA-Z0-9éèçàê.,-]*$/", $data['workplace']) || strlen($data['workplace']) >= 100){
                flash("announcement", "Invalid workplace");
                redirect("../createAnnouncement.php");
            }

            if(!preg_match("/^[\sa-zA-Z0-9éèçàê.,-]*$/", $data['schedule']) || strlen($data['schedule']) >= 100){
                flash("announcement", "Invalid schedule");
                redirect("../createAnnouncement.php");
            }

            if(!preg_match("/^[\$\sa-zA-Z0-9éèçàê.,-]*$/", $data['salary']) || strlen($data['salary']) >= 100){
                flash("announcement", "Invalid salary");
                redirect("../createAnnouncement.php");
            }

            if(strlen($data['description']) >= 1000){
                flash("announcement", "Invalid description");
                redirect("../createAnnouncement.php");
            }

            //Register User
            if($this->AnnouncementModel->register($data)){
                flash("profile", "Announcement has been added");
                redirect("../recruiterProfile.php");
            }else{
                die("Something went wrong");
            }
        }

    }

    $init = new Announcements;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['type']) {
            case 'register':
                $init->createAnnouncement();
                break;
            case 'validateAnnouncement':
                $init->validateAnnouncement();
                break;
            case 'refuseAnnouncement':
                $init->refuseAnnouncement();
                break;
            default:
                redirect("../index.php");
        }
    }else{
        redirect("../index.php");
    }

    

    