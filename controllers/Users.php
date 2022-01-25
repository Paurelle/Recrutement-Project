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
                flash("register", "Veuillez remplir toutes les entrées");
                redirect("../register.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("register", "Email invalide");
                redirect("../register.php");
            }

            if(strlen($data['password']) < 6){
                flash("register", "Mot de passe incorrect, 7 caractères minunmuns");
                redirect("../register.php");
            } else if($data['password'] !== $data['confirm-password']){
                flash("register", "Les mots de passe ne correspondent pas");
                redirect("../register.php");
            }

            //User with the same email or password already exists
            if($this->userModel->findUserByEmail($data['email'])){
                flash("register", "Nom d'utilisateur ou email déjà pris");
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
                    flash("register", "Une erreur c produit !");
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
                flash("login", "Veuillez remplir toutes les entrées");
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
                    flash("login", "Mot de passe incorrect");
                    redirect("../login.php");
                }
            }else{
                flash("login", "Aucun utilisateur trouvé");
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


    