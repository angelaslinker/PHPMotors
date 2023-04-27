<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the vehicle model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// require_once '../model/vehicles-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = navBarPopulate($classifications);


$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
 }

 switch($action) {

    case 'deliverClassificationForm':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;

    case 'addClassification':
        $classificationName = filter_input (INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING) ;
    //check data
    if (empty ($classificationName)) {
        $message = '<p class="center">Please provide information for all empty form fields.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        exit;
    }

    //add to database
    $classifAdded = addClassification($classificationName);

    if ($classifAdded) {
        header('Location: /phpmotors/vehicles/');
    } else {
        $message = '<p class="center">An error occured while adding the new classification to the database, please try again later.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classificaton.php';
        exit;
    }
    break;
    case 'addVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));        
        

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit; 
        }

        $vehicleAdded = addVehicles($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if ($vehicleAdded) {
            $message = '<p class="center">Added succesfully</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        } else {
            $message = '<p class="center">The vehicle could not be added, try again later.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }
    
        break;
    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
        exit;
        break;


    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        if (empty($classificationId) || empty($invMake) || empty($invModel) 
        || empty($invDescription) || empty($invImage) || empty($invThumbnail)
        || empty($invPrice) || empty($invStock) || empty($invColor)) {
        $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
        exit;
    }

    $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
    if ($updateResult) {
        $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
    } else {
        $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
            exit;}
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-delete.php';
            exit;
        break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName');
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php';
        exit;
        break;

    case 'pullVehicleData':
        $vehicleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $vehicleDetail = getInvItemInfo($invId);
        $thumbnails = getVehicleThumbnail($invId);
        $_SESSION['message'] = null;
        if(count($invInfo)<1) {
                $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
            }
        else {
            $vehicleDetailDisplay = vehicleDetailPage($vehicleDetail, $thumbnails);
          }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
        exit;
        break;
          


        default:
            $classificationList = buildClassificationList($classifications);
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            break;
     }