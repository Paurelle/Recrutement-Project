<?php

    session_start();

    require_once '../models/Candidate.php';
    require_once 'helpers/session_helper.php';

    class Candidates {

        private $candidateModel;

        public function __construct(){
            $this->candidateModel = new Candidate;
        }

        public function displayProfile() {
            if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 2) {
                $row = $this->candidateModel->displayProfile($_SESSION['userId']);
                if ($row) {

                    $Info_Profile = array('name' => $row->Name, 'lastname' => $row->Lastname, 'email' => $row->Email, 'cv' => $row->CV_Name);
                    
                    echo json_encode($Info_Profile);
                }
            }
        }

        public function validateCandidate() {
            $row = $this->candidateModel->candidateCheck($_POST['id_user']);
            if ($row) {
                echo json_encode("validate");
            }
        }

        public function refuseCandidate() {
            $row = $this->candidateModel->candidateDelete($_POST['id_user']);
            if ($row) {
                echo json_encode("refuse");
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
                'name' => trim($_POST['name']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'cv' => $_FILES['cv'],
                'cvName' => "",
                'cvId' => "",
            ];
            
            // Validate inputs
            if (empty($data['name']) || empty($data['lastname']) ||
            empty($data['email']) || empty($data['cv']['name'])) {
                flash("profile", "Please complete all entries");
                redirect("../candidateProfile.php");
            }

            if(!preg_match("/^[a-zA-Zéèçàê ]*$/", $data['name'])){
                flash("profile", "Invalid name");
                redirect("../candidateProfile.php");
            }

            if(!preg_match("/^[a-zA-Zéèçàê ]*$/", $data['lastname'])){
                flash("profile", "Invalid lastname");
                redirect("../candidateProfile.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("profile", "Email invalide");
                redirect("../candidateProfile.php");
            }

            //User with the same email or password already exists
            if($this->candidateModel->findUserByEmail($data['email']) && $data['email'] != $_SESSION['userEmail']){
                flash("profile", "Email already taken");
                redirect("../candidateProfile.php");
            }

            // You should also check filesize here.
            if ($data['cv']['size'] > 1000000) {
                flash("profile", "The size of the CV and too voluminous");
                redirect("../candidateProfile.php");
            }

            if (substr(strrchr($data['cv']['name'],'.'),1) != "pdf") {
                flash("profile", "it must be in 'pdf' format");
                redirect("../candidateProfile.php");
            }

            //pdf file processing

            // name is 'id_user.extension
            $fileNameId = $_SESSION['userId'].strrchr($data['cv']['name'],'.');

            $file_tmp_name = $data['cv']['tmp_name'];
            $file_dest = '../filesCv/'.$fileNameId;
            if (!move_uploaded_file($file_tmp_name, $file_dest)) {
                flash("profile", "An error has occurred");
                redirect("../candidateProfile.php");
            }

            $data['cvId'] =  $fileNameId;
            $data['cvName'] = $data['cv']['name'] ;
            
            // save new email in session
            $_SESSION['userEmail'] = $data['email'];

            //Register User
            if($this->candidateModel->updateProfile($data)){
                redirect("../candidateProfile.php");
            }else{
                die("Something went wrong");
            }
        }

    }

    $init = new Candidates;
    
    switch ($_POST['type']) {
        case 'displayProfile':
            $init->displayProfile();
            break;
        case 'modify':
            $init->modifyProfile();
            break;
        case 'validateCandidate':
            $init->validateCandidate();
            break;
        case 'refuseCandidate':
            $init->refuseCandidate();
            break;
        default:
            redirect("../index.php");
    }

    

    