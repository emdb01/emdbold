<?php
include('header.php');
$value = 'employeemasterdatabase.com';
//setcookie("referer", $value);
//setcookie("referer", $value, time()+3600);  /* expire in 1 hour */
//$_COOKIE["referer"];
$_SESSION['referer'] = $value;
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
?>
<body>
    <?php
	if ($_SESSION['role'] == 1) {
        $mid = $_SESSION['user_id'];
        include("searches.php");
        ?>

    <?php } ?>

    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
<!--    <script src="assets/plugins/jquery-1.10.2.js"></script>-->
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>


</body>

</html>
