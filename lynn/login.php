<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home | LynnPagelPhotography.com</title>
        <link href="/css/screen.css" type="text/css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div id="container">
            <header>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/login.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
            </header>
            <main>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php'; ?>
                <h1>Welcome, please login</h1>
                
                    <?php if ($_SESSION['loggedin'] != TRUE) { ?>
                        <form method="post" action="." id="loginForm">
                            <fieldset id="logfield">
                                <label for="emailaddress">Email Address:</label>
                                <input type="email" name="emailaddress" id="emailaddress" required>
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" required>
                                <label>&nbsp;</label>
                                <input type="submit" name="action" id="action" class="button" value="Login">
                                <!--<a href="/lynn/index.php?action=Regform">Register</a>-->
                            </fieldset>

                        </form>
                        <?php
                    } else {
                        echo '<a href="/lynn/index.php?action=logout">LOGOUT!</a><br><br>';
                        echo '<a href="/lynn/index.php?action=update&amp;eduser=' . $_SESSION['userID'] . '">My Profile!</a>';
                    }
                    if (isset($message)) {
                        ?>
                        <p>
                            <?php echo $message; ?>
                        </p>
                    <?php } ?>
                

            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>


