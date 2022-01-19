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
                flash("register", "Veuillez remplir toutes les entrées");
                redirect("../createConsultant.php");
            }

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                flash("register", "Email invalide");
                redirect("../createConsultant.php");
            }

            if(strlen($data['password']) < 6){
                flash("register", "Mot de passe incorrect");
                redirect("../register.php");
            } else if($data['password'] !== $data['confirm-password']){
                flash("register", "Les mots de passe ne correspondent pas");
                redirect("../createConsultant.php");
            }

            //User with the same email or password already exists
            if($this->adminModel->findUserByEmail($data['email'])){
                flash("register", "Nom d'utilisateur ou email déjà pris");
                redirect("../createConsultant.php");
            }

            //Passed all validation checks.
            //Now going to hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if (isset($_SESSION['usersId']) && $_SESSION['usersRole'] == 4){
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
                flash("register", "Une erreur c produit !");
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