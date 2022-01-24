
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';

    require_once 'models/User.php';
    require_once 'models/Candidate.php';

    $userModel = new User;
    $userInfo = $userModel->findUserInfoCandidate($_SESSION['userId']);

    $candidateModel = new Candidate;
    $candidateInfo = $candidateModel->checkCandidateValidation($_SESSION['userId']);
    

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 2) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/candidateProfile.css">
    <script type="text/javascript" src="views/js/jquery-3.6.0.min.js"></script>
    
    <title>Candidate profile</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Candidate profile</h1>
                <?php if ($candidateInfo->Is_Checked != 1) : ?>
                    <p>Your account is awaiting validation to be able to register for the announcement. In the meantime, the announcement is temporarily blocked.</p>
                <?php endif; ?>
                
                <?php flash('profile'); ?>
                <div id="profil">
                    <div class="row-card">
                        <?php if ($userInfo->Name == null || $userInfo->Lastname == null) : ?>
                            <h2>Anunimous</h2>
                        <?php else : ?>
                            <h2><?=$userInfo->Name ." ". $userInfo->Lastname?></h2>
                        <?php endif; ?>

                        <div class="modify-btn">
                            <button onclick="display_form()">Modify</button>
                        </div>
                    </div>
                    <div class="row-card">
                        <p>Email : <?=$userInfo->Email?></p>
                    </div>
                    <div class="row-card">
                        <p>CV : <?=$userInfo->Cv_Name?></p>
                    </div>
                </div>
                
                <div id="form-profil" style="display: none;">
                    <form action="controllers/Candidates.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="modify">
                        <div class="input-card">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name">
                        </div>
                        <div class="input-card">
                            <label for="lastename">Lastname</label>
                            <input id="lastename" type="text" name="lastname">
                        </div>
                        <div class="input-card">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email">
                        </div>
                        <div class="input-card">
                            <label for="cv">Cv</label>
                            <input id="cv" type="file" name="cv">
                        </div>
                        <div class="modify-profile-btn">
                            <div class="row-card">
                                <button type="submit">Validate</button>
                                <button type="button" onclick="display_form()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
    <script src="views/js/display_form_candidate.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }













