<?php 

    require_once '../models/Admin.php';
    require_once 'helpers/session_helper.php';

    class Admins {

        private $adminModel;

        public function __construct(){
            $this->adminModel = new Admin;
        }

        public function register(){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm-password' => trim($_POST['confirm-password']),
                'role' => 3
            ];

            // Validate inputs
            if (empty($data['email']) || empty($data['password']) ||
            empty($data['confirm-password'])) {
                flash("register", "Please complete all entries");
                redirect("../createConsultant.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("register", "Invalid Email");
                redirect("../createConsultant.php");
            }

            if(strlen($data['password']) < 6){
                flash("register", "incorrect password");
                redirect("../register.php");
            } else if($data['password'] !== $data['confirm-password']){
                flash("register", "Passwords do not match");
                redirect("../createConsultant.php");
            }

            //User with the same email or password already exists
            if($this->adminModel->findUserByEmail($data['email'])){
                flash("register", "Username or email already taken");
                redirect("../createConsultant.php");
            }

            //Passed all validation checks.
            //Now going to hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            //Register User
            if ($_SESSION['userRole'] == 4){
                if($this->adminModel->register($data)){
                    $users = $this->adminModel->findUserByEmail($data['email']);
                    if ($data['role'] == 3) {
                        if ($this->adminModel->registerConsultant($users->Id_User)) {
                            redirect("../index.php");
                        }
                    }
                }else{
                    die("Something went wrong");
                }
            }else{
                flash("register", "An error occurred !");
                redirect("../createConsultant.php");
            }
        }
    }

    $init = new Admins;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['type']) {
            case 'register':
                $init->register();
                break;
            default:
                flash("infoForm", "An error occurred !");
                redirect("../adminPanel.php");
        }
    } 

?>