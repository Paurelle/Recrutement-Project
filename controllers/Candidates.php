<?php

    session_start();

    require_once '../models/Candidate.php';
    require_once 'helpers/session_helper.php';

    class Candidates {

        private $candidateModel;

        public function __construct(){
            $this->candidateModel = new Candidate;
        }

        public function register(){
            
            // Process form

            // Init data
            $data = [
                'role' => "candidate",
                'email' => trim($_SESSION["post"]["email"]),
                'password' => trim($_SESSION["post"]["password"]),
                'confirm-password' => trim($_SESSION["post"]["confirm-password"]),
                'is_checked' => 0
            ];

            unset($_SESSION["post"]);

            // Validate inputs
            if (empty($data['email']) ||
            empty($data['password']) || empty($data['confirm-password'])) {
                flash("register", "Veuillez remplir toutes les entrées");
                redirect("../register.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("register", "Email invalide");
                redirect("../register.php");
            }

            if(strlen($data['password']) < 6){
                flash("register", "Mot de passe incorrect");
                redirect("../register.php");
            } else if($data['password'] !== $data['confirm-password']){
                flash("register", "Les mots de passe ne correspondent pas");
                redirect("../register.php");
            }

            //User with the same email or password already exists
            if($this->candidateModel->findCandidateByEmail($data['email'])){
                flash("register", "email déjà pris");
                redirect("../register.php");
            }

            //Passed all validation checks.
            //Now going to hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if($this->candidateModel->register($data)){
                redirect("../login.php");
            }else{
                die("Something went wrong");
            }
            
        }

        public function login(){
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            //Init data
            $data=[
                'name/email' => trim($_POST['name/email']),
                'usersPwd' => trim($_POST['usersPwd'])
            ];
    
            if(empty($data['name/email']) || empty($data['usersPwd'])){
                flash("login", "Veuillez remplir toutes les entrées");
                redirect("../login.php");
                
            }
    
            //Check for user/email
            if($this->candidateModel->findCandidateByEmail($data['email'])){
                //User Found
                $loggedInUser = $this->candidateModel->login($data['name/email'], $data['usersPwd']);
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
            $_SESSION['usersId'] = $user->users_id;
            $_SESSION['usersName'] = $user->users_name;
            $_SESSION['usersEmail'] = $user->users_email;
            redirect("../index.php");
        }
    
        public function logout(){
            unset($_SESSION['usersId']);
            unset($_SESSION['usersName']);
            unset($_SESSION['usersEmail']);
            session_destroy();
            redirect("../index.php");
        }
    }

    $init = new Candidates;
    
    switch ($_SESSION["post"]['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            unset($_SESSION["post"]);
            redirect("../index.php");
    }

    

    