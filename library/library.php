<?php


function lynnpageUser(){
$server = 'localhost';
$username = 'lynnpage_iUser';
$password = 'S10truck!!';
$database = 'lynnpage_final';
$dsn = "mysql:host=$server; dbname=$database";
$option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $lynnpage = new PDO($dsn, $username, $password, $option);
} catch (PDOException $exc) {
    $message = '<p> Sorry the server had a nervous breakdown and cannot do what it needs to.</p>';
    $_SESSION['message'] = $message;
    header('location: /errordocs/500.php');
}
    if(is_object($lynnpage)){
        return $lynnpage;      
    } 
    return false;   
}

//Connect to Guitar1 DB using the admin proxy.
function lynnpageAdmin(){
$server = 'localhost';
$username = 'lynnpage_iAdmin';
$password = 'S10truck!!';
$database = 'lynnpage_final';
$dsn = "mysql:host=$server; dbname=$database";
$option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $lynnpageAdmin = new PDO($dsn, $username, $password, $option);
} catch (PDOException $exc) {
    $message = '<p> Sorry the server had a nervous breakdown and cannot do what it needs to.</p>';
    $_SESSION['message'] = $message;
    header('location: /errordocs/500.php');
}
    if(is_object($lynnpageAdmin)){
        return $lynnpageAdmin;      
    } 
    return false;
}

//************************************************************
// Use with registration and update (if password is being updated)
function hashPassword($password) {
    $salt = '$6$rounds=9000$' . substr(md5(uniqid(rand(), true)), 0, 16); // SHA-512   
    return crypt($password, $salt); // Result is ~120 character password including salt
}
// Use with login, remember that the password must be queried out of the database first
function comparePassword($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}

function filterNumber($number){
 $number = filter_var(trim($number), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $number = filter_var($number, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
 return $number;
}

function filterString($string){
    $string = filter_var(trim($string), FILTER_SANITIZE_STRING); // Encodes special chars
 // $string = filter_var(trim($string), FILTER_SANITIZE_SPECIAL_CHARS); // Removes a small list of special chars
 // $string = filter_var(trim($string), FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Removes all special chars
    return $string;
}

function validateEmail($email){
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    return $email;
}

function logincheck(){
    if ($_SESSION['loggedin']!=TRUE){
        header('location:/lynn/index.php?action=loginfailure');
        exit;
    }
}
function admincheck(){
    logincheck();
    if ($_SESSION['admin']!=TRUE){
        header('location:/lynn/index.php?action=adminonly');
        exit;
    }
}

function upload_file($name) {
  // Gets the pathes, full and local directory
 global $image_dir, $image_dir_path;
 if (isset($_FILES[$name])) {
   // Gets the actual file name
  $filename = $_FILES[$name]['name'];
  if (empty($filename)) {return;}
  // Get the file from the temp folder on the server
  $source = $_FILES[$name]['tmp_name'];
  // Sets the new path - images folder in this directory
  $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
  // Moves the file to the target folder
  move_uploaded_file($source, $target);
  // Creates a tumbnail of the image
  process_image($image_dir_path, $filename);
  // Sets the path for the image for Database storage
  $filepath = $image_dir . DIRECTORY_SEPARATOR . $filename;
  // Returns the path where the file is stored
  return $filepath;
 }
}