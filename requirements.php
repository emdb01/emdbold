<?php
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if (isset($_POST['resetfilter'])) {
    unset($_POST['q']);
}
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$recruiter_id = $_SESSION['user_id'];
$recruiterId = $recruiter_id;
?>
<body>
    <!--tooltip------>
    <?php include ("tooltip.html"); ?>
    <!--tooltip------>
<head>

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

    </script>
</head>
<!--  wrapper -->
<div id="wrapper">
    <!-- navbar top -->
    <?php include('sidemenu.php'); ?>
    <!-- end navbar side -->
    <!--  page-wrapper -->
    <div id="page-wrapper">

        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12">
                <h1 class="page-header">Requirements</h1>
                <?php if (isset($_GET['suc'])) { ?>
                    <div class="alert" id="successs"  onclick="showhide()" style="background-color:#808080;color:#fff;">
                        The requirement has been removed successfully.
                    </div>
                <?php } ?>
            </div>
            <!--End Page Header -->
        </div>




        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Requirement Search 
                    </div>
                    <div class="panel-body">

                        <div class="form-group col-lg-12">
                            <form action="requirements.php"   method="POST" > 
                                <input type="text" name="q" id=""  required="required"  value="" placeholder="" class="form-control " style="float:left;width:70%;">

                                <button type="submit" class="btn btn-primary" id="refine"  value="Refine" style="float:left;width: 12%;margin-left: 5%;">Refine</button>
                            </form>
                            <form action=""   method="POST" > 
                                <?php if ($_POST['q'] != '') { ?>
                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter1" class="btn  btn-success" style="float: right;width: 12%;">Reset Filter</button>
                                <?php } ?>
                            </form>
                        </div>

                        


                    </div>

                </div>
            </div>
            <?php if ($_POST['q'] != '') { ?> 
              <div class="col-lg-12">
                        <div class="alert " style="background-color:#808080;color:#fff;">
                            <center>
                                Search results for   &nbsp;&nbsp;<b>"<?php echo $_POST['q']; ?>"
                                    </b></center>
                        </div>
                    </div>
            <?php } ?>
            <div class="col-lg-12">
                <div class="changep">
                    <a href="requirementPost.php"><button type="button" class="btn btn-info"> Post Requirement</button></a>

                </div>
            </div>
            <div class="col-lg-12">





                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>S.No.</th>
                                        <th>Requirement</th>
                                        <th>Match</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    if ($_POST['q'] != '') {
                                        $query_pag_data = "SELECT * from requirement where recruiterId='$recruiterId' and jobTitle LIKE '%" . $_POST['q'] . "%' order by id DESC ";
                                    } else {
                                        $query_pag_data = "SELECT * from requirement where recruiterId='$recruiterId' order by id DESC ";
                                    }

                                    $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                    $msg = "";
                                    $c = 1;
                                    while ($res = mysql_fetch_array($result_pag_data)) {
                                        $skls = explode(",", $res['primarySkills']);
                                        $skillsCount = count(explode(",", $res['primarySkills']));
                                        $Skills = str_replace(",", "|", $res['primarySkills']);
                                        $mid = $res['id'];
                                        $id = $res['id'];

                                        //this below code is maximum matched skills code 

                                        $countAry = array();
                                        for ($i = 0; $i <= $skillsCount; $i++) {
                                            if ($skls[$i] != '') {
                                                $sql11 = mysql_query("SELECT * FROM `user` WHERE skills LIKE '%$skls[$i]%'");
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
//                    //echo $key.">>>>".$value; 
//                }
//            }
                                        //this Above code is  maximum matched skills code   
//echo "SELECT * FROM `user` WHERE user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and skills REGEXP '(^|,)($Skills)(,|$)' ";
                                        $sql1 = mysql_query("SELECT * FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$recruiterId' and skills REGEXP '(^|,)($Skills)(,|$)' ");
                                        $matchcount = mysql_num_rows($sql1);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><?php echo $c; ?></td>
                                            <?php if ($matchcount > 0 && $Skills != '') { ?>
                                                <td>
                                                    <a  href="matchedRecords.php?machedId=<?php echo $res['id']; ?>" title="match" style="text-decoration: none;color:blue;"><?php echo $res['jobTitle']; ?></a>   
                                                </td>
                                            <?php } else { ?>
                                                <td>   <?php echo $res['jobTitle']; ?> </td>
                                            <?php } ?>

                                            <td class="center">
                                                <?php
                                                if ($matchcount > 0 && $Skills != '') {
//                foreach ($countAry as $key => $value) {
//                if ($value >= $skillsCount / 2) {
//                
                                                    ?>
                                                    <a  href="matchedRecords.php?machedId=<?php echo $res['id']; ?>" title="match" style="text-decoration: none;color:blue;">Matched<sup >(<?php echo $matchcount; ?>)</sup></a>
                                                    <?php //  }else{    ?>
                                                    <!--<spam>Not Matched</spam>--> 
                                                    <?php
//            }
//            }
                                                } else {
                                                    ?>
                                        <spam>Not Matched</spam>  
                                    <?php }
                                    ?></td>
                                    <td class="center"><a href="viewReq.php?id=<?php echo $res['id']; ?>"><img src="images/view_16x16.gif" title="View"></a> <a href="editReq.php?id=<?php echo $res['id']; ?>"><img src="images/edit-16.gif" title="Edit"></a> <a href="deleteReq.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>
                                    </tr>

                                    <?php
                                    $c++;
                                }
                                ?> 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>








    </div>
    <!-- end page-wrapper -->

</div>
<!-- end wrapper -->


<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script>
                    $(document).ready(function () {
                        $('#dataTables-example').dataTable();
                    });
</script>

</body>

</html>
<script>

    function showhide()
    {
        $('#successs').hide();
    }
</script>