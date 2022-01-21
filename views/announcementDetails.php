
<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';

    require_once 'Controllers/Helpers/session_helper.php';
    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Announcement.php';

    $announcement = $_GET["announcement"];
    $announcements = $_GET["announcements"];

    $announcementModel = new Announcement;
    $announcementInfo = $announcementModel->findAnnouncementInfoById($announcement);

    if (isset($_SESSION['userId']) && $announcementInfo != null &&  $announcementInfo->Is_Checked == 0){
       
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
                    <?php if ($announcementInfo->Is_Checked == 0 && $_SESSION['userId'] == 1): ?>
                        <p>Waiting for validation</p>
                        <?php 
                            if ($announcementInfo->Id_Recruiter != $_SESSION['userId'] && $_SESSION['userId'] != 4 && $_SESSION['userId'] != 3) {
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
                    <?php if ($_SESSION['userRole'] == 2): ?>
                        <button>Apply</button>
                    <?php endif ?>
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
                                    <tr>
                                        <td class="td-name">paurellepaurellepaurellepaurelle</td>
                                        <td class="td-lastname">paurellepaurellepaurellepaurelle</td>
                                        <td class="td-cv"><button>Download</button></td>
                                    </tr>
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
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }














