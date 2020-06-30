<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();

if (isset($_GET['temp']) && isset($_GET['hum'])){
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];

    

    $conn = new mysqli('localhost', 'root', 'hitler@12', 'iot_cloud');
    $result = mysqli_query($conn, "INSERT INTO weather (temp,hum)  VALUES('$temp', '$hum')");
    if($result){
        $response["success"] = 1;
        $response["message"] = "Weather successfully created.";

        echo json_encode($response);
    } else{
        $response["success"]=0;
        $response["message"]="something has gone wrong";
        echo json_encode($response);
    }
} else{
    $response["success"]=0;
    $response["message"]="parameter(s) are missing. Please check the request";
    echo json_encode($response);
}
?>