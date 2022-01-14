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
}