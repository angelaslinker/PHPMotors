<?php


session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/search-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = navBarPopulate($classifications);


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
 }

//  switch($action){
//     case 'search':
//         $str = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $search = isset($str) ? trim($str) : '';
//         $search = cleanChars($str);

//         // Get the page number from the query string and calculate the start index of the results to display
//         $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
//         $start = ($page - 1) * 10;

//         // Send the data to the model
//         $searchOutcome = searchInventory($search, $start);

//         // Calculate the total number of search results
//         $totalResults = count(searchInventory($search));

//         // Check for missing data
//         if(empty($search)){
//             $message = '<p>Please enter search information.</p>';
//             include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';

//         } else if (!count($searchOutcome)) {
//             $searchMessage = "<p class='notice'>No search results were returned.</p>";
//             include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';

//         } else {
//             $searchDisplay = buildSearchDisplay($searchOutcome);
//             $pagination = buildPagination($totalResults, $page);
//         }

//         include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
//         exit;
//         break;

//     default:
//         $classificationList = buildClassificationList($classifications);
//         include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
//         exit;
//         break;
// }
switch($action){
    case 'search':
        $str = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $search = isset($str) ? trim($str) : '';
        $search = cleanChars($str);

        // Get the page number from the query string and calculate the start index of the results to display
        $page = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
        $page = $page ? $page : 1; // Default to page 1 if no page number is specified
        $start = ($page - 1) * 10;

        // Send the data to the model
        $searchOutcome = searchInventory($search, $start);

        // Calculate the total number of search results
        $totalResults = count(searchInventory($search));

        // Check for missing data
        if(empty($search)){
            $message = '<p>Please enter search information.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            exit;

        } else if (!count($searchOutcome)) {
            $searchMessage = "<p class='notice'>No search results were returned.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
            exit;

        } else {
            $searchDisplay = buildSearchDisplay($searchOutcome, $page);
            $pagination = buildPagination($totalResults, $page);
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
        exit;
        break;

    default:
        $classificationList = buildClassificationList($classifications);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        exit;
        break;
}
?>