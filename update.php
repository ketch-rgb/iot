<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['id']) && isset($_GET['status'])) {
 
    $id = $_GET['id'];
    $status= $_GET['status'];
    
 
    $conn = new mysqli('localhost', 'root', 'hitler@12', 'iot_cloud');
 
	// Fire SQL query to update LED status data by id
    $result = mysqli_query($conn, "UPDATE led SET status= '$status' WHERE id = '$id'");
 
    // Check for succesfull execution of query and no results found
    if ($result) {
        // successfully updation of LED status (status)
        $response["success"] = 1;
        $response["message"] = "LED Status successfully updated.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>