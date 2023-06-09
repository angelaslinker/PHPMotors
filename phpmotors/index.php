<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';



// Get the array of classifications
$classifications = getClassifications();
$navList = navBarPopulate($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
 }

 // Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
   }
   
switch ($action){
    case 'register-page':
        include 'view/registration.php';
        break;
    case 'login-page':
        include 'view/login.php';
        break;
    case 'deliverClassificationForm';
        include 'view/add-classification.php';
    default:
        include 'view/home.php';
}


