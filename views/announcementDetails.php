
<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';

    require_once 'Controllers/Helpers/session_helper.php';
    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Candidate.php';
    require_once 'models/Applied_candidate.php';
    require_once 'models/Announcement.php';

    // prend l'id de lanonce
    $announcement = $_GET["announcement"];

    // prend le le numero du l'anonce
    if (!empty($_GET["announcements"])) {
        $announcements = $_GET["announcements"];
    }

    $announcementModel = new Announcement;
    $announcementInfo = $announcementModel->findAnnouncementInfoById($announcement);

    // test si l'anonce a deja etait valider par les admin ou consultant 
    if ($announcementInfo->Is_Checked == 1 && $_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4) {
        redirect("index.php");
    }

    // test si il y a une saission d'ouvert et que l'anonce et different de null
    if (isset($_SESSION['userId']) && $announcementInfo != null){

        $candidateModel = new Candidate;
        $candidateInfo = $candidateModel->checkCandidateValidation($_SESSION['userId']);

        $applied_candidateModel = new Applied_candidate;
        $applied_candidateInfo = $applied_candidateModel->findApply($_SESSION['userId']);
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/announcementDetails.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Announcement Detail</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Announcement Detail</h1>
                <form action="" method="POST">
                    <?php if ($announcementInfo->Is_Checked == 0 && $_SESSION['userRole'] == 1): ?>
                        <p>Waiting for validation</p>
                        <?php 
                            if ($announcementInfo->Id_Recruiter != $_SESSION['userId'] && $_SESSION['userRole'] != 4 && $_SESSION['userRole'] != 3) {
                                redirect("index.php");
                            }
                        ?>
                    <?php endif ?>
                    <h2 class="title">Title</h2>
                    <div class="row-card">
                        <p>company : <?=$announcementInfo->Company_Name ?></p>
                        <p><?=$announcementInfo->Salary ?></p>
                    </div>
                    <div class="row-card">
                        <p><?=$announcementInfo->Workplace ?></p>
                        <p><?=$announcementInfo->Schedule ?></p>
                    </div>
                    <div class="box-description">
                        <p><?=$announcementInfo->Description ?></p>
                    </div>
                    <?php 
                        if ($_SESSION['userRole'] == 2) {
                            $compteur = 0;
                            // test si la candidate a 
                            if (!empty($applied_candidateInfo)) {
                                for ($j=0; $j < count($applied_candidateInfo); $j++) { 
                                    if (isset($_SESSION['userId']) && $candidateInfo->Is_Checked == 1) {
                                        if ($applied_candidateInfo[$j]->Id_Announcement == $announcement) {
                                            echo '<p class="form-message-green">You have already applied</p>';
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
                                        '<?=$announcement ?>'
                                        )">
                                        Apply
                                    </button> 
                    <?php
                                    }
                                }else{
                                    echo '<p class="form-message-yellow">Complete your profile to be able to apply for an announcement</p>';
                                }
                            }else{
                                echo '<p class="form-message-yellow>Your account is awaiting validation to be able to register for the announcement. In the meantime, the announcement is temporarily blocked.</p>';
                            }
                        }
                        
                    ?>
                    
                </form>

                <?php if ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4): ?>
                    <div class="row-card vr">
                        <button class="validate-btn" onclick="validate(
                            '<?='announcement_'.$announcements ?>',
                            '<?=$announcementInfo->Id_Announcement ?>'
                            )">
                            Validate
                        </button>
                        <button class="refuse-btn" onclick="refuse(
                            '<?='announcement_'.$announcements ?>',
                            '<?=$announcementInfo->Id_Announcement ?>'
                            )">
                            Refuse
                        </button>
                    </div>
                <?php endif ?>

                <?php if ($_SESSION['userRole'] == 1 && $announcementInfo->Id_Recruiter == $_SESSION['userId'] && $announcementInfo->Is_Checked == 1): ?>
                    <div class="box-candidate-apply">
                        <h2 class="title">Candidate who we apply</h2>
                        <div class="table-content">
                            <table class="list-candidate">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Lastname</th>
                                        <th>CV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if ($announcementInfo->Id_Recruiter == $_SESSION['userId']) {
                                            $recruiterInfo = $applied_candidateModel->findApplyByAnnouncement($announcementInfo->Id_Announcement);
                                            if ($recruiterInfo) {
                                                for ($i=0; $i < count($recruiterInfo); $i++) { 
                                                    if ($recruiterInfo[$i]->Is_Checked == 1) {
                                                        $candidate = $candidateModel->displayProfile($recruiterInfo[$i]->Id_Candidate);
                                    ?>
                                                        <tr>
                                                            <td class="td-name"><?=$candidate->Name?></td>
                                                            <td class="td-lastname"><?=$candidate->Lastname?></td>
                                                            <td class="td-cv"><a href="filesCV/" download=<?=$candidate->CV_Id?>>Download</a></td>
                                                        </tr>
                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif ?>

            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
    <script src="views/js/validate-announcement-btn.js"></script>
    <script src="views/js/candidate_apply.js"></script>
    <script src="views/js/download.js"></script>
</body>
</html>

<?php
    }else{
        redirect("login.php");
    }














