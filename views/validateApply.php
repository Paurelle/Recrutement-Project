
<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';

    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Applied_candidate.php';
    require_once 'models/Announcement.php';
    require_once 'models/Candidate.php';

    $userModel = new User;
    $usersInfo = $userModel->UsersInfo();

    $applied_candidateModel = new Applied_candidate;
    $applied_candidateInfo = $applied_candidateModel->applyInfo();
    $announcementModel = new Announcement;
    $candidateModel = new Candidate;

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 4) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/validateApply.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Validate Apply</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Validate Apply</h1>
                <div class="box-candidate-apply">
                    <div class="table-content">
                        <table class="list-candidate">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Company name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $rows = 0;
                                if ($applied_candidateInfo != null) {
                                
                                    for ($i=0; $i < count($applied_candidateInfo); $i++) { 
                                        if ($applied_candidateInfo[$i]->Is_Checked == 0) {
                                            $candidate = $candidateModel->displayProfile($applied_candidateInfo[$i]->Id_Candidate);
                                            $announcement = $announcementModel->findAnnouncementInfoById($applied_candidateInfo[$i]->Id_Announcement);
                                            $rows++;
                            ?>
                                            <tr id=<?= 'row_'.$rows?>>
                                                <td class="td-name"><?=$candidate->Name?></td>
                                                <td class="td-lastname"><?=$candidate->Lastname?></td>
                                                <td class="td-cname"><?=$announcement->Company_Name?></td>
                                                <td class="td-action">
                                                    <div class="row-card">
                                                        <button class="validate-btn" onclick="validate(
                                                            '<?='row_'.$rows ?>',
                                                            '<?=$applied_candidateInfo[$i]->Id_Candidate ?>',
                                                            '<?=$applied_candidateInfo[$i]->Id_Announcement ?>'
                                                            )">
                                                            Validate
                                                        </button>
                                                        <button class="refuse-btn" onclick="refuse(
                                                            '<?='row_'.$rows ?>',
                                                            '<?=$applied_candidateInfo[$i]->Id_Candidate ?>',
                                                            '<?=$applied_candidateInfo[$i]->Id_Announcement ?>'
                                                            )">
                                                            Refuse
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                            <?php 
                                        }
                                    }
                                }
                            ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
    <script src="views/js/validate-apply-btn.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }













