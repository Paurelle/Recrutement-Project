
<?php
    require_once 'links/links.php';
    
    require_once 'layout/header.php';
    require_once 'Controllers/Helpers/session_helper.php';

    if (!isset($_SESSION['usersId'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/header/navbar.css">
    <link rel="stylesheet" href="views/css/login.css">
    
    <title>Login</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Log in</h1>
                <?php flash('login'); ?>
                <form action="controllers/Users.php" method="POST">
                    <input type="hidden" name="type" value="login">
                    <div class="input-card">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email">
                    </div>
                    <div class="input-card">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password">
                    </div>
                    <div class="login-btn">
                        <button>Login</button>
                    </div>
                    <div class="link-register">
                        <a href="register.php">You do not have an account ?</a>
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





