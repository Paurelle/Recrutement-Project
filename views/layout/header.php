
<?php
    ob_start();
    session_start();
?>

<header id="header">
    <div class="row">
        <a href="<?php echo $linkNavHome ?>"><h2>TRT Conseil</h2></a>
        <nav id="nav" class="nav">
            <button id="btn-mobile" class="btn-mobile" aria-label="Open Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                <span class="hamburger"></span>
            </button>
            <ul class="menu" role="menu">
                <li><a href="<?php echo $linkNavHome ?>">Home</a></li>
                <?php if (!isset($_SESSION['userId'])) : ?>
                    <li><a href="<?php echo $linkNavLogin ?>">Login</a></li>

                <?php elseif ($_SESSION['userRole'] == 1) : ?>
                    <li><a href="<?php echo $linkCreateAnnouncement ?>">Create Announcement</a></li>
                    <li><a href="<?php echo $linkRecruiterProfile ?>">Profile</a></li>
                    <li><a href="controllers/Users.php?q=logout">Logout</a></li>

                <?php elseif ($_SESSION['userRole'] == 2) : ?>
                    <li><a href="<?php echo $linkCandidateProfile ?>">Profile</a></li>
                    <li><a href="controllers/Users.php?q=logout">Logout</a></li>

                <?php elseif ($_SESSION['userRole'] == 3) : ?>
                    <li class="validate">Validate
                        <ul class="under-menu">
                            <li><a href="<?php echo $linkValidateAnnouncement ?>">Validate Announcement</a></li>
                            <li><a href="<?php echo $linkValidateAccount ?>">Validate Account</a></li>
                            <li><a href="<?php echo $linkValidateApply ?>">Validate Apply</a></li>
                        </ul>
                    </li>
                    <li><a href="controllers/Users.php?q=logout">Logout</a></li>

                <?php elseif ($_SESSION['userRole'] == 4) : ?>
                    <li class="validate">Validate
                        <ul class="under-menu">
                            <li><a href="<?php echo $linkValidateAnnouncement ?>">Validate Announcement</a></li>
                            <li><a href="<?php echo $linkValidateAccount ?>">Validate Account</a></li>
                            <li><a href="<?php echo $linkValidateApply ?>">Validate Apply</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $linkCreateConsultant ?>">Create Consultant</a></li>
                    <li><a href="controllers/Users.php?q=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<?php
    $header = ob_get_clean();
    
