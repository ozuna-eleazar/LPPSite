<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update | LynnPagelPhotography.com</title>
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
                 
                <h1>Update</h1>
                <?php
                if (isset($message)) {
                    echo '<p class="notice">' . $message . '</p>';
                }
                ?>
                <form action="." method="post" id="updateform">
                    <p id="updateline">Only supply a password if you desire to reset the current one.</p>
              <fieldset id="updatefield">
              <label for="firstname">Firstname:</label>
              <input type="text" name="firstname" id="firstname" value="<?php if( isset($userData)){ echo $userData['FirstName']; } elseif (isset($errors)) { echo $errors[0];} ?>" required>
              <label for="lastname">Lastname:</label>
              <input type="text" name="lastname" id="lastname" value="<?php if( isset($userData)){ echo $userData['LastName']; } elseif (isset($errors)) { echo $errors[1];} ?>" required><br>
              <label for="emailaddress">Email Address:</label>
              <input type="email" name="emailaddress" id="emailaddress" value="<?php if( isset($userData)){ echo $userData['Email']; } elseif (isset($errors)) { echo $errors[2];} ?>" required>
              <label for="password">Password:</label>
              <input placeholder="New Password" type="password" name="password" id="password"><br>
               <?php if($_SESSION['admin']==TRUE) {?>
              <input type="radio" name="status" value="user" <?php if($userData['Admin']=='user')echo 'checked'; ?>>USER
              <input type="radio" name="status" value="admin" <?php if($userData['Admin']=='admin')echo 'checked'; ?>>ADMIN
              <?php } ?>
              <br><input type="submit" name="action" id="action" class="button" value="Update">
              <input type="hidden" name="userID" value="<?php if( isset($userData)){ echo $userData['UserID']; } elseif (isset($errors)) { echo $errors[3];} ?>">          
            </fieldset>
          </form>
            </main>
        </div>
        <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>
</html>