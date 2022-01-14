
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
    <link rel="stylesheet" href="views/css/candidateProfile.css">
    
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
                <div class="row-card">
                    <p>Name Lastname</p>
                    <div class="modify-btn">
                        <button>Modify</button>
                    </div>
                </div>
                <div class="row-card">
                    <p>Email</p>
                </div>
                <div class="row-card">
                    <p>CV</p>
                </div>
            </article>

        </section>
    </main>

    <!-- Footer -->
    <footer>

    </footer>

    <script src="views/js/btn-mobile.js"></script>
</body>
</html>















