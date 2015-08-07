<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require $_SERVER['DOCUMENT_ROOT'] . '/library/library.php';

function adduser($firstname, $lastname, $emailaddress, $password) {
    $connection = lynnpageUser();
    try {
        $sql = 'INSERT INTO users VALUES (NULL, :FirstName, :LastName, :Email, :Password, \'user\')';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':FirstName', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':LastName', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':Email', $emailaddress, PDO::PARAM_STR);
        $stmt->bindParam(':Password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $newrows = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return FALSE;
    }
    if ($newrows) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// check for existing email as part of registration process
function getEmail($emailaddress) {
    $connection = lynnpageUser();
    try {
        $sql = "SELECT Email FROM users WHERE Email = :Email";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':Email', $emailaddress);
        $stmt->execute();
        $existingemail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
    } catch (PDOException $exc) {
        // Send to error page with message
        $message = 'Sorry, there was an internal error with the server.';
        $_SESSION['message'] = $message;
        header('location: /errordocs/500.php');
        exit;
    }
//Only if it exists
    if (!empty($existingemail)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// *********************************************************




function getusers() {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT UserID, FirstName, LastName, Email, Admin FROM users';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }

    return $users;
}

function getuser($userID) {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT UserID, LastName, FirstName, Email, Admin FROM users WHERE UserID= :UserID ORDER BY LastName, FirstName';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':UserID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $user;
}

//**************************************************************
//LOGIN USER

function loginuser($emailaddress, $password) {
    $connection = lynnpageUser();

    try {
        $sql = 'SELECT UserID, FirstName, LastName, Email, Password, Admin FROM users WHERE Email = :emailaddress';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':emailaddress', $emailaddress);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    } catch (Exception $exc) {
        return FALSE;
    }
    return $userInfo;
}

// Update data for an individual
function updateUser($userID, $firstName, $lastName, $emailaddress, $password, $admin) {
    $connection = lynnpageUser();
    try {
        // Test if there is a value for a password (it is being reset)
        if (empty($password)) {
            $sql = 'UPDATE users SET FirstName = :firstName, LastName = :lastName, Email = :emailAddress, Admin = :admin WHERE UserID = :userID';
        } else {
            $sql = 'UPDATE users SET FirstName = :firstName, LastName = :lastName, Email = :emailAddress, Password = :password, Admin = :admin WHERE UserID = :userID';
        }
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':emailAddress', $emailaddress, PDO::PARAM_STR);
        $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
        if (!empty($password)) {
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        }
        $stmt->execute();
        $updateRow = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $updateRow;
}

function deleteUser($userID) {
    $connection = lynnpageAdmin(); // Notice the new proxy (with delete privleges)
    try {
        $sql = 'DELETE FROM users WHERE UserID = :userID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $deleteRow = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return FALSE;
    }
    return $deleteRow;
}

//******************************IMAGES***********************************************

function getImages() {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT * FROM images';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $images;
}

function getImage($imageID) {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT * FROM images WHERE imageID = :imageID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':imageID', $imageID, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $image;
}

function getImagesByCategory($catID) {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT * FROM images WHERE catID = :catID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
        $stmt->execute();
        $images = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $images;
}

function deleteImage($imageID) {
    $connection = lynnpageAdmin();
    try {
        $sql = 'DELETE FROM images WHERE imageID = :imageID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':imageID', $imageID, PDO::PARAM_INT);
        $stmt->execute();
        $deleteImg = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return FALSE;
    }
    return $deleteImg;
}

function addImage($catID,$url, $alt) {
    $connection = lynnpageAdmin();
    try {
        $sql = 'INSERT INTO images VALUES (NULL, :catID, :url, :alt)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->bindParam(':alt', $alt, PDO::PARAM_STR);
        $stmt->bindParam(':catID', $catID, PDO::PARAM_STR);
        $stmt->execute();
        $newImg = $connection->lastInsertId();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return FALSE;
    }
    if ($newImg) {
        return $newImg;
    } else {
        return FALSE;
    }
}

function updateImg($imgID, $catID, $alt) {
    $connection = lynnpageAdmin();
    try {
        // Test if there is a value for a password (it is being reset)
        if (empty($password)) {
            $sql = 'UPDATE images SET catID = :catID, alt = :alt WHERE imageID = :imgID';
        }
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':imgID', $imgID, PDO::PARAM_INT);
        $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
        $stmt->bindParam(':alt', $alt, PDO::PARAM_STR);
        $stmt->execute();
        $updateRow = $stmt->rowCount();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $updateRow;
}

function getImageCategory($imageID) {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT catID FROM images WHERE imageID = :imageID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':imageID', $imageID, PDO::PARAM_INT);
        $stmt->execute();
        $catID = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $catID['catID'];
}

function getCategory($catID) {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT catName FROM categories WHERE catID = :catID';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
        $stmt->execute();
        $catName = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $catName['catName'];
}

function getCategories() {
    $connection = lynnpageUser();
    try {
        $sql = 'SELECT * FROM categories';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $categories;
}