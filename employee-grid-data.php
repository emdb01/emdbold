<?php

/* Database connection start */
include('config/config.php');

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
// datatable column index  => database column name
    0 => 'first',
    1 => 'email',
    2 => 'availability',
    4 => 'visits',
    5 => 'dateTime',
    6 => 'user_id',
    7 => ''
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM user ";
$query = mysql_query($sql) or die("employee-grid-data.php: get employees1");
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
$pos = strpos($requestData['nameSearch'], '@');
if ($pos !== false) {
    $semail = 1;
} else {
    $semail = 0;
}
if (strlen($requestData['refineSearch']) > 1 && strlen($requestData['nameSearch']) > 1) {
    $refineSearch = $requestData['refineSearch'];
    if ($semail == 0) {
        $sql = "SELECT  * ";
        if($refineSearch =='No Status'){
          $sql.=" FROM user where  role=2 and `first` LIKE  '%{$requestData['nameSearch']}%' and (`availability` = '$refineSearch' OR availability='') ";   
        }else{
         $sql.=" FROM user where  role=2 and `first` LIKE  '%{$requestData['nameSearch']}%' and `availability` = '$refineSearch' ";    
        }
       
    } else if ($semail == 1) {
        $sql = "SELECT  * ";
         if($refineSearch =='No Status'){
         $sql.=" FROM user where  role=2 and  `email` LIKE  '%{$requestData['nameSearch']}%' and (`availability`  = '$refineSearch' OR availability='') ";  
        }else{
         $sql.=" FROM user where  role=2 and  `email` LIKE  '%{$requestData['nameSearch']}%' and `availability`  = '$refineSearch' ";
        }
       
    }
} else if (strlen($requestData['refineSearch']) > 1) {
    $refineSearch = $requestData['refineSearch'];
    $sql = "SELECT  * ";
     if($refineSearch =='No Status'){
        $sql.= " FROM user where    (`availability` = '$refineSearch' OR availability='') and role=2";
        }else{
        $sql.= " FROM user where  `availability` = '$refineSearch' and role=2 ";
        }
    
} else if (strlen($requestData['nameSearch']) > 1) {
    if ($semail == 0) {
        $sql = "SELECT  * ";
        $sql.=" FROM user where  role=2 and `first` LIKE  '%{$requestData['nameSearch']}%' ";
    } else if ($semail == 1) {
        $sql = "SELECT  * ";
        $sql.=" FROM user where  role=2 and  `email` LIKE  '%{$requestData['nameSearch']}%'";
    }
} else {
    $sql = "SELECT  * ";
    $sql.=" FROM user where  role=2 ";
}



if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    // $requestData['nameSearch'];
    $sql.=" AND ( first LIKE '" . $requestData['search']['value'] . "%' ";
    $sql.=" OR email LIKE '" . $requestData['search']['value'] . "%' ";

    $sql.=" OR availability LIKE '" . $requestData['search']['value'] . "%' )";
}
$query = mysql_query($sql) or die("employee-grid-data.php: get employees2");

$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY user_id DESC  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
//$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysql_query($sql) or die("employee-grid-data.php: get employees3");

$data = array();
$d = 1;
while ($row = mysql_fetch_array($query)) {  // preparing an array
    $nestedData = array();

    $nestedData[] = $row["first"];
    $nestedData[] = $row["email"];
    if ($row["availability"] == 'Available') {
        $nestedData[] = "<p style='color:#32CD32;'>" . $row["availability"] . "</p>";
    } elseif ($row["availability"] == 'Not Available') {
        $nestedData[] = "<p style='color:#FF0000;'>" . $row["availability"] . "</p>";
    } elseif ($row["availability"] == 'No Status') {
        $nestedData[] = "<p style=''>" . $row["availability"] . "</p>";
    } elseif ($row["availability"] == 'Cannot Confirm') {
        $nestedData[] = "<p style='color:#FF00FF;'>" . $row["availability"] . "</p>";
    } elseif ($row["availability"] == 'Looking For Change') {
        $nestedData[] = "<p style='color:#0000FF;'>" . $row["availability"] . "</p>";
    } elseif ($row["availability"] == '') {
        $nestedData[] = "No Status";
    };

    $nestedData[] = $row["visits"];

    if ($row["dateTime"] == '') {
        $nestedData[] = "<p style='padding-left:20px;'> Not loged in</p>";
    } else {
        $nestedData[] = $row["dateTime"];
    }
    $nestedData[] = '<a target="_blank" href="view_profile_admin.php?id= ' . $row["user_id"] . ' "><i class="fa fa-eye"></i></a>';

    $nestedData[] = '<center><input   name="check_list[]"  value="' . $row['user_id'] . '" id="' . $d . '" type="checkbox"></center>';

    $data[] = $nestedData;
    $d++;
}



$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
