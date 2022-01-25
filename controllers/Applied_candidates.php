<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    require_once '../models/Applied_candidate.php';
    require_once '../models/Announcement.php';
    require_once '../models/Candidate.php';
    require_once '../models/Recruiter.php';
    require_once 'helpers/session_helper.php';

    //Require PHP Mailer
    require_once '../PHPMailer/src/PHPMailer.php';
    require_once '../PHPMailer/src/Exception.php';
    require_once '../PHPMailer/src/SMTP.php';

    class Applied_candidates {

        private $applied_candidateModel;
        private $announcementModel;
        private $candidateModel;
        private $recruiterModel;
        private $mail;

        public function __construct(){
            $this->applied_candidateModel = new Applied_candidate;
            $this->announcementModel = new Announcement;
            $this->candidateModel = new Candidate;
            $this->recruiterModel = new Recruiter;
            //Setup PHPMailer
            $this->mail = new PHPMailer();
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.mailtrap.io';
            $this->mail->SMTPAuth = true;
            $this->mail->Port = 2525;
            $this->mail->Username = '46d76a87d94443';
            $this->mail->Password = 'fae948a6bc90c9';
            $this->mail->CharSet = 'UTF-8';
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

        public function validateApply() {
            $row = $this->applied_candidateModel->applyCheck($_POST['id_candidate'], $_POST['id_announcement']);
            $sendMail = $this->sendEmail($_POST['id_candidate'], $_POST['id_announcement']);
            if ($row && $sendMail) {
                echo json_encode("validate");
            }
        }

        public function refuseApply() {
            $row = $this->applied_candidateModel->applyDelete($_POST['id_candidate'], $_POST['id_announcement']);
            if ($row ) {
                echo json_encode("validate");
            }
        }

        public function sendEmail($candidateId, $announcementId){

            $announcement = $this->announcementModel->findAnnouncementInfoById($announcementId);
            $candidate = $this->candidateModel->displayProfile($candidateId);
            $recruiter = $this->recruiterModel->displayProfile($announcement->Id_Recruiter);

            $usersEmail = $recruiter->Email;
            $nameAnnouncement = $announcement->Title;

            $nameCandidate = $candidate->Name." ".$candidate->Lastname;
            $cvIdCandidate = $candidate->CV_Id;
            $cvNameCandidate = $candidate->CV_Name;

            //Can Send Email Now
            $subject = "TRT-Conseil - Nouvelle Candidature pour votre annonce : ".$nameAnnouncement;
            $message = "<p>Mr/Mme ".$nameCandidate." a postuler pour votre annonce : ".$nameAnnouncement.".</p>";
            $message .= "<p>Veiller trouver si joint le cv du candidat.</p>";
            $message .= "<p>Cordialement, TRT-Conseil</p>";
    
            $this->mail->setFrom('Trt-conseil@gmail.com');
            $this->mail->addAttachment('../filesCv/'.$cvIdCandidate, $cvNameCandidate); 
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->addAddress($usersEmail);

            if($this->mail->send()){
                return true;
            }else{
                return false;
            }
        }
    }

    $init = new Applied_candidates;
    
    switch ($_POST['type']) {
        case 'applyCandidate':
            $init->applyCandidate();
            break;
        case 'validateApply':
            $init->validateApply();
            break;
        case 'refuseApply':
            $init->refuseApply();
            break;
        default:
            redirect("../index.php");
    }

    

    