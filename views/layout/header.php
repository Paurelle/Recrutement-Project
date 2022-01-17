
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
                <?php if (!isset($_SESSION['adminId'])) : ?>
                    <li><a href="<?php echo $linkNavHome ?>">Home</a></li>
                    <li><a href="<?php echo $linkNavLogin ?>">Login</a></li>
                    <li><a href="<?php echo $linkCreateAnnouncement ?>">Create Announcement</a></li>
                    <li><a href="<?php echo $linkCreateConsultant ?>">Create Consultant</a></li>
                    <li><a href="<?php echo $linkCandidateProfile ?>">Profile</a></li>
                    <li><a href="<?php echo $linkRecruiterProfile ?>">Profile</a></li>
                    <li class="validate">Validate
                        <ul class="under-menu">
                            <li><a href="<?php echo $linkValidateAnnouncement ?>">Validate Announcement</a></li>
                            <li><a href="<?php echo $linkValidateAccount ?>">Validate Account</a></li>
                            <li><a href="<?php echo $linkValidateApply ?>">Validate Apply</a></li>
                        </ul>
                    </li>
                    
                    
                <?php else : ?>
                    <li><a href="<?php echo $linkNavHome ?>">Home</a></li>
                    <li><a href="<?php echo $linkNavAdminPanel ?>">Admin panel</a></li>
                    <li><a href="controllers/Admins.php?q=logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<?php
    $header = ob_get_clean();
    
