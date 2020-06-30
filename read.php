<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$response = array();



$conn = new mysqli('localhost', 'root', 'hitler@12', 'iot_cloud');
    $result = mysqli_query($conn, "SELECT * FROM (weather)");

if(mysqli_num_rows($result)>0){
    $response["weather"] = array();

    while ($row = mysqli_fetch_array( $result)){
        $weather = array();
        $weather["id"] = $row["id"];
        $weather["temp"] = $row["temp"];
        $weather["hum"] = $row["hum"];

        array_push($response["weather"], $weather);
    }
    $response["success"] = 1;

    echo json_encode($response);
}
else{
    $response["message"]="Something went wrong";
    echo json_encode($response);
}

?>