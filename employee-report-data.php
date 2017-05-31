<?php

error_reporting(0);
/* Database connection start */
include('config/config.php');

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;
$fromDate = explode("/", $requestData['nameSearch']);
$source = $fromDate[2] . '-' . $fromDate[0] . '-' . $fromDate[1];
$toDate = explode("/", $requestData['refineSearch']);
$destination = $toDate[2] . '-' . $toDate[0] . '-' . $toDate[1];
$availability = $requestData['avail'];
$verifi = $requestData['verifi'];

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
//echo $requestData['idocheck'];
if (strlen($requestData['refineSearch']) > 1 && strlen($requestData['nameSearch']) > 1 && strlen($requestData['avail']) > 1 && strlen($requestData['verifi']) !='') {
    $sql = "SELECT  * ";
    if ($requestData['idocheck'] == 'idolize') {
        if ($availability == 'No Status') {
            $sql.=" FROM user where  role=2 and verify=$verifi and idolize=1 and (availability='$availability' or availability='') and createdDate between '$source' and '$destination' ";
        } else {
            $sql.=" FROM user where  role=2 and verify=$verifi and idolize=1 and availability='$availability' and createdDate between '$source' and '$destination' ";
        }
    } else {
        if ($availability == 'No Status') {
            $sql.=" FROM user where  role=2 and verify=$verifi and idolize=0 and (availability='$availability' or availability='') and createdDate between '$source' and '$destination' ";
        } else {
            $sql.=" FROM user where  role=2 and verify=$verifi and idolize=0 and availability='$availability' and createdDate between '$source' and '$destination' ";
        }
    }
}else if (strlen($requestData['refineSearch']) > 1 && strlen($requestData['nameSearch']) > 1 && strlen($requestData['verifi']) !='') {
    $sql = "SELECT  * ";
    if ($requestData['idocheck'] == 'idolize') {
        if ($availability == 'No Status') {
            $sql.=" FROM user where  role=2  and idolize=1 and verify=$verifi and createdDate between '$source' and '$destination' ";
        } else {
            $sql.=" FROM user where  role=2 and idolize=1 and verify=$verifi and createdDate between '$source' and '$destination' ";
        }
    } else {
        if ($availability == 'No Status') {
            $sql.=" FROM user where  role=2 and idolize=0 and verify=$verifi and createdDate between '$source' and '$destination' ";
        } else {
            $sql.=" FROM user where  role=2 and idolize=0 and verify=$verifi and createdDate between '$source' and '$destination' ";
        }
    }
}
//else if (strlen($requestData['refineSearch']) > 1 && strlen($requestData['nameSearch']) > 1) {
//    $sql = "SELECT  * ";
//    if ($requestData['idocheck'] == 'idolize') {
//        $sql.=" FROM user where  role=2 and idolize=1 and createdDate between '$source' and '$destination' ";
//    } else {
//        $sql.=" FROM user where  role=2 and idolize=0 and createdDate between '$source' and '$destination' ";
//    }
//}
//else if (strlen($requestData['nameSearch']) > 1) {
//    $sql = "SELECT  * ";
//    if ($requestData['idocheck'] == 'idolize') {
//        $sql.=" FROM user where  role=2 and idolize=1 and createdDate >='$source' ";
//    } else {
//        $sql.=" FROM user where  role=2 and idolize=0 and createdDate >='$source' ";
//    }
//} else if (strlen($requestData['refineSearch']) > 1) {
//    $sql = "SELECT  * ";
//    if ($requestData['idocheck'] == 'idolize') {
//        $sql.= " FROM user where  role=2 and idolize=1 and createdDate <='$destination' ";
//    } else {
//        $sql.= " FROM user where  role=2 and idolize=0 and createdDate <='$destination' ";
//    }
//}
else {
    $sql = "SELECT  * ";
    $sql.= " FROM user where  role=10";
}



$query = mysql_query($sql) or die("employee-report-data.php: get employees2");

$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY user_id DESC  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysql_query($sql) or die("employee-report-data.php: get employees3");

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
    $nestedData[] = '<a href="view_profile_admin.php?id= ' . $row["user_id"] . ' "><i class="fa fa-eye"></i></a>';

    $nestedData[] = '<center><input   name="check_list[]"  value="' . $row['user_id'] . '" id="' . $d . '" type="checkbox"></center>';

    $data[] = $nestedData;
    $d++;
}



$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal" => intval($totalFiltered), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
