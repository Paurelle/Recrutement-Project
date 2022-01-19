<?php
    
    session_start();

    require_once '../helpers/session_helper.php';

    class RegisterControllers {

        public function register_employer()
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION["post"]=$_POST;
            header("location: ../Recruiters.php");
        }

        public function register_job_seekers()
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_SESSION["post"]=$_POST;
            header("location: ../Candidates.php");
        }
        
    }

   

    $init = new RegisterControllers;
 

    // Ensure that user is sending a POST request.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['role']) {
            case 'employer':
                $init->register_employer();
                break;
            case 'job-seekers':
                $init->register_job_seekers();
                break;
            default:
                redirect("../../index.php");
        }
    }

    