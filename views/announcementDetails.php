
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
    <link rel="stylesheet" href="views/css/announcementDetails.css">
    
    <title>Announcement Detail</title>
</head>
<body>
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Main -->
    <main>
        <section class="cards">

            <article class="card">
                <h1>Announcement Detail</h1>
                <form action="" method="POST">
                    <h2 class="title">Title</h2>
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
                <div class="box-candidate-apply">
                    <h2 class="title">Candidate who we apply</h2>
                    <div class="test">
                        <table class="list-candidate">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>CV</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-name">paurellepaurellepaurellepaurelle</td>
                                    <td class="td-lastname">paurellepaurellepaurellepaurelle</td>
                                    <td class="td-cv"><button>Download</button></td>
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















