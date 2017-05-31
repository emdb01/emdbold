<?php
include("config.php");
$response = array();
    $techlist = "SELECT * FROM `technologies` order by `id` ASC "; 
    $techlist_result = $conn->query($techlist);
    if ($techlist_result->num_rows > 0) {
        $response['technologies']=array();    
        while( $techlist_result1 = $techlist_result->fetch_assoc()){
            $technology = array();
            $technology["name"] = $techlist_result1['name'];
            array_push($response['technologies'], $technology);        
        }
        $response["success"] = 1;
        echo json_encode($response);
    }else {
        $response["success"] = 0;
        echo json_encode($response);
    }
