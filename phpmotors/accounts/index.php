
<?php
session_start();
//Get the database connection
require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/library/connections.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/model/main-model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/model/accounts-model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/phpmotors/library/functions.php";

// Gets the array of classifications
$classifications = getClassifications();
//Build the nav bar
$navList = '<ul>';
$navList = navBarPopulate($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
 }


 switch ($action){

    case 'login-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;

    case 'register-page':
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
      break;

    case 'admin':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        break;

    
  case 'register':
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      
      //check for email
      $existingEmail = checkExistingEmail($clientEmail);
        //handle email in registration
        if($existingEmail){
            $message = '<p>The email address already exists. Do you want to login instead?</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        //check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            $message = '<p class="notice"> Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
    }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);



        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/'); }

        //check results
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/login.php';
            exit;
        }

        break;

    case 'Login':
        $clientEmail = filter_input (INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input (INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING) ;
        //check for email
        $existingEmail = checkExistingEmail($clientEmail);

        if (empty($clientEmail) || empty($clientPassword) || !$existingEmail) {
            $_SESSION['message'] = '<p class="notice">Please provide a valid email address and password.</p>';
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/login.php';
            exit;
        }

        //Query the data based on user email address
        $clientData = getClient ($clientEmail);
        //check is passwords patch
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        if (!$hashCheck) {
            $message = '<p>Please check your password and try again.</p>';
            include '/phpmotors/view/login.php';
            exit;
        }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // send them to admin view
        
        header('Location: /phpmotors/accounts/?action=admin');
        break;

    case 'Logout':
            unset($_SESSION['loggedin']);
            unset($_SESSION['clientData']);
            session_destroy();
            header('Location: /phpmotors');
        break;

    case 'Admin':
        include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/admin.php';
        break;

    //Update the client
    case 'updateClient': 
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/client-update.php';
            exit; 
        }

        //Checking for existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        if($existingEmail && $clientEmail !== $_SESSION['clientData']['clientEmail']) {
            $_SESSION['message'] = '<p class="notice">A user with that email address already exists. Do you want to login instead?</p>';
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/client-update.php';
            exit;
        }

        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if($updateOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        
            $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
            $_SESSION['clientData']['clientLastname'] = $clientLastname;
            $_SESSION['clientData']['clientEmail'] = $clientEmail;
            $_SESSION['clientData']['clientId'] = $clientId;
    
            $_SESSION['message'] = "Thanks for updating $clientFirstname.";
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/client-update.php';
            exit;
        }


    // Update the password
    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $passwordOutcome = updatePassword($hashedPassword, $clientId);
        if($passwordOutcome === 1) {
            setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for updating your password," . $_SESSION['clientData']['clientFirstname'];
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the update failed. Please try again.</p>";
            include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/client-update.php';
            exit;
        }

    default:
        include $_SERVER["DOCUMENT_ROOT"] . '/phpmotors/view/login.php';
        break;
}






