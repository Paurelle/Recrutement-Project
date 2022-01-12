
<?php
    $linkNavHome = "index.php";
    $linkNavLogin = "login.php";
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
                <form action="" method="POST">
                    <h1>Log in</h1>
                    <div class="input-card">
                        <label for="email">Email</label>
                        <input id="email" type="text">
                    </div>
                    <div class="input-card">
                        <label for="password">Password</label>
                        <input id="password" type="password">
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















