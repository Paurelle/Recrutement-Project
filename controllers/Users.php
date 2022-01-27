<?php

    require_once '../models/User.php';
    require_once 'helpers/session_helper.php';

    class Users {

        private $userModel;

        public function __construct(){
            $this->userModel = new User;
        }

        public function register(){
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm-password' => trim($_POST['confirm-password']),
                'role' => trim($_POST['role'])
            ];

            // Validate inputs
            if (empty($data['email']) || empty($data['password']) ||
            empty($data['confirm-password']) || empty($data['role'])) {
                flash("register", "Please complete all entries");
                redirect("../register.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("register", "Email invalide");
                redirect("../register.php");
            }

            if(strlen($data['password']) < 6){
                flash("register", "Invalid password, 7 characters minimum");
                redirect("../register.php");
            } else if($data['password'] !== $data['confirm-password']){
                flash("register", "Passwords do not match");
                redirect("../register.php");
            }

            //User with the same email or password already exists
            if($this->userModel->findUserByEmail($data['email'])){
                flash("register", "Username or email already taken");
                redirect("../register.php");
            }

            //Passed all validation checks.
            //Now going to hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if($this->userModel->register($data)){
                $users = $this->userModel->findUserByEmail($data['email']);
                if ($data['role'] == 1) {
                    if ($this->userModel->registerRecruiter($users->Id_User)) {
                        redirect("../login.php");
                    }
                }
                else if ($data['role'] == 2) {
                    if ($this->userModel->registerCandidate($users->Id_User)) {
                        redirect("../login.php");
                    }
                }
                else {
                    flash("register", "An error has occurred");
                    redirect("../login.php");
                }
                
            }else{
                die("Something went wrong");
            }

        }

        public function login(){
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            //Init data
            $data=[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];
    
            if(empty($data['email']) || empty($data['password'])){
                flash("login", "Please complete all entries");
                redirect("../login.php");
                
            }
    
            //Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                //User Found
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    //Create session
                    $this->createUserSession($loggedInUser);
                }else{
                    flash("login", "incorrect password");
                    redirect("../login.php");
                }
            }else{
                flash("login", "No users found");
                redirect("../login.php");
            }
        }
        
        public function createUserSession($user){
            $_SESSION['userId'] = $user->Id_User;
            $_SESSION['userRole'] = $user->Id_Role;
            $_SESSION['userEmail'] = $user->Email;
            redirect("../index.php");
        }
    
        public function logout(){
            unset($_SESSION['userId']);
            unset($_SESSION['userRole']);
            unset($_SESSION['userEmail']);
            session_destroy();
            redirect("../index.php");
        }
    }

    $init = new Users;

    // Ensure that user is sending a POST request.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['type']) {
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            default:
                redirect("../index.php");
        }

    }else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../index.php");
        }
    }


    