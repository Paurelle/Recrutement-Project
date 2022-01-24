
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';

    require_once 'models/Recruiter.php';

    $recruiterModel = new Recruiter;
    $validateRecruiter = $recruiterModel->checkRecruiterValidation($_SESSION['userId']);

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 1) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/createAnnouncement.css">
    
    <title>Create Announcement</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Create Announcement</h1>
                <?php flash('announcement'); ?>
                <?php if ($validateRecruiter->Is_Checked == 1) { ?>
                    <form action="controllers/Announcements.php" method="POST">
                        <input type="hidden" name="type" value="register">
                        <div class="input-card">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title">
                        </div>
                        <div class="input-card">
                            <label for="company_name">Company name</label>
                            <input id="company_name" type="text" name="company_name">
                        </div>
                        <div class="input-card">
                            <label for="workplace">Workplace</label>
                            <input id="workplace" type="text" name="workplace">
                        </div>
                        <div class="input-card">
                            <label for="schedule">Schedule</label>
                            <input id="schedule" type="text" name="schedule">
                        </div>
                        <div class="input-card">
                            <label for="salary">Salary</label>
                            <input id="salary" type="text" name="salary">
                        </div>
                        <div class="input-card">
                            <label for="jobDescription">Job Description</label>
                            <textarea id="jobDescription" name="description"></textarea>
                        </div>
                    
                        <div class="send-btn">
                            <button>Send</button>
                        </div>
                <?php
                    }else{
                        redirect("recruiterProfile.php");
                    }
                ?>
                        
                </form>
            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
</body>
</html>

<?php
    }else{
        redirect("index.php");
    }













