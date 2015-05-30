<?php

session_start();
/*
 * Account Controller
 */

require_once 'model.php';

if (isset($_POST['action'])) {
    $actionsent = filterString($_POST['action']);
} elseif (isset($_GET['action'])) {
    $actionsent = filterString($_GET['action']);
}

switch ($actionsent) {
    case 'loginfailure':
        $message = 'You must be logged in.';
        include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
        break;

    case 'adminonly':
        $message = 'You must be an admin to access page.';
        include $_SERVER['DOCUMENT_ROOT'] . '/index.php';
        break;

    case 'admin':
        admincheck();
        $users = getusers();
        include 'users.php';
        break;
    case 'Regform':
        include 'register.php';
        break;

    case 'gallery':
        logincheck();
        include $_SERVER['DOCUMENT_ROOT'] . "/gallery/index.php";
        break;

    case 'contact':
        include $_SERVER['DOCUMENT_ROOT'] . "/contact/index.php";
        break;

    case 'about':
        include $_SERVER['DOCUMENT_ROOT'] . "/about/index.php";
        break;

    case 'home':
        include $_SERVER['DOCUMENT_ROOT'] . "/index.php";
        break;


    case 'fullview':
        logincheck();
        $imageID = filterNumber($_GET['imageID']);
        $fullimage = getImage($imageID);
        $title = 'Image';
        include $_SERVER['DOCUMENT_ROOT'] . '/gallery/full_view.php';
        break;

    case 'grid':
        logincheck();
        $catID = filterNumber($_GET['category']);
        $images = getImagesByCategory($catID);
        $catName = getCategory($catID);
        $title = 'Categories';
        include $_SERVER['DOCUMENT_ROOT'] . '/gallery/grid.php';
        break;


    case 'siteplan':
        include $_SERVER['DOCUMENT_ROOT'] . "/assignments/siteplanphoto.php";
        break;

    case 'presentation':
        include $_SERVER['DOCUMENT_ROOT'] . "/assignments/teaching_presentation.php";
        break;

    case 'Register':
        // Process the registration
        // Collect data
        $firstname = filterString($_POST['first_name']);
        $lastname = filterString($_POST['last_name']);
        $emailaddress = validateEmail($_POST['emailaddress']);
        $password = filterString($_POST['password']);

        // validate the data
        if (empty($firstname) || empty($lastname) || empty($emailaddress) || empty($password)) {
            // message to tell the registrant something is wrong
            $message = 'All fields are required. Please make sure that all fields have valid entries.';
        }
        // Check for errors, return to be fixed
        if (isset($message)) {
            $errors = [$firstname, $lastname, $emailaddress]; // use to repopulate the form
            include 'register.php'; // Send back to register for repair
            exit; // stop all further processing on this page
        }
        // No errors found, process the registration
        // Check for existing email address
        $existingEmail = getEmail($emailaddress);
        if ($existingEmail) {
            $message = "Sorry, you cannot register using the provided Email address, please choose another or try <a href=\".?action=login\" title='Go to login page'>logging in</a>.";
            $errors = [$firstname, $lastname, $emailaddress];
            include 'register.php';
            exit;
        }
        $password = hashPassword($password); // hash the password
        $insertResult = adduser($firstname, $lastname, $emailaddress, $password);

        if ($insertResult) {
            $message = '<p class="notice">Thank you ' . $firstname . ' you have been registered.</p>';
        } else {
            $message = '<p class="notice">Sorry, ' . $firstname . ' the registration failed.</p>';
        }
        include 'register.php';
        break;
    default:
        // Deliver the registration form
        $title = 'Register';
        include 'register.php';
        break;
//  **************************************LOGIN*****************************************************    
    case 'login':
        include 'login.php';
        break;

    case 'Login':
        // Process the login attempt
        // Get Data
        $emailaddress = validateEmail($_POST['emailaddress']);
        $password = filterString($_POST['password']);
        // Check the data
        if (empty($emailaddress) || empty($password)) {
            $message = 'You must supply an email address and password.';
        }

        // If errors, return for repair
        if (isset($message)) {
            include '../index.php';
            exit;
        }

        // Proceed with login attempt, if no errors
        // Get the data from the database based on the email address
        $loginData = loginuser($emailaddress, $password);

        $hashedPassword = $loginData['Password'];
        // Compare the passwords for a match
        $passwordMatch = comparePassword($password, $hashedPassword);

        // If there is a match, do the login
        if ($passwordMatch) {
            // Use the session for login data
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['firstname'] = $loginData['FirstName'];
            $_SESSION['userID'] = $loginData['UserID'];
            //FOR ADMIN VERIFICATION
            if ($loginData['Admin'] == 'admin') { //'Admin' is needing to match column name in database
                $_SESSION['admin'] = TRUE;
            }
            // Indicate that the login was a success
            $message = $loginData['FirstName'] . ', you have logged in.';
//  $title = 'Users';
            if ($_SESSION['loggedin'] == TRUE) {
//                include $_SERVER['DOCUMENT_ROOT'] . "/gallery/index.php";
                header('location: /lynn/index.php?action=gallery');
            }
//   include '/index.php';
            exit;
        } else {
            // There was not a match, tell the user 
            $message = 'I\'m sorry, but you could not be logged in.';
//   $title = 'Login';
            include $_SERVER['DOCUMENT_ROOT'] . "/index.php";
            exit;
        }
        break;

//  **************************LOGOUT******************************************************
    case 'logout':
        // Process the logout
        // Remove the login data from the session
        $_SESSION['loggedin'] = FALSE;
        $_SESSION['firstname'] = NULL;
        $_SESSION['userID'] = NULL;
        session_destroy();
        // send to home page
        header('location: /');
        break;

//**************************update*****************************************
    case 'update':
        logincheck();
        // Request for the Update form
        // Get the data for the view
        $userID = filterNumber($_GET['eduser']);  // Sent with link 'UserID' was holding cust , dont know where cust is coming from.
        $userData = getuser($userID);
        $title = 'Update';
        include 'update.php';
        break;

    case 'Update':
        logincheck();
        // Process the update
        $firstname = filterString($_POST['firstname']);
        $lastname = filterString($_POST['lastname']);
        $emailaddress = filterString($_POST['emailaddress']);
        $password = filterString($_POST['password']);
        $admin = filterString($_POST['status']);
        $userID = filterNumber($_POST['userID']);
        // validate the data
        if (empty($firstname) || empty($lastname) || empty($emailaddress)) {
            // message to tell the registrant something is wrong
            $message = 'Firstname, Lastname and Email fields are required. Please make sure that all fields have valid entries.';
        }
        // Check for errors, return to be fixed
        if (isset($message)) {
            $errors = [$firstname, $lastname, $emailaddress, $userID]; // use to repopulate the form - including sending back the neccessary key
            include 'update.php'; // Send back to register 
            exit;
        }
        // No errors, process it
        // hash the new password, only if a new password has been submitted
        if (!empty($password)) {
            $password = hashPassword($password);
        }
        $updateResult = updateUser($userID, $firstname, $lastname, $emailaddress, $password, $admin);
        // Find out the result, notify client
        if ($updateResult) {
            $message = '<p class="notice">The update for ' . $firstname . ' was successful.</p>';
        } else {
            $message = '<p class="notice">Sorry, the update for ' . $firstname . ' failed.</p>';
        }
        $users = getusers();
        $title = 'Users';
        include 'users.php';
        break;

//  *******************************delete*************************************

    case 'delete':
        admincheck();
        // Process the delete
        $firstname = filterString($_GET['firstname']);
        $userID = filterNumber($_GET['eduser']);
        // process it
        $deleteResult = deleteUser($userID);
        // Find out the result, notify client
        if ($deleteResult) {
            $message = '<p class="notice">The delete for ' . $firstname . ' was successful.</p>';
        } else {
            $message = '<p class="notice">Sorry, the delete for ' . $firstname . ' failed.</p>';
        }
        $users = getusers();
        $title = 'Users';
        include 'users.php';
        break;


    //********************************Upload IMAGE**************************************
    case 'upload':
        admincheck();
        $categories = getCategories();
        include $_SERVER['DOCUMENT_ROOT'] . "/lynn/upload.php";
        break;

    case 'updateimg':
        admincheck();
        $imageID = ($_POST['imageID']);
        $catID = ($_POST['catID']);
        $alt = filterString($_POST['alt']);
        updateImg($imageID, $catID, $alt);

        header('location: /lynn/index.php?action=grid&category=' . $catID);
        break;

    case 'updateimgform':
        admincheck();
        $categories = getCategories();

        $imageID = ($_GET['imageID']);
        $image = getImage($imageID);
        include $_SERVER['DOCUMENT_ROOT'] . "/lynn/updateimage.php";
        break;

//        include $_SERVER['DOCUMENT_ROOT'] . "/lynn/upload.php";
    //  *******************************deleteImg*************************************
    case 'deleteImg':
        admincheck();
        $imageID = filterNumber($_GET['edimg']);
        $catID = getImageCategory($imageID);
        $deletion = deleteImage($imageID);
        if ($deletion) {
            $message = '<p class="notice">The delete was successful.</p>';
        } else {
            $message = '<p class="notice">Sorry, the delete failed.</p>';
        }
        $images = getImagesByCategory($catID);
        include $_SERVER['DOCUMENT_ROOT'] . "/gallery/grid.php";
        break;


    case 'Upload':
        
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/img/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imgURL = '/img/'.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
//        if ($_FILES["fileToUpload"]["size"] > 5000000) {
//            echo "Sorry, your file is too large.";
//            $uploadOk = 0;
//        }
// Allow certain file formats
//        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//            $uploadOk = 0;
//        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $alt = $_POST['altForImage'];
        $catID = $_POST['catID'];
        echo $alt;
        
        $image = addImage($catID,$imgURL, $alt);
        header("location: /lynn/index.php?action=fullview&imageID=".$image);
        break;
}

