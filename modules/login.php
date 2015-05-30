<div id="logIn">
    <?php if ($_SESSION[loggedin] != TRUE) { 
        echo '<a href="/lynn/index.php?action=login">Login</a>';
        echo '<a href="/lynn/index.php?action=regForm">Register</a>';
        ?><?php
    } else {
        echo '<a href="/lynn/index.php?action=logout">Logout</a>';
        echo '<a href="/lynn/index.php?action=update&amp;eduser=' . $_SESSION['userID'] . '">Profile</a>';
    } 
    ?>
</div>