<?php

class Controller
{
    public function home()
    {
        require_once 'views/home.php';
    }

    public function login()
    {
        require_once 'views/login.php';
    }

    public function register()
    {
        require_once 'views/register.php';
    }

    public function createAnnouncement()
    {
        require_once 'views/createAnnouncement.php';
    }
    
    public function createConsultant()
    {
        require_once 'views/createConsultant.php';
    }

    public function candidateProfile()
    {
        require_once 'views/candidateProfile.php';
    }

    public function recruiterProfile()
    {
        require_once 'views/recruiterProfile.php';
    }

    public function announcementDetails()
    {
        require_once 'views/announcementDetails.php';
    }

    public function validateAnnouncement()
    {
        require_once 'views/validateAnnouncement.php';
    }
    
    public function validateAccount()
    {
        require_once 'views/validateAccount.php';
    }

    public function validateApply()
    {
        require_once 'views/validateApply.php';
    }
}