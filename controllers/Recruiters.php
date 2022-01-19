<?php

    session_start();

    require_once '../models/Recruiter.php';
    require_once 'helpers/session_helper.php';

    class Recruiters {

        private $recruiterModel;

        public function __construct(){
            $this->recruiterModel = new Recruiter;
        }

        public function displayProfile() {
            if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 1) {
                $row = $this->recruiterModel->displayProfile($_SESSION['userId']);
                if ($row) {

                    $Info_Profile = array('company_name' => $row->Company_Name, 'company_address' => $row->Address, 'email' => $row->Email);
                    
                    echo json_encode($Info_Profile);
                }
            }
        }
        
        public function modifyProfile()
        {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'userId' => $_SESSION['userId'],
                'company_name' => trim($_POST['company_name']),
                'company_address' => trim($_POST['company_address']),
                'email' => trim($_POST['email'])
            ];
            
            // Validate inputs
            if (empty($data['company_name']) || empty($data['company_address']) ||
            empty($data['email'])) {
                flash("profile", "Veuillez remplir toutes les entrées");
                redirect("../recruiterProfile.php");
            }

            if(!preg_match("/^[a-zA-Zéèçàê ]*$/", $data['company_name'])){
                flash("profile", "Invalid name");
                redirect("../recruiterProfile.php");
            }

            if(!preg_match("/^[a-zA-Zéèçàê ]*$/", $data['company_address'])){
                flash("profile", "Invalid lastname");
                redirect("../recruiterProfile.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("profile", "Email invalide");
                redirect("../recruiterProfile.php");
            }

            //User with the same email or password already exists
            if($this->recruiterModel->findUserByEmail($data['email']) && $data['email'] != $_SESSION['userEmail']){
                flash("profile", "Email déjà pris");
                redirect("../recruiterProfile.php");
            }

            // save new email in session
            $_SESSION['userEmail'] = $data['email'];

            //Register User
            if($this->recruiterModel->updateProfile($data)){
                flash("profile", "is good");
                redirect("../recruiterProfile.php");
            }else{
                die("Something went wrong");
            }
        }

    }

    $init = new Recruiters;
    
    switch ($_POST['type']) {
        case 'displayProfile':
            $init->displayProfile();
            break;
        case 'modify':
            $init->modifyProfile();
            break;
        default:
            redirect("../index.php");
    }

    

    