<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete | LynnPagelPhotography.com</title>
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

                <h1>Delete</h1>
                <?php
                if (isset($message)) {
                    echo '<p class="notice">' . $message . '</p>';
                }
                ?>

                <p><strong>Be Careful! A Delete cannot be undone!</strong></p>
                <form action="." method="post" id="deleteform">
                    <fieldset>
                        <label for="firstname">Firstname:</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $userData['FirstName'] ?>" readonly>
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $userData['LastName'] ?>" readonly>
                        <label for="emailaddress">Email Address:</label>
                        <input type="email" name="emailaddress" id="emailaddress" value="<?php echo $userData['Email'] ?>" readonly>
                        <label>&nbsp;</label>
                        <input type="submit" name="action" id="action" value="Delete">
                        <input type="hidden" name="userID" value="<?php echo $userData['UserID'] ?>">
                    </fieldset>
                </form>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>