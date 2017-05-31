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
                    <h1 class="page-header">Post Requirement</h1>
                    <div class="changep">
                        <button class="btn btn-info"  onclick="history.go(-1);"><i class="fa fa-reply"></i> Back</button>
                    </div>
                </div>
                <!--End Page Header -->
            </div>




            <div class="row">

                <div class="col-lg-8">








                    <div class="panel panel-default">

                        <form action="requirementAdd.php"  method="post" role="form" style="padding:20px;" width="100% ">
                            <table cellspacing="10px" style="  border-spacing: 10px; 
                                   border-collapse: separate;" width="100% ">
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" style="width:50%;" id="jobtitle" oninvalid="jobtle(this);" oninput="jobtle(this);"   required="required" name="jobtitle" value="" placeholder="Enter Job Title" /></td>
                                </tr>



                                <tr><td colspan="2">  <textarea class="form-control"  oninvalid="priskills(this);" oninput="priskills(this);" name="pskills" id="pskills" required="required"  placeholder="Enter Primary Skills"></textarea></td></tr>
                                <tr><td colspan="2">  <textarea class="form-control"   name="description" id="description"  placeholder="Enter Job Description"></textarea></td></tr>


                                <tr><td colspan="2"><button type="submit" id="register"  value="Submit" class="btn btn-primary">Submit</button></td></tr>
                            </table>
                        </form>






















                        <!--Area chart example -->

                        <!--End area chart example -->
                        <!--Simple table example -->

                    </div>
                </div>


            </div>







        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>

</body>

</html>
