<?php

/* Database connection start */
include('config/config.php');

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;
if ($requestData['nameSearch'] != '' && $requestData['refineSearch']) {
    $fromDate = explode("/", $requestData['nameSearch']);
    $source = $fromDate[2] . '-' . $fromDate[0] . '-' . $fromDate[1];
    $toDate = explode("/", $requestData['refineSearch']);
    $destination = $toDate[2] . '-' . $toDate[0] . '-' . $toDate[1];
}

//$sql.=" FROM invites where  mailStatus=0  and  createdDate between '$source' and '$destination'";


$columns = array(
// datatable column index  => database column name
    0 => 'email',
    1 => 'createdDate',
    2 => 'id',
    3 => ''
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM invites  where  mailStatus=0 and email NOT IN (select email from user)";
$query = mysql_query($sql) or die("invites-grid-data.php: get employees1");
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
$pos = strpos($requestData['nameSearch'], '@');
if ($pos !== false) {
    $semail = 1;
} else {
    $semail = 0;
}
if (strlen($requestData['nameSearch']) > 1) {
    $sql = "SELECT  * ";
    $sql.=" FROM invites where  mailStatus=0  and  createdDate between '$source' and '$destination' and email NOT IN (select email from user)";
} else {
    $sql = "SELECT  * ";
    $sql.=" FROM invites where  mailStatus=0 and email NOT IN (select email from user) ";
}



$query = mysql_query($sql) or die("invites-grid-data.php: get employees2");

$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY id DESC  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
//$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysql_query($sql) or die("invites-grid-data.php: get employees3");

$data = array();
$d = 1;
while ($row = mysql_fetch_array($query)) {  // preparing an array
    $nestedData = array();


    $nestedData[] = $row["email"];

    $nestedData[] = $row["createdDate"];


    $nestedData[] = '<a target="_blank" href="view_profile_admin.php?id= ' . $row["id"] . ' "><i class="fa fa-eye"></i></a>';

    $nestedData[] = '<center><input   name="check_list[]"  value="' . $row['id'] . '" id="' . $d . '" type="checkbox"></center>';

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
