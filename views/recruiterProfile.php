
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';

    require_once 'models/User.php';

    $userModel = new User;
    $userInfo = $userModel->findUserInfoRecruiter($_SESSION['userId']);

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
                    <div class="button-card-section">
                        <button>Create announcement</button>
                    </div>
                    
                    <a href="announcementDetails.php">
                        <article class="card-2">
                            <form action="" method="POST">
                                <h2>Title</h2>
                                <div class="row-card-2">
                                    <p>company name</p>
                                    <p>Salary</p>
                                </div>
                                <div class="row-card-2">
                                    <p>workplace</p>
                                    <p>schedule</p>
                                </div>
                                <div class="box-description">
                                    <p>job description</p>
                                </div>
                            </form>
                        </article>
                    </a>

                    <a href="announcementDetails.php">
                        <article class="card-2">
                            <form action="" method="POST">
                                <h2>Title</h2>
                                <div class="row-card-2">
                                    <p>company name</p>
                                    <p>Salary</p>
                                </div>
                                <div class="row-card-2">
                                    <p>workplace</p>
                                    <p>schedule</p>
                                </div>
                                <div class="box-description">
                                    <p>job description</p>
                                </div>
                            </form>
                        </article>
                    </a>
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















