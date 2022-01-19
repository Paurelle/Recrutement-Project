<?php
    
    session_start();

    require_once '../../models/Recruiter.php';
    require_once '../../models/Candidate.php';
    require_once '../helpers/session_helper.php';

    class LoginControllers {

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

   

    $init = new LoginControllers;
    
    $recruiter = new Recruiter;
    $candidate = new Candidate;
    
    // Ensure that user is sending a POST request.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($recruiter->findRecruiterByEmail($_POST['email'])) {
            echo "recruiter";
        }
        if ($candidate->findCandidateByEmail($_POST['email'])) {
            echo "candidate";
        }
    }

    