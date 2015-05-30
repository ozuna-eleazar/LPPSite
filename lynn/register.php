<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register | LynnPagelPhotography.com</title>
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

                <h1>Registration</h1>
                <?php if (isset($message)) { ?>
                    <p>
                        <?php echo $message; ?>
                    </p>
                <?php } ?>
                <form action="." method="post" id="regform"> 
                    <fieldset id="regfield">
                        <label for="first_name">First Name:</label> <!--for in label same as id in input, that connects them-->
                        <input type="text" name="first_name" id="first_name" required value="<?php echo $errors[0] ?>"><br>
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" required value="<?php echo $errors[1] ?>"><br>
                        <label for="emailaddress">Email:</label>
                        <input type="email" name="emailaddress" id="email" required value="<?php echo $errors[2] ?>"><br>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password1"><br>
                        <label>&nbsp;</label>
                        <input type="submit" name="action" id="action1" class="button" value="Register">
                    </fieldset>
                </form>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>

</html>
