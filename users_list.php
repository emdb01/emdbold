<?php
include('config/config.php');
error_reporting(0);
if ($_POST['page']) {
    $page = $_REQUEST['page'];
    $recruiterId = $_REQUEST['id'];
    $machedId = $_REQUEST['machedId'];
    $searchemdbId = $_REQUEST['searchemdbId'];
    $refineSearch = $_REQUEST['refineSearch'];
    $nameSearch = $_REQUEST['nameSearch'];
    $subfolderlink = $_REQUEST['subfolderlink'];
    $mainfolderlink = $_REQUEST['mainfolderlink'];
    $sublink = $_REQUEST['sublink'];
    $cur_page = $page;
    $page -= 1;
    $per_page = 20;
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;
    ?>
    <!------this script for select all checkboxes----->
    <script type="text/javascript">
        function do_this() {

            var checkboxes = document.getElementsByName('check_list[]');
            var checkbox = document.getElementById('selecctall');

            if (checkbox.value == 'select') {
                for (var i in checkboxes) {
                    checkboxes[i].checked = 'FALSE';
                }
                checkbox.value = 'deselect'
            } else {
                for (var i in checkboxes) {
                    checkboxes[i].checked = '';
                }
                checkbox.value = 'select';
            }
        }
        function do_invite() {

            var checkboxes = document.getElementsByName('check_invite[]');
            var checkbox = document.getElementById('check_invite');

            if (checkbox.value == 'select') {
                for (var i in checkboxes) {
                    checkboxes[i].checked = 'FALSE';
                }
                checkbox.value = 'deselect'
            } else {
                for (var i in checkboxes) {
                    checkboxes[i].checked = '';
                }
                checkbox.value = 'select';
            }
        }
    </script>
    <!-----this script for select all checkboxes----->
    <!-----this script for Hide and show Buttons----->
    <!--    <style type="text/css">
    .buttonall{
        display: none;
    }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){

    $('input[type="checkbox"]').click(function(){
    //          var chks = document.getElementsByName('check_list[]');
    //          alert(Object.keys(chks).length);
        if($(this).attr("value") !=""){
            $(".buttonall").toggle();
        }
    });
    });
    </script>-->
    <!-----this script for Hide and show Buttons----->


    <table width="100%" border="0" cellpadding="0" cellspacing="0" sortable="sortable">
        <tr style="background-color:#258EC8; color:#ffffff;">

            <td>Name</td>
            <!--<td>Email</td>-->
            <td>Availability</td>
            <td>Matched</td>
            <td>Actions</td>
            <td><input type="checkbox" id="selecctall" value="select" onClick="do_this()" />Select All</td>
        </tr>



        <?php
//         echo "mmk". $nameSearch;
//         echo "mmk". $sublink;
//         echo "mmk". $refineSearch;
//        $findme = 'EMDB';
        $pos = strpos($nameSearch, '@');
        if ($pos !== false) {
            $semail = 1;
        } else {
            $semail = 0;
        }

        if (strlen($searchemdbId) > 1) {
            $searchemdbId = str_replace("EMDB", "", $searchemdbId);
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `member_id`='$searchemdbId' LIMIT $start, $per_page";
        } else if (strlen($refineSearch) > 1 && strlen($sublink) > 1 && strlen($nameSearch) > 1) {
            if ($semail == 0) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%' LIMIT $start, $per_page";
            } else if ($semail == 1) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            }
        } else if (strlen($refineSearch) > 1 && strlen($sublink) > 1) {
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' LIMIT $start, $per_page";
        } else if (strlen($refineSearch) > 1 && strlen($mainfolderlink) > 1) {
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' LIMIT $start, $per_page";
        } else if (strlen($sublink) > 1 && strlen($nameSearch) > 1) {
            if ($semail == 0) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId'  and `filepath` LIKE  '%$sublink/%') and `first` LIKE  '%{$nameSearch}%' LIMIT $start, $per_page";
            } else if ($semail == 1) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId'  and `filepath` LIKE  '%$sublink/%') and  `email` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            }
        } else if (strlen($refineSearch) > 1 && strlen($nameSearch) > 1) {
            if ($semail == 0) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `availability`='$refineSearch' and `first` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            } else if ($semail == 1) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `availability`='$refineSearch' and `email` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            }
        } else if (strlen($subfolderlink) > 1 && strlen($subfolderlink) >= 0) {
            // $subfolderlink = str_replace("\\", "\\\\\\\\", $subfolderlink);
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$subfolderlink/%')  LIMIT $start, $per_page";
        } else if (strlen($mainfolderlink) > 1) {
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$mainfolderlink/%')  LIMIT $start, $per_page";
        } else if (strlen($refineSearch) > 1) {
            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `availability`='$refineSearch' LIMIT $start, $per_page";
        } else if (strlen($nameSearch) > 1) {
            if ($semail == 0) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `first` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            } else if ($semail == 1) {
                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and  `email` LIKE  '%{$nameSearch}%'  LIMIT $start, $per_page";
            }
        } else if (strlen($searchemdbId) == 1 || strlen($refineSearch) == 1) {
            $query_pag_data = "SELECT * FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') LIMIT $start, $per_page";
        }

        $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
        $msg = "";
        $d = 1;
        while ($res = mysql_fetch_array($result_pag_data)) {
            $skls = explode(",", $res['skills']);
            $skillsCount1 = count(explode(",", $res['skills']));
            $Skills = str_replace(",", "|", $res['skills']);

            //this below code is maximum matched skills code 
            $sqlQry = mysql_query("SELECT * FROM `requirement` WHERE recruiterId='$recruiterId' ");
            while ($reqid = mysql_fetch_assoc($sqlQry)) {
                $pskills = $reqid['primarySkills'];
                $skls1 = explode(",", $pskills);
                $skillsCount = count(explode(",", $pskills));
            }


            $countAry = array();
            for ($i = 0; $i <= $skillsCount; $i++) {
                if ($skls[$i] != '') {
                    $sql11 = mysql_query("SELECT * FROM `requirement` WHERE primarySkills LIKE '%$skls[$i]%'");
                    $sql1 = mysql_num_rows($sql11);
                }
                if ($sql1 > 0 && $skls[$i] != '') {
                    if (array_key_exists($id, $countAry))
                        $countAry[$id] ++;
                    else {
                        $countAry[$id] = 1;
                    }
                } else {
                    
                }
            }
//            foreach ($countAry as $key => $value) {
//                if ($value >= $skillsCount / 2) {
//                    //echo $key.">>>>".$value; echo "<br>";
//                }
//            }
            //this Above code is  maximum matched skills code   
            $sql1 = mysql_query("SELECT * FROM `requirement` WHERE recruiterId='$recruiterId' and primarySkills REGEXP '(^|,)($Skills)(,|$)' ");
            $matchcount = mysql_num_rows($sql1);
            $available = $res['availability'];

            echo '<tr>';
            echo '<td>' . $res['first'] . '</td>';
//            echo '<td>' . $res['email'] . '</td>';
//            echo '<td>' . $res['availability'] . '</td>';
            echo "<td>";
            if ($available == 'Available') {
                echo "<p style='color:#32CD32;'>$available </p>";
            } elseif ($available == 'Not Available') {
                echo "<p style='color:#FA8072;'>$available </p>";
            } elseif ($available == 'No Status') {
                echo "<p style=''>$available </p>";
            } elseif ($available == 'Cannot Confirm') {
                echo "<p style='color:#FF00FF;'>$available </p>";
            } elseif ($available == 'Looking For Change') {
                echo "<p style='color:#ADFF2F;'>$available </p>";
            } elseif ($available == '') {
                echo "<p style=''> No Status</p>";
            }
            echo "</td>";
            echo '<td>';
            if ($matchcount > 0 && $Skills != '') {
//                foreach ($countAry as $key => $value) {
//                     echo $value;
//                     echo $skillsCount/2;
//                    if ($value >= $skillsCount / 2) {
//                        
                ?>
                <a  href="matchedRequirements.php?id=<?php echo $res['user_id']; ?>" title="match" style="text-decoration: none;color:blue;">Matched<sup >(<?php echo $matchcount; ?>)</sup></a>
                <?php //} else {  ?>
                                <!--<spam>Not Matched</spam>--> 
                <?php
//                    }
//                }
            } else {
                ?>
                <spam>Not Matched</spam>  
                <?php
            }
            echo '</td>';


            echo '<input  name="userId[]" value="' . $res['user_id'] . '" id="userId' . $d . '" type="hidden">';
            echo '<td><a href="viewUser.php?id=' . $res['user_id'] . '&machedId=' . $machedId . '"><img src="images/view_16x16.gif" title="View"></a>  </td>';
            echo '<td><input  name="check_list[]" value="' . $res['user_id'] . '" id="' . $d . '" type="checkbox"></td>';

            echo '</tr> ';
            $d++;
        }
        ?>

    </table>
    <?php
    /* --------------------------------------------- */
    if (strlen($searchemdbId) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `member_id`='$searchemdbId' ";
    } else if (strlen($refineSearch) != 1 && strlen($nameSearch) != 1 && strlen($sublink) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%{$sublink}/%')  and  `availability`='$refineSearch' and `first` LIKE  '%{$nameSearch}%' ";
    } else if (strlen($refineSearch) != 1 && strlen($nameSearch) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and  `availability`='$refineSearch' and `first` LIKE  '%{$nameSearch}%' ";
    } else if (strlen($refineSearch) != 1 && strlen($sublink) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%{$sublink}/%' )  and  `availability`='$refineSearch'";
    } else if (strlen($nameSearch) != 1 && strlen($sublink) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%{$sublink}/%' ) and `first` LIKE  '%{$nameSearch}%' ";
    } else if (strlen($refineSearch) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `availability`='$refineSearch' ";
    } else if (strlen($nameSearch) != 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `first` LIKE  '%{$nameSearch}%' ";
    } else if (strlen($subfolderlink) > 1) {
        //$subfolderlink = str_replace("\\", "\\\\\\\\", $subfolderlink);
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$subfolderlink/%')";
    } else if (strlen($mainfolderlink) > 1) {
        $query_pag_num = "SELECT COUNT(*) AS count FROM user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$mainfolderlink/%')";
    } else if (strlen($searchemdbId) == 1 || strlen($refineSearch) == 1) {
//        $query_pag_num = "SELECT COUNT(*) AS count FROM user where recruiterId='$recruiterId'";
        $query_pag_num = "SELECT COUNT(*) AS count FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')";
    }

    $result_pag_num = mysql_query($query_pag_num);
    $row = mysql_fetch_array($result_pag_num);
    $count = $row['count'];
    $no_of_paginations = ceil($count / $per_page);

    /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
    if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
            $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
            $start_loop = $no_of_paginations - 6;
            $end_loop = $no_of_paginations;
        } else {
            $end_loop = $no_of_paginations;
        }
    } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
            $end_loop = 7;
        else
            $end_loop = $no_of_paginations;
    }
    /* ----------------------------------------------------------------------------------------------------------- */
    $msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
    if ($first_btn && $cur_page > 1) {
        $msg .= "<li p='1' class='active'>First</li>";
    } else if ($first_btn) {
        $msg .= "<li p='1' class='inactive'>First</li>";
    }

// FOR ENABLING THE PREVIOUS BUTTON
    if ($previous_btn && $cur_page > 1) {
        $pre = $cur_page - 1;
        $msg .= "<li p='$pre' class='active'>Previous</li>";
    } else if ($previous_btn) {
        $msg .= "<li class='inactive'>Previous</li>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {

        if ($cur_page == $i)
            $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
        else
            $msg .= "<li p='$i' class='active'>{$i}</li>";
    }

// TO ENABLE THE NEXT BUTTON
    if ($next_btn && $cur_page < $no_of_paginations) {
        $nex = $cur_page + 1;
        $msg .= "<li p='$nex' class='active'>Next</li>";
    } else if ($next_btn) {
        $msg .= "<li class='inactive'>Next</li>";
    }

// TO ENABLE THE END BUTTON
    if ($last_btn && $cur_page < $no_of_paginations) {
        $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
    } else if ($last_btn) {
        $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
    }
    $goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;width:25px;height:15px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
    $total_string = "<span class='total' style='word-spacing: 0;' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
    $msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
    echo $msg;
    echo "<br>";
}
?>
<input  name="recId" value="<?php echo $recruiterId; ?>" id="recId" type="hidden">  