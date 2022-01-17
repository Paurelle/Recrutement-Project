
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
    <link rel="stylesheet" href="views/css/validateAccount.css">
    
    <title>Validate Account</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Validate Account</h1>
                <div class="box-candidate-apply">
                    <div class="table-content">
                        <table class="list-candidate">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-email">paurellepaurelle@paurellepaurelle</td>
                                    <td class="td-role">candidate</td>
                                    <td class="td-action">
                                        <form action="">
                                            <div class="row-card">
                                                <button class="validate-btn">Validate</button>
                                                <button class="refuse-btn">Refuse</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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















