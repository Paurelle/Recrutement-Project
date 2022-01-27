
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';
    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Recruiter.php';
    require_once 'models/Announcement.php';

    $userModel = new User;
    $userInfo = $userModel->findUserInfoRecruiter($_SESSION['userId']);

    $recruiterModel = new Recruiter;
    $validateRecruiter = $recruiterModel->checkRecruiterValidation($_SESSION['userId']);

    $announcementModel = new Announcement;
    $announcementInfo = $announcementModel->findAnnouncementInfo($_SESSION['userId']);

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 1) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/recruiterProfile.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Recruiter profile</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Recruiter profile</h1>
                <?php flash('profile'); ?>
                <div id="profil">
                    <div class="row-card">
                        <?php if ($userInfo->Company_Name == null) : ?>
                            <h2>Anunimous</h2>
                        <?php else : ?>
                            <h2><?=$userInfo->Company_Name?></h2>
                        <?php endif; ?>
                        <div class="modify-btn">
                            <button onclick="display_form()">Modify</button>
                        </div>
                    </div>
                    <div class="row-card">
                        <p>Address : <?=$userInfo->Address?></p>
                    </div>
                    <div class="row-card">
                        <p>Email : <?=$userInfo->Email?></p>
                    </div>
                </div>
                
                <div id="form-profil" style="display: none;">
                    <form action="controllers/Recruiters.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="modify">
                        <div class="input-card">
                            <label for="company_name">Company name</label>
                            <input id="company_name" type="text" name="company_name">
                        </div>
                        <div class="input-card">
                            <label for="company_address">Company address</label>
                            <input id="company_address" type="text" name="company_address">
                        </div>
                        <div class="input-card">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email">
                        </div>
                        <div class="modify-profile-btn">
                            <div class="row-card">
                                <button type="submit">Validate</button>
                                <button type="button" onclick="display_form()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>

                <section class="box-announcement">
                    <h2 class="title">Your announcement</h2>
                    <?php if ($validateRecruiter->Is_Checked == 0) : ?>
                        <p class="form-message-yellow">Your account is awaiting validation to be able to post an announcement. In the meantime, the page is temporarily blocked.</p>
                    <?php endif; ?>
                    <div class="nav-card-section">
                        <a href="createAnnouncement.php">Create announcement</a>
                    </div>
                    <?php
                    if ($announcementInfo != null) {
                     
                        for ($i=0; $i < count($announcementInfo); $i++) { 
                    ?> 
                            <a href=<?="announcementDetails.php?announcement=".$announcementInfo[$i]->Id_Announcement?>>
                                <article class="card-2">
                                    <form action="" method="POST">
                                        <?php if ($announcementInfo[$i]->Is_Checked == 0): ?>
                                            <p class="form-message-yellow">Waiting for validation</p>
                                        <?php endif ?>
                                        <h2><?=$announcementInfo[$i]->Title ?></h2>
                                        <div class="row-card-2">
                                            <p>Company : <?=$announcementInfo[$i]->Company_Name ?></p>
                                            <p><?=$announcementInfo[$i]->Salary ?></p>
                                        </div>
                                        <div class="row-card-2">
                                            <p><?=tronque_chaine($announcementInfo[$i]->Workplace , 30)?></p>
                                            <p><?=$announcementInfo[$i]->Schedule ?></p>
                                        </div>
                                        <div class="box-description">
                                            <p><?=tronque_chaine($announcementInfo[$i]->Description, 200) ?></p>
                                        </div>
                                    </form>
                                </article>
                            </a>
                    <?php
                        }
                    }
                    ?>
                    
                </section>
            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
    <script src="views/js/display_form_recruiter.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }















