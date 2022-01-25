

<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';
    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Announcement.php';

    $userModel = new User;
    $userInfo = $userModel->findUserInfoRecruiter($_SESSION['userId']);

    $announcementModel = new Announcement;
    $announcementInfo = $announcementModel->announcementsInfo();

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/validateAnnouncement.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Home</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <h1>Validate Announcement</h1>
        <section class="cards">

        <?php
            $announcements = 0;
            if ($announcementInfo != null) {
                for ($i=0; $i < count($announcementInfo); $i++) { 
                    $announcement = $announcementModel->checkAnnouncementValidation($announcementInfo[$i]->Id_Announcement);

                if ($announcement->Is_Checked == 0) {
                    $announcements++;
        ?> 
                    <a id=<?= 'announcement_'.$announcements?> href=<?="announcementDetails.php?announcement=".$announcementInfo[$i]->Id_Announcement."&announcements=".$announcements?>>
                        <article class="card">
                            <h2><?=$announcementInfo[$i]->Title ?></h2>
                            <div class="row-card">
                                <p>Company : <?=$announcementInfo[$i]->Company_Name ?></p>
                                <p><?=$announcementInfo[$i]->Salary ?></p>
                            </div>
                            <div class="row-card">
                                <p><?=tronque_chaine($announcementInfo[$i]->Workplace, 30) ?></p>
                                <p><?=$announcementInfo[$i]->Schedule ?></p>
                            </div>
                            <div class="box-description">
                                <p><?=tronque_chaine($announcementInfo[$i]->Description, 200) ?></p>
                            </div>
                            <div class="row-card">
                            <button class="validate-btn" onclick="validate(
                                '<?='announcement_'.$announcements ?>',
                                '<?=$announcementInfo[$i]->Id_Announcement ?>'
                                )">
                                Validate
                            </button>
                            <button class="refuse-btn" onclick="refuse(
                                '<?='announcement_'.$announcements ?>',
                                '<?=$announcementInfo[$i]->Id_Announcement ?>'
                                )">
                                Refuse
                            </button>
                            </div>
                        </article>
                    </a>
        <?php
                    }
                }
            }
        ?>
            
        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
    <script src="views/js/validate-announcement-btn.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }






























