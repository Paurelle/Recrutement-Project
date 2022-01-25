
<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';

    require_once 'controllers/troque_chaine.php';
    require_once 'Controllers/Helpers/session_helper.php';

    require_once 'models/User.php';
    require_once 'models/Candidate.php';
    require_once 'models/Applied_candidate.php';
    require_once 'models/Announcement.php';

    

    $announcementModel = new Announcement;
    $announcementInfo = $announcementModel->announcementsInfo();

    if (isset($_SESSION['userId'])) {
        $userModel = new User;
        $userInfo = $userModel->findUserInfoRecruiter($_SESSION['userId']);

        $candidateModel = new Candidate;
        $candidateInfo = $candidateModel->checkCandidateValidation($_SESSION['userId']);

        $applied_candidateModel = new Applied_candidate;
        $applied_candidateInfo = $applied_candidateModel->findApply($_SESSION['userId']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/home.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Home</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>

        <h1>Announcement</h1>

        <section class="cards">

            <?php
                $announcements = 0;
                if ($announcementInfo != null) {
                    for ($i=0; $i < count($announcementInfo); $i++) { 
                        $announcement = $announcementModel->checkAnnouncementValidation($announcementInfo[$i]->Id_Announcement);

                    if ($announcement->Is_Checked == 1) {
                        $announcements++;
            ?> 
                        <a id=<?= 'announcement_'.$announcements?> href=<?="announcementDetails.php?announcement=".$announcementInfo[$i]->Id_Announcement?>>
                            <article class="card">
                                <h2><?=$announcementInfo[$i]->Title ?></h2>
                                <div class="row-card">
                                    <p>Company : <?=$announcementInfo[$i]->Company_Name ?></p>
                                    <p><?=$announcementInfo[$i]->Salary ?></p>
                                </div>
                                <div class="row-card">
                                    <p><?=tronque_chaine($announcementInfo[$i]->Workplace , 30)?></p>
                                    <p><?=$announcementInfo[$i]->Schedule ?></p>
                                </div>
                                <div class="box-description">
                                    <p><?=tronque_chaine($announcementInfo[$i]->Description, 200) ?></p>
                                </div>
                                <?php 
                                
                                    // test si il y a une session d'ouvert
                                    if (isset($_SESSION['userId'])) {
                                         // test si la session a pour role candidat
                                        if ($_SESSION['userRole'] == 2) {
                                        $compteur = 0;
                                        // test si la candidate a 
                                        if (!empty($applied_candidateInfo)) {
                                            for ($j=0; $j < count($applied_candidateInfo); $j++) { 
                                                if (isset($_SESSION['userId']) && $candidateInfo->Is_Checked == 1) {
                                                    if ($applied_candidateInfo[$j]->Id_Announcement == $announcementInfo[$i]->Id_Announcement) {
                                                        echo 'Deja postuler';
                                                        $compteur++;
                                                    }
                                                }
                                            }
                                        }
                                            // test si le candidat a etait valider 
                                            if ($candidateInfo->Is_Checked == 1) {
                                                $candidate = $candidateModel->displayProfile($_SESSION['userId']);
                                                // test si le profil du candidat a etait ajouter
                                                if ($candidate->Name != NULL && $candidate->Lastname != NULL && $candidate->CV_Name != NULL) {
                                                    if ($compteur < 1) {
                                ?>
                                                        <button class="apply-btn" onclick="apply(
                                                            '<?=$_SESSION['userEmail'] ?>',
                                                            '<?=$announcementInfo[$i]->Id_Announcement ?>'
                                                            )">
                                                            Apply
                                                        </button> 
                                <?php
                                                    }
                                                }else{
                                                    echo '<p>Complete your profile to be able to apply for an announcement</p>';
                                                }
                                            }else{
                                                echo '<p>Your account is awaiting validation to be able to register for the announcement. In the meantime, the announcement is temporarily blocked.</p>';
                                            }
                                        }
                                    }
                                ?>
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
    <script src="views/js/candidate_apply.js"></script>
</body>
</html>















