
<?php
    require_once 'links/links.php';

    require_once 'layout/header.php';

    require_once 'controllers/troque_chaine.php';

    require_once 'models/User.php';
    require_once 'models/Role.php';
    require_once 'models/Recruiter.php';
    require_once 'models/Candidate.php';

    $userModel = new User;
    $usersInfo = $userModel->UsersInfo();

    $roleModel = new Role;
    $recruiterModel = new Recruiter;
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
    <link rel="stylesheet" href="views/css/validateAccount.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Validate Account</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Validate Account</h1>
                <div class="box-candidate-apply">
                    <div class="table-content">
                        <table class="list-candidate">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $rows = 0;
                                for ($i=0; $i < count($usersInfo); $i++) { 
                                    if ($usersInfo[$i]->Id_Role == 1 || $usersInfo[$i]->Id_Role == 2) {

                                        switch ($usersInfo[$i]->Id_Role) {
                                            case 1:
                                                $row = $recruiterModel->checkRecruiterValidation($usersInfo[$i]->Id_User);
                                                break;
                                            case 2:
                                                $row = $candidateModel->checkCandidateValidation($usersInfo[$i]->Id_User);
                                                break;
                                        }

                                        if ($row->Is_Checked == 0) {
                                            $rows++;
                            ?>
                                            <tr id=<?= 'row_'.$rows?>>
                                                <td class="td-email"><?=$usersInfo[$i]->Email ?></td>
                                                <?php if ($usersInfo[$i]->Id_Role == 1) : ?>
                                                    <td class="td-role"><?=$roleModel->findRole($usersInfo[$i]->Id_Role)->Role ?></td>
                                                <?php else : ?>
                                                    <td class="td-role"><?=$roleModel->findRole($usersInfo[$i]->Id_Role)->Role ?></td>
                                                <?php endif; ?>
                                                
                                                <td class="td-action">
                                                    <div class="row-card">
                                                        <button class="validate-btn" onclick="validate(
                                                            '<?='row_'.$rows ?>',
                                                            '<?=$roleModel->findRole($usersInfo[$i]->Id_Role)->Role?>',
                                                            '<?=$usersInfo[$i]->Id_User ?>'
                                                            )">
                                                            Validate
                                                        </button>
                                                        <button class="refuse-btn" onclick="refuse(
                                                            '<?='row_'.$rows ?>',
                                                            '<?=$roleModel->findRole($usersInfo[$i]->Id_Role)->Role?>',
                                                            '<?=$usersInfo[$i]->Id_User ?>'
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
    <script src="views/js/validate-account-btn.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }













