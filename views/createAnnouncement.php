
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';

    require_once 'controllers/troque_chaine.php';
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
                <form action="" method="POST">
                    <h1>Create Announcement</h1>
                    <div class="input-card">
                        <label for="title">Title</label>
                        <input id="title" type="text">
                    </div>
                    <div class="input-card">
                        <label for="workplace">Workplace</label>
                        <input id="workplace" type="text">
                    </div>
                    <div class="input-card">
                        <label for="schedule">Schedule</label>
                        <input id="schedule" type="text">
                    </div>
                    <div class="input-card">
                        <label for="salary">Salary</label>
                        <input id="salary" type="text">
                    </div>
                    <div class="input-card">
                        <label for="jobDescription">Job Description</label>
                        <textarea id="jobDescription"></textarea>
                    </div>
                    <div class="send-btn">
                        <button>Send</button>
                    </div>
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















