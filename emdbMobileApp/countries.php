<?php
error_reporting(E_ALL);
$response = array();
include("config.php");    
    $sql = "SELECT * FROM `countries` order by `countryName` ASC ";
    $result = $conn->query($sql);    
    if ($result->num_rows > 0) {
        $response['countries']=array();         
        while($row = $result->fetch_assoc()) {
            $country = array();
            $country["id"] = $row["idCountry"];
            $country["code"] = $row["countryCode"];
            $country["name"] = $row["countryName"];
            array_push($response['countries'], $country);
        }
        $response["success"] = 1;
        echo json_encode($response);
        //print_r($response);
    } else {
         echo "0 results";
    }
