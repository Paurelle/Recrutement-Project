<?php

    session_start();

    require_once '../models/Applied_candidate.php';
    require_once 'helpers/session_helper.php';

    class Applied_candidates {

        private $applied_candidateModel;

        public function __construct(){
            $this->applied_candidateModel = new Applied_candidate;
        }

        public function applyCandidate() {
            $candidate = $this->applied_candidateModel->findCandidate($_POST['email']);
            if ($candidate) {
                $row = $this->applied_candidateModel->applyCandidate($candidate->Id_User, $_POST['id_announcement']);
                if ($row) {
                    echo json_encode("apply");
                }
            }
        }

    }

    $init = new Applied_candidates;
    
    switch ($_POST['type']) {
        case 'applyCandidate':
            $init->applyCandidate();
            break;
        default:
            redirect("../index.php");
    }

    

    