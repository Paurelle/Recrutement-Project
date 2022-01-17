
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
    <link rel="stylesheet" href="views/css/validateApply.css">
    
    <title>Validate Apply</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Validate Apply</h1>
                <div class="box-candidate-apply">
                    <div class="table-content">
                        <table class="list-candidate">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Company name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-name">paurelle</td>
                                    <td class="td-lastname">threy</td>
                                    <td class="td-cname">forge</td>
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















