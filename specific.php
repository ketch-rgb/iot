<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();

$conn = new mysqli('localhost', 'root', 'hitler@12', 'iot_cloud');
if (isset($_GET["id"])) {
    $id = $_GET['id'];
 
     // Fire SQL query to get weather data by id
    $result = mysqli_query($conn, "SELECT *FROM weather WHERE id = '$id'");
	
	//If returned result is not empty
    if (!empty($result)) {
        // Check for succesfull execution of query and no results found
        if (mysqli_num_rows($result) > 0) {
			
			// Storing the returned array in response
            $result = mysqli_fetch_array($result);
			
			// temperoary user array
            $weather = array();
            $weather["id"] = $result["id"];
            $weather["temp"] = $result["temp"];
			$weather["hum"] = $result["hum"];
          
            $response["success"] = 1;
            $response["weather"] = array();
			
			// Push all the items 
            array_push($response["weather"], $weather);
 
            // Show JSON response
            echo json_encode($response);
        } else {
            // If no data is found
            $response["success"] = 0;
            $response["message"] = "No data on weather found";
 
            // Show JSON response
            echo json_encode($response);
        }
    } else {
        // If no data is found
        $response["success"] = 0;
        $response["message"] = "No data on weather found";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // echoing JSON response
    echo json_encode($response);
}

?>