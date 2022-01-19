
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
    <link rel="stylesheet" href="views/css/home.css">
    
    <title>Home</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>

        <h1>Announcement</h1>

        <?php if (!isset($_SESSION['usersId'])) : ?>
            <p>non conecter</p>
            
            <?php else : ?>
            <p>Welcome, <?php echo explode(" ", $_SESSION['usersEmail'])[0];?></p>
            <?= $_SESSION['usersRole'] ?>
            
        <?php endif; ?>

        <section class="cards">

            <a href="announcementDetails.php">
                <article class="card">
                    <form action="" method="POST">
                        <h2>Title</h2>
                        <div class="row-card">
                            <p>company name</p>
                            <p>Salary</p>
                        </div>
                        <div class="row-card">
                            <p>workplace</p>
                            <p>schedule</p>
                        </div>
                        <div class="box-description">
                            <p>job description</p>
                        </div>
                        <button>Apply</button>
                    </form>
                </article>
            </a>

            <a href="announcementDetails.php">
                <article class="card">
                    <form action="" method="POST">
                        <h2>Title</h2>
                        <div class="row-card">
                            <p>company name</p>
                            <p>Salary</p>
                        </div>
                        <div class="row-card">
                            <p>workplace</p>
                            <p>schedule</p>
                        </div>
                        <div class="box-description">
                            <p>job description</p>
                        </div>
                        <button>Apply</button>
                    </form>
                </article>
            </a>

            <a href="announcementDetails.php">
                <article class="card">
                    <form action="" method="POST">
                        <h2>Title</h2>
                        <div class="row-card">
                            <p>company name</p>
                            <p>Salary</p>
                        </div>
                        <div class="row-card">
                            <p>workplace</p>
                            <p>schedule</p>
                        </div>
                        <div class="box-description">
                            <p>job description</p>
                        </div>
                        <button>Apply</button>
                    </form>
                </article>
            </a>

            <a href="announcementDetails.php">
                <article class="card">
                    <form action="" method="POST">
                        <h2>Title</h2>
                        <div class="row-card">
                            <p>company name</p>
                            <p>Salary</p>
                        </div>
                        <div class="row-card">
                            <p>workplace</p>
                            <p>schedule</p>
                        </div>
                        <div class="box-description">
                            <p>job description</p>
                        </div>
                        <button>Apply</button>
                    </form>
                </article>
            </a>

            <a href="announcementDetails.php">
                <article class="card">
                    <form action="" method="POST">
                        <h2>Title</h2>
                        <div class="row-card">
                            <p>company name</p>
                            <p>Salary</p>
                        </div>
                        <div class="row-card">
                            <p>workplace</p>
                            <p>schedule</p>
                        </div>
                        <div class="box-description">
                            <p>job description</p>
                        </div>
                        <button>Apply</button>
                    </form>
                </article>
            </a>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
</body>
</html>















