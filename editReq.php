<?php
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$recruiter_id = $_SESSION['user_id'];
?>
<!--tooltip------>
<?php include ("tooltip.html"); ?>
<!--tooltip------>
<body>

    <script type="text/javascript">

        function jobtle(textbox) {
            if (document.getElementById('jobtitle').value == '')
            {
                textbox.setCustomValidity('Please Enter Job Title');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function techgy(textbox) {
            if (document.getElementById('technology').value == '')
            {
                textbox.setCustomValidity('Please Enter Technology');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function experie(textbox) {
            if (document.getElementById('experience').value == '')
            {
                textbox.setCustomValidity('Please Enter Experience');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function rat(textbox) {
            if (document.getElementById('rate').value == '')
            {
                textbox.setCustomValidity('Please Enter Rate');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function locatn(textbox) {
            if (document.getElementById('location').value == '')
            {
                textbox.setCustomValidity('Please Enter Location');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function vis(textbox) {
            if (document.getElementById('visa').value == '')
            {
                textbox.setCustomValidity('Please Select Visa Type');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        function priskills(textbox) {
            if (document.getElementById('pskills').value == '')
            {
                textbox.setCustomValidity('Please Enter Primary Skills');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }



    </script>

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
                    <h1 class="page-header">Edit Requirement</h1>
                    <?php if (isset($_GET['suc'])) { ?>
                        <div class="alert" id="successs"  onclick="showhide()" style="background-color:#808080;color:#fff;">
                            The requirement details has been updated successfully.
                        </div>
                    <?php } ?>
                    <div class="changep">
                        <button class="btn btn-info" style="float:right;" onclick="history.go(-1);"><i class="fa fa-reply"></i> Back</button>
                    </div>
                </div>
                <!--End Page Header -->
            </div>


            <?php
            $id = $_GET['id'];
            $listdetails = "SELECT * FROM `requirement` WHERE id='$id'";
            $listdetails_query = mysql_query($listdetails);
            while ($res = mysql_fetch_array($listdetails_query)) {
                $jobTitle = $res['jobTitle'];
                $description = $res['description'];
                $primarySkills = str_replace("|", ",", $res['primarySkills']);
            }
            ?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edit Requirement Details
                            </div></br>
                            <form role="form" action="reqUpdate.php"  method="post" name="checkval" id="checkval" >
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <table class="table table-hover tablebd">

                                    <tbody>
                                        <tr>

                                            <td>

                                                <div class="form-group">
                                                    <label>Job Title</label>
                                                    <input class="form-control" type="text" id="jobtitle" oninvalid="jobtle(this);" oninput="jobtle(this);"   required="required" name="jobtitle" value="<?php echo $jobTitle; ?>"  />
                                                </div></td>

                                        </tr>

                                        <tr>
                                            <td colspan="1"><div class="form-group">
                                                    <label>Primary Skills</label>
                                                    <textarea class="form-control"  oninvalid="priskills(this);" oninput="priskills(this);" name="pskills" id="pskills" required="required"  ><?php echo $primarySkills; ?></textarea>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"><div class="form-group">
                                                    <label>Enter Job Description</label>
                                                    <textarea class="form-control" style="height:100px;"   name="description" id="pskills" required="required"  ><?php echo $description; ?></textarea>
                                                </div></td>
                                        </tr>



                                        <tr>
                                            <td><button type="submit" class="btn btn-success" id="register" onclick="showhide();" value="Submit">Update</button></td>


                                        </tr>
                                    </tbody>

                                </table>

                            </form>

                        </div>
                    </div>
                </div>


            </div>







        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->


</body>

</html>
<script>

    function showhide()
    {
        $('#successs').hide();
    }
</script>