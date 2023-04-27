<?php

/* 
* Main PHPMotors Model
*/
ini_set('display_errors', '1');
function getClassifications(){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT * FROM carclassification ORDER BY classificationName ASC';
    // The next line creates the prepared statement using the phpmorots connection
    $stmt = $db->prepare($sql);
    //the next line runs the prepared statement
    $stmt->execute();
    //The next line gets the data from the database and
    //stores it in an array in the $classifications variable
    $classifications = $stmt->fetchALL();
    // the next line sends the array of data back to where the function
    //was called (this should be the controller)
    return $classifications;
}