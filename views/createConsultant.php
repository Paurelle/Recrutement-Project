
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';

    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == 4) {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/createConsultant.css">
    
    <title>Create Consultant</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Create Consultant</h1>
                <?php flash('register'); ?>
                <form action="controllers/Admins.php" method="POST">
                    <input type="hidden" name="type" value="register">
                    <div class="input-card">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email">
                    </div>
                    <div class="input-card">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password">
                    </div>
                    <div class="input-card">
                        <label for="confirm-password">Confirm Password</label>
                        <input id="confirm-password" type="password" name="confirm-password">
                    </div>
                    <div class="register-btn">
                        <button type="submit">Send</button>
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

<?php
    }else{
        redirect("index.php");
    }














