
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
    <link rel="stylesheet" href="views/css/recruiterProfile.css">
    
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
                <div class="row-card">
                    <p>Company name</p>
                    <div class="modify-btn">
                        <button>Modify</button>
                    </div>
                </div>
                <div class="row-card">
                    <p>Company adress</p>
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
                </section>
            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
</body>
</html>















