<?php
error_reporting(0);
include('header.php');
include('class.pdf2text.php');
require("class.filetotext.php");

if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
if (isset($_POST['resetfilter'])) {
    unset($_POST['searchemdb']);
    unset($_GET['q']);
    unset($_GET['Refine']);
    unset($_SESSION['subfolderlink']);
    unset($_SESSION['mainfolderlink']);
    unset($_GET['serterm']);
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
$mainfolder = "./" . $mid . "/";
$mainfolderlink = "";
$subfolderlink = "";
if (isset($_SESSION['subfolderlink'])) {
    $finalpathfoldersite = $subfolderlink;
}
@$mainfolderlink = $_SESSION['mainfolderlink'];
@$subfolderlink = $_SESSION['subfolderlink'];

$ulink = curPageURL();
$s_1 = 0;
$extoffileis = "";
$finalpathfoldersite = "";
$finalpathfoldersite = "./$mid";
if (isset($_POST['refinefolder'])) {

    @$mainfolderlink = $_POST['folderspecify'];
    @$subfolderlink = $_POST['refinesubfolder'];
    if (@$subfolderlink != "") {
        $finalpathfoldersite = $subfolderlink;
        $_SESSION['subfolderlink'] = $subfolderlink;
        $_SESSION['mainfolderlink'] = $mainfolderlink;
    } else {

        unset($_SESSION['subfolderlink']);
        if (@$mainfolderlink != "") {

            $_SESSION['mainfolderlink'] = $mainfolderlink;
            $finalpathfoldersite = $mainfolderlink;
        } else {
            $finalpathfoldersite = "./$mid";
        }
    }
    unset($_SESSION['subfolderlink']);
    unset($_SESSION['mainfolderlink']);
} else {
    $finalpathfoldersite = "./$mid";
}
if (isset($_SESSION['mainfolderlink'])) {
    $finalpathfoldersite = $mainfolderlink;
}
if (isset($_SESSION['subfolderlink'])) {
    $finalpathfoldersite = $subfolderlink;
}

$recruiterId = $_SESSION['user_id'];
?>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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

    </script>
    <script language="javascript">

        $(document).ready(function ()
        {

//                $('#resetfilter1').hide();
            $('#folderspecify').change(function ()
            {
                var foldername = $(this).val();

                $('#resetfilter2').hide();
                $.ajax({data: {foldername: foldername}, url: "refinefolder.php", success: function (result) {
                        $("#folderspecifyres").html(result);
                        $('#refinefolder').hide();



                    }});

            });
            $('#q').change(function ()
            {
//                     $('#resetfilter1').show();    
            });


        });

        /* Search Term */
        function SearchTermCheck(textbox) {
            if (document.searchtermform.serterm.value == "")
            {
                textbox.setCustomValidity('Please keyin a search term');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;

        }
        /* Search Term */

        function nameis() {
            if (document.nameoffile.newname.value == "")
            {
                alert("Please keyin a new name");
                document.nameoffile.newname.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>


        /* alert for search with EMDB  id*/

        function SearchEmdbId(textbox) {

            if (document.checkavail.searchemdb.value.length !== 16)
            {
                textbox.setCustomValidity('Please key in a valid EMDB');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        /* alert for search with EMDB  id*/


        /* alert for refinesubfolder */

        function folders(textbox) {
            if (document.getElementById('folderspecify').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        function refinesubfol(textbox) {
            if (document.getElementById('refinesubfolder').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }



    </script>
    <!-----this script for select all checkboxes----->
    <!--Popup for View Resume  and Voice message------>
<!--<script src="js/jquery-1.10.2.min.js"></script>---->
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/portBox.slimscroll.min.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <!--Popup for View Resume  and Voice message------>
</head>
<body>
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
                    <h1 class="page-header">Automated Voice </h1>
                </div>
                <!--End Page Header -->
            </div>




            <div class="row">

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quick Search 

                        </div>
                        <div class="panel-body" >

                            <form action="list_resumes.php?id=1" name="checkavail" id="checkavail"  method="post"  >
                                <input type="text" name="searchemdb" id="searchemdb"   oninvalid="SearchEmdbId(this);" required="required"  oninput="SearchEmdbId(this);"  Value="<?php echo @$_POST['searchemdb']; ?>" placeholder="EMDB" class="form-control "  style="float:left;margin-right:20px;width:70%">
                                <button type="submit"  name="searchemdbb" id="searchemdbb" style="width: 25%;" value="Check Status" class="btn btn-primary">Check Status</button>
                            </form>

                            </br>

                            <form action="<?php echo $searchaction; ?>"   method="GET" name="searchtermform"  id="searchtermform"  >
                                <input class="form-control" type="text" oninvalid="SearchTermCheck(this);"  oninput="SearchTermCheck(this);"   required="required" placeholder="Search by  Name Or Email" id="serterm"  name="serterm" value="<?php echo @$searchvalue; ?>" style="float:left;margin-right:20px;width:70%">
                                <?php
                                if (isset($_GET['q'])) {
                                    $selectvalue = $_GET['q'];
                                    ?>
                                    <input type="hidden" id="q"  name="q" value="<?php echo $selectvalue; ?>">

                                <?php } ?>
                                <?php if ($_POST['refinesubfolder'] != '') { ?>
                                    <input type="hidden" name="sublink" value="<?php echo $_POST['refinesubfolder']; ?>"> 
                                <?php } else if ($_GET['sublink'] != '') { ?>
                                    <input type="hidden" name="sublink" value="<?php echo $_GET['sublink']; ?>">
                                <?php } ?>
                                <button type="submit" id="searchterm"  value="Search" style="width: 25%;" class="btn btn-primary">Search</button>
                            </form>
                            <p></p>
                            <?php if ($_GET['id'] == '1') { ?>
                                <form action="list_resumes.php" name="checkavail" id="checkavail"  method="post"  >
                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter1" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>

                                </form>
                            <?php } ?> 
                        </div>

                    </div>
                </div>



                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Advanced Search 


                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $refineaction; ?>"   method="GET" > 

                                <div class="form-group col-lg-12">
                                    <?php if ($_POST['refinesubfolder'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_POST['refinesubfolder']; ?>"> 
                                    <?php } else if ($_GET['sublink'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_GET['sublink']; ?>">
                                    <?php } else if ($_POST['folderspecify'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_POST['folderspecify']; ?>">
                                    <?php } ?>







                                    <select name="q" id="q" class="form-control" style="float:left;width:70%">
                                        <option value="" <?php
                                        if ($selectvalue == "") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >All</option>
                                        <option value="Available"  <?php
                                        if ($selectvalue == "Available") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Available</option>
                                        <option value="Looking For Change" <?php
                                        if ($selectvalue == "Looking For Change") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Looking For Change</option>
                                        <option value="No Status" <?php
                                        if ($selectvalue == "No Status") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >No Status</option>
                                        <option value="Not Available" <?php
                                        if ($selectvalue == "Not Available") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Not Available</option>

                                        <!--  <option value="Cannot Confirm" <?php
                                        if ($selectvalue == "Cannot Confirm") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Cannot Confirm</option>-->

                                    </select>
                                    <?php
                                    if (isset($_GET['serterm'])) {
                                        $searchvalue = $_GET['serterm'];
                                        ?>
                                        <input type="hidden" id="serterm"  name="serterm" value="<?php echo $searchvalue; ?>">

                                    <?php }
                                    ?>


                                    <button type="submit" class="btn btn-primary" id="refine"  value="Refine" style="float:right;width: 25%;">Refine</button>

                                </div>
                            </form>
                            <form action="list_resumes.php?Refine=0&serterm=<?php echo $_GET['serterm']; ?>&q=<?php echo $_GET['q']; ?>"  method="post">

                                <div class="form-group col-lg-12">

                                    <input type="hidden"  name="q"  value="<?php echo $_GET['q']; ?>" />
                                    <select name="folderspecify" id="folderspecify" class="form-control" oninvalid="folders(this);" style="float:left;width:70%"oninput="folders(this);"    style="float:left">
                                        <option value="">Select Parent Folder</option>
                                        <?php

                                        function listFolderFiles1($dir) {

                                            foreach (new DirectoryIterator($dir) as $fileInfo) {
                                                if (!$fileInfo->isDot()) {
                                                    global $mainfolder;
                                                    if ($fileInfo->isDir()) {
                                                        $dirnam = $fileInfo->getPathname();
                                                        $dirnamlist = str_replace($mainfolder, "", $dirnam);
                                                        if ($_SESSION['mainfolderlink'] == $dirnam) {
                                                            echo "<option value=\"$dirnam\" selected=\"selected\">$dirnamlist</option>";
                                                        } else {
                                                            echo "<option value=\"$dirnam\">$dirnamlist</option>";
                                                        }
                                                        //listFolderFiles($fileInfo->getPathname());
                                                    }
                                                }
                                            }
                                        }

                                        listFolderFiles1("./$mid");
                                        ?></select>
                                    <div id="folderspecifyres" >
                                        <?php
                                        if (isset($_SESSION['subfolderlink'])) {
                                            $_SESSION['subfolderlink'];
// echo "</br>";
                                            $thesub = $_SESSION['mainfolderlink'];
                                            //echo "</br>";
                                            $submain = str_replace($thesub, "", $_SESSION['subfolderlink']);
                                            $submain1 = str_replace($submain, "", $thesub);
                                            $submain1 = $submain1 . '/';
                                            ?>
                                            <select name="refinesubfolder" id="refinesubfolder" oninvalid="refinesubfol(this);" oninput="refinesubfol(this);"   required="required">
                                                <option value="">Select Parent Folder</option>
                                                <?php

                                                function listFolderFiles22($dir) {

                                                    foreach (new DirectoryIterator($dir) as $fileInfo) {
                                                        if (!$fileInfo->isDot()) {
                                                            global $mainfolder;
                                                            global $submain1;
                                                            if ($fileInfo->isDir()) {
                                                                $dirnam = $fileInfo->getPathname();
                                                                $dirnamlist = str_replace($mainfolder, "", $dirnam);
                                                                $dirnamlists = str_replace($submain1, "", $dirnam);
                                                                if ($_SESSION['subfolderlink'] == $dirnam) {
                                                                    echo "<option value=\"$dirnam\" selected=\"selected\">$dirnamlists</option>";
                                                                } else {
                                                                    echo "<option value=\"$dirnam\">$dirnamlists</option>";
                                                                }

                                                                //listFolderFiles($fileInfo->getPathname());
                                                            }
                                                        }
                                                    }
                                                }

                                                listFolderFiles22("$thesub");
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <button type="submit" class="btn btn-primary" style="float:right;width: 25%;" name='refinefolder' id='refinefolder' value='Refine Folder'>Refine Folder</button>
                                    <p></p>
    <!--                                <center><button  style="clear:both;margin:20px 0px 10px" type="submit" class="btn  btn-success" style="float:right">Reset Filter</button></center>-->
                                </div>




                                <?php if ($_GET['q'] != '' || $_GET['serterm'] != '') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } else if ($_GET['Refine'] == '0') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } ?>
                            </form>

                        </div>

                    </div>
                </div>
 <div class="changep">
                     <button type="submit" class="btn btn-info" data-display="mySite" style="background-color: green;border-color: green; margin-right: 15px;"><i class="fa fa-microphone"></i> Voice message</button>

                </div>
                <?php if ($_GET['q'] != '' || $_GET['serterm'] != '' || $subfolderlink != '' || $_GET['sublink'] != '' || $_GET['id'] != '' || $_POST['folderspecify'] != '' || $_POST['refinesubfolder'] != '') { ?>
                    <div class="col-lg-12">
                        
                        <div class="alert " style="background-color:#808080;color:#fff;">
                            <center><b>
                                    <?php
                                    if ($_GET['sublink'] != '') {

                                        $splitSub = explode("/", $_GET['sublink']);
                                    }
                                    $slink = $subfolderlink;
                                    if ($slink != '') {
                                        $splitSub = explode("/", $slink);
                                    }
                                    ?>
                                    <?php if ($_GET['q'] != '' && $_GET['serterm'] != '' && $slink != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b> &    Name Or (Email) Is <b> "<?php echo $_GET['serterm']; ?>"</b> in  
                                    <?php } else if ($_GET['q'] != '' && $_GET['serterm'] != '' && $_GET['sublink'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b> &  <b>  Name Or (Email) Is</b> <?php echo $_GET['serterm']; ?> in  <b>  Folder </b> <?php
                                        if ($splitSub[3] != '') {
                                            echo $splitSub[3];
                                        } else {
                                            echo $splitSub[2];
                                        }
                                        ?>
                                    <?php } else if ($_GET['q'] != '' && $_GET['serterm'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b>  &    Name Or (Email) Is<b> <?php echo $_GET['serterm']; ?> </b>
                                    <?php } else if ($_GET['q'] != '' && $_GET['sublink'] != '') { ?>

                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b>   in  <b>  Folder </b> <?php
                                        if ($splitSub[3] != '') {
                                            echo $splitSub[3];
                                        } else {
                                            echo $splitSub[2];
                                        }
                                        ?>   
                                    <?php } else if ($_GET['serterm'] != '' && $_GET['sublink'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['serterm']; ?>"</b>   in  <b>  Folder </b> "<?php
                                        if ($splitSub[3] != '') {
                                            echo $splitSub[3];
                                        } else {
                                            echo $splitSub[2];
                                        }
                                        ?>   "
                                    <?php } else if ($_GET['q'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b> 
                                        <?php
                                    } else if ($_GET['serterm'] != '') {
                                        $nameSearch = $_GET['serterm'];
                                        $pos = strpos($nameSearch, '@');
                                        if ($pos !== false) {
                                            $semail = 1;
                                        } else {
                                            $semail = 0;
                                        }
                                        ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['serterm']; ?>"</b>
                                    <?php } ?>
                                    <?php if ($_GET['id'] == '1') { ?>
                                        Search results for    &nbsp;&nbsp;<b>"<?php echo $_POST['searchemdb']; ?>"</b>
                                    <?php } ?>
                                    <?php
                                    // echo $_POST['folderspecify'];
//                                 echo $subfolderlink;
                                    $split = explode("/", $subfolderlink);
                                    if ($subfolderlink != '') {
                                        echo "<b>  Folder </b>" . $split[3];
                                    } else {
                                        $msplit = explode("/", $_POST['folderspecify']);
                                        if ($_POST['folderspecify'] != '') {
                                            echo "<b>  Folder </b>" . $msplit[2];
                                        }
                                    }
                                    ?>  


                                </b></center>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-12">
                   
                    
                    <?php
//                       echo $_POST['q'];
                    if ($_POST['searchemdb'] != '') {
                        $searchemdbId = $_POST['searchemdb'];
                    } else {
                        $searchemdbId = "0";
                    }
                    if ($_GET['q'] != '') {
                        if ($_GET['sublink'] != '') {
                            $sublink = $_GET['sublink'];
                            $sublink = mysql_real_escape_string($sublink);
                            $sublink = str_replace("\\\\", "/", $sublink);
                        }
                        if ($_GET['serterm'] != '') {
                            $nameSearch = $_GET['serterm'];
                        }
                        $refineSearch = $_GET['q'];
                    } else {
                        $refineSearch = "0";
                    }

                    if ($_GET['serterm'] != '') {
                        if ($_GET['sublink'] != '') {
                            $sublink = $_GET['sublink'];
                            $sublink = mysql_real_escape_string($sublink);
                            $sublink = str_replace("\\\\", "/", $sublink);
                        }
                        $nameSearch = $_GET['serterm'];
                    } else {
                        $nameSearch = "0";
                    }
                    if ($_POST['folderspecify'] != '' && $_POST['refinesubfolder'] != '') {
                        $mainfolderlink = $_POST['folderspecify'];
                        $subfolderlink = mysql_real_escape_string($_POST['refinesubfolder']);
                        $subfolderlink = str_replace("\\\\", "/", $subfolderlink);
                    } else if ($_POST['folderspecify'] != '') {
                        $mainfolderlink = mysql_real_escape_string($_POST['folderspecify']);
                        $mainfolderlink = str_replace("\\\\", "/", $mainfolderlink);
                    } else {
                        $mainfolderlink = "0";
                        $subfolderlink = "0";
                    }
//  $mainfolderlink = $_POST['folderspecify'];
//$subfolderlink = $_POST['refinesubfolder'];
                    ?>
                    <link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

                    <form action=""  name="checkval" id="checkval"   method="post"  >		
                        <div class="changep"></div>

                       
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th> Name	</th>
                                                <th>	Availability</th>
<!--                                                <th>	Matched</th> -->
                                                <th>		View</th>
                                                <th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $refineSearch = $_GET['q'];
                                            $pos = strpos($nameSearch, '@');
                                            if ($pos !== false) {
                                                $semail = 1;
                                            } else {
                                                $semail = 0;
                                            }
                                          
//                                         echo $subfolderlink.$refineSearch;
                                            if (strlen($searchemdbId) > 1) {
                                                $searchemdbId = str_replace("EMDB", "", $searchemdbId);
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `member_id`='$searchemdbId'";
                                            } else if (strlen($refineSearch) > 1 && strlen($subfolderlink) > 1 && strlen($nameSearch) > 1) {

                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%' ";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  ";
                                                }
                                            } else if (strlen($refineSearch) > 1 && strlen($sublink) > 1 && strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%' ";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%')  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  ";
                                                }
                                            } else if (strlen($refineSearch) > 1 && strlen($mainfolderlink) > 1 && strlen($nameSearch) != '0') {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$mainfolderlink/%')  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%' ";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$mainfolderlink/%')  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  ";
                                                }
                                            } else if (strlen($refineSearch) > 1 && strlen($nameSearch) > 1) {

                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `availability`='$refineSearch' and `first` LIKE  '%{$nameSearch}%' ";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId')  and `availability`='$refineSearch' and `email` LIKE  '%{$nameSearch}%' ";
                                                }
                                            } else if (strlen($subfolderlink) > 1 && strlen($refineSearch) > 1) {
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$subfolderlink/%') and availability='$refineSearch' ";
                                            } else if (strlen($sublink) > 1 && strlen($refineSearch) > 1) {
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$sublink/%') and availability='$refineSearch' ";
                                            } else if (strlen($subfolderlink) > 1) {
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$subfolderlink/%') ";
                                            } else if (strlen($mainfolderlink) > 1) {
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId' and `filepath` LIKE  '%$mainfolderlink/%')";
                                            } else if (strlen($refineSearch) > 1) {
                                                $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `availability`='$refineSearch' or `availability`=''";
                                            } else if (strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and `first` LIKE  '%{$nameSearch}%'";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') and  `email` LIKE  '%{$nameSearch}%'";
                                                }
                                            } else {
                                                $query_pag_data = "SELECT * FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$recruiterId') order by user_id desc ";
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
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $res['first']; ?></td>
                                                    <td><?php
                                                        if ($available == 'Available') {
                                                            echo "<p style='color:#32CD32;'>$available </p>";
                                                        } elseif ($available == 'Not Available') {
                                                            echo "<p style='color:#FF0000;'>$available </p>";
                                                        } elseif ($available == 'No Status') {
                                                            echo "<p style=''>$available </p>";
                                                        } elseif ($available == 'Cannot Confirm') {
                                                            echo "<p style='color:#FF00FF;'>$available </p>";
                                                        } elseif ($available == 'Looking For Change') {
                                                            echo "<p style='color:#0000FF;'>$available </p>";
                                                        } elseif ($available == '') {
                                                            echo "<p style=''> No Status</p>";
                                                        }
                                                        ?></td>
                                                   <!-- <td><?php if ($matchcount > 0 && $Skills != '') { ?>
                                                                                            <a  href="matchedRequirements.php?id=<?php echo $res['user_id']; ?>" title="match" style="text-decoration: none;color:blue;">Matched<sup >(<?php echo $matchcount; ?>)</sup></a>
                                                        <?php //} else {     ?>
                                                                                                        
                                                        <?php
//                    }
//                }
                                                    } else {
                                                        ?>
                                                                                <spam>Not Matched</spam>  
                                                    <?php }
                                                    ?>
                                            </td>-->
                                                    <?php
                                                    echo '<input  name="userId[]" value="' . $res['user_id'] . '" id="userId' . $d . '" type="hidden">';
                                                    echo '<td><a target="_blank" href="viewUser.php?id=' . $res['user_id'] . '&machedId=' . $machedId . '"><i class="fa fa-eye"></i></a>  </td>';
                                                    echo '<td class="center"><center><input   name="check_list[]"  value="' . $res['user_id'] . '" id="' . $d . '" type="checkbox"></center></td>';
                                                    ?>



                                                </tr>

                                                <?php
                                                $d++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                    </form>
                </div>
            </div>





        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- preload the images -->
    <div style='display:none'>
        <img src='images/loading.gif' alt='' />
    </div>

    <!-- Load JavaScript files -->
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.simplemodal.js'></script>

    <!-- end wrapper -->


    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/message.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>


<div id="mySite" class="portBox" style="width: 38%;left: 359.5px;">
    <b id="falseOpen" style=""><center>Please Select Atleast One Record.</center></b>
    <div id="trueOpen">
        <div id="loadStatus"><img src="images/ajaxloader.gif"/> Sending...</div>
        <div id="autosuccessmail"></div>
        <div id="presuccessmail"></div>
        <div id="predelsuccessmail"></div>
        <div id="alrtCreateAuto"></div>

       
        <spam id="autoMS" style="font-family: Times New Roman, Times, serif;"><input type="checkbox" id="automails" style="margin-left:0px;" value="Automated" name="automail"> Send Automated  Message</spam>


        <?php
        include("recordAud.php");
        ?>  



        <?php
        $latestVoice = mysql_query("select * from  voice_mails  where recruiterId='$recruiterId' and status ='0' ORDER BY `id` DESC");
        ?>
        <div id="pvmailsAudio">
            <select name="req" id="req" required class="form-control">
                <option value=""></option>
                <?php
                while ($prelist = mysql_fetch_array($latestVoice)) {
                    ?>
                    <option value="<?php echo $prelist['id'] ?>" ><?php echo $prelist['title'] ?></option>
                <?php } ?>
            </select><br> 
            <p id="vmget"></p>

            <a class="button" id="preVoiceSend">Send</a>
            <a class="button" id="preVoiceDelete">Delete</a>
        </div>

        <div id="requir">  
            <select name="req" id="reqa" required class="form-control">
                <option value=""></option>
                <?php
                $reqquery = mysql_query("SELECT * from requirement where recruiterId='$mid'");
                while ($reqlist = mysql_fetch_array($reqquery)) {
                    ?>

                    <option value="<?php echo $reqlist['jobTitle'] ?>" ><?php echo $reqlist['jobTitle'] ?></option>
                <?php } ?>
            </select> &nbsp; or <input type="text" class="form-control" required name="req" id="reqr"><br>
            <spam id="alertMsg" style="color: red;"> Please Enter Requirement</spam>
        </div>
        <p id="getAutoVoice"></p>
        <a class="button disabled two" id="autoSend">Create</a>
        <a class="button disabled two" id="autoSending">Send</a>


    </div>
</div>

<?php
if (isset($_POST['messagemail'])) {

    /* mobile app code */
    include_once './emdbMobileApp/GCM.php';
    $gcm = new GCM();
    /* mobile app code */

    $listsend = "";
    $flagset = 0;
    $mesg = $_POST['messagemail'];
    $inviteflag = 0;
    $userliststring = "";
//send message
    foreach ($_POST['emailstobesent'] as $selected) {
        $finalfilnam = explode("/", $selected);
        $justfinalfile = end($finalfilnam);
        $docObj = new Filetotext("$selected");
//$docObj = new Filetotext("test.pdf");
        $return = $docObj->convertToText();

//var_dump( $return );

        $mystring = $return;

//echo "</br></br>";

        $pos = 0;
        $endpos = 0;
        $findme = 'EMDB';
        $pos = strpos($mystring, $findme);

        // Note our use of ===. Simply, == would not work as expected
        // because the position of 'a' was the 0th (first) character.
        if ($pos === false) {
            $emaillist = extract_email_address($mystring); // finding emails to send invites and if it is there in the database
            if (!empty($emaillist)) {
                foreach ($emaillist as $selectedemail) {
                    if ($inviteflag == 0) {
                        ?>  
                        <hr>
                        <p>Would you like to invite these users who does not have an account with Us.</p>
                        <form action="" method="POST">

                            <input type="submit" size="11" id="invite"    name="invite" value="Invite"  />

                            <?php
                            $inviteflag = 1;
                        }
                    }
                    $checkifemail = $selectedemail;
                    echo "<input type=\"checkbox\" id=\"checkforinvite\" name=\"check_invite[]\" value=\"$checkifemail\">";
                    echo $checkifemail;
                    echo "</br>";
                }
            } else {

                // echo "$pos";
                $endpos = 20;
                $caidval = substr($mystring, $pos, $endpos);
                $tid = str_replace("EMDB", "", $caidval);
                $tid = preg_replace('/\s+/', '', $tid);
                $tid = substr($tid, '0', '12');


                //echo $tid;
//echo "SELECT * FROM `user` where `member_id`='$tid'"; 

                $availcheck = "SELECT * FROM `user` where `member_id`='$tid'";
                $availcheck_result = mysql_query($availcheck);
                $availcheck_check = mysql_num_rows($availcheck_result);
                if ($availcheck_check != 1) {
                    
                } else {
                    $flagset = 1;
                    $listsend = $listsend + 1;
                    while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                        $emailtosend = $availcheck_result1['email'];
                        $ufname = $availcheck_result1['first'];
                        @$umname = $availcheck_result1['middle'];
                        $ulname = $availcheck_result1['last'];
                    }
                    $recruiteremail = $_SESSION['email'];


                    if ($umname == "") {
                        $ufulname = $ufname . " " . $ulname;
                    } else {
                        $ufulname = $ufname . " " . $umname . " " . $ulname;
                    }
                    $sendmessagetouser_op = sendmessagetouser($ufulname, $emailtosend, $mesg, $fulname, $recruiteremail);
                    if ($flagset == 1) {

                        $userliststring = $userliststring . "," . $ufulname;
//echo "<p class=\"list_name_user\">$ufulname</p>";
                    }
                }

                /* mobile app code */
                $availcheck2 = "SELECT * FROM `gcm_users` where `member_id`='$tid'";
                $availcheck_result2 = mysql_query($availcheck2);
                $availcheck_check2 = mysql_num_rows($availcheck_result2);
                if ($availcheck_check2 > 0) {
                    while ($row = mysql_fetch_array($availcheck_result2)) {
                        $registatoin_ids = array($row["gcm_id"]);
                        $message = array
                            (
                            'email' => $recruiteremail,
                            'message' => $mesg,
                            'title' => 'EMDB',
                            'sound' => 1,
                        );
                        $result = $gcm->send_notification($registatoin_ids, $message);
                        //print_r(json_decode($result));
                    }
                } else {
                    
                }
                /* mobile app code */
            }



//send message
        }
        $userliststringsingle = explode(",", $userliststring);
        $titleonce = 1;
        foreach ($userliststringsingle as $selecteduserlist) {
            if ($titleonce == 1) {
                echo "<hr>";
                echo "<h6>The message was sent to </h6>";
                $titleonce = 2;
            }
            echo "<p class=\"list_name_user\">$selecteduserlist</p>";
        }
    }

//Change Folder
    if (isset($_POST['folder'])) {
        $nopath = "";
        $subpath = "";
        $mainpath = "";
        $radioselected = $_POST['folder'];
        if ($radioselected == "existing") {
            $mainpath = $_POST['pathspecify'];
            if ($mainpath != "") {
                $subpath = $_POST['subfolder2'];

                if ($subpath != "") {
                    $path = $subpath;
                } else {
                    $path = $mainpath;
                }
            } else {
                $path = $mainfolder;
            }
        } else {
            $mainpath = $_POST['mainfolder'];
            $subfolder1 = $_POST['subfolder1'];
            if ($mainpath != "") {

                $reqpath = "./" . $mid . "/" . $mainpath;
                @mkdir($reqpath, 0777);


                if ($subfolder1 != "") {

                    $reqpath = $reqpath . "/" . $subfolder1;
                    @mkdir($reqpath, 0777);
                    $path = $reqpath;
                } else {
                    $path = $reqpath;
                }
            } else {

                $path = $mainfolder;
            }
        }



        $pathshow = str_replace("./$mid/", "", $path);
        //  echo "<p class=\"notify_text\">The below entries were moved to <b>$pathshow</b></p>";
        //   echo "<p class=\"notify_green\">";
        foreach ($_POST['filestobemoved'] as $selected) {
            //echo $selected;
            //  echo "<br>";
            $targetdir = $path;
            @mkdir($targetdir, 0777);
            @chmod($selected, 0777);

            $mail_check = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id`='$selected' and recruiterId='$mid'");
            $num = mysql_fetch_assoc($mail_check);
            $mainpath1 = str_replace("./", "", $num['filepath']);
            $finalfilnam = explode("/", $mainpath1);
            $justfinalfile = end($finalfilnam);
            //   echo "<br>";
            $path = str_replace("./", "", $targetdir);
            $cntfolders = count($targetfile = explode("\\", $justfinalfile));

            $somevar = "$path/" . $targetfile[$cntfolders - 1];
            //$from = str_replace("./", "", $targetfile[$cntfolders - 1]);echo "<br>";
            $to = "$path/" . $justfinalfile;

            if (copy($mainpath1, $to)) {
                //$to = "$path\\" . $targetfile[$cntfolders - 1];
                $to = mysql_real_escape_string($to);
                $mpath = "./" . $to;
                $sql = "UPDATE recruit_users SET filepath='$mpath' WHERE `user_id`='$selected' and recruiterId='$mid'";
                $uppath = mysql_query($sql);
            }

            if ($to != $mainpath1) {
                $newselected = $mainpath1;
                unlink("$newselected");
            }
            $moveResumes = 1;
            $movedFiles[] = $justfinalfile;
        }

        //  echo "</p>";
    }

//Change Folder
    if (isset($_POST['delete']) || isset($_POST['mail']) || isset($_POST['follow']) || isset($_POST['download']) || isset($_POST['messageuser']) || isset($_POST['movefolder'])) {

        $count = count($_POST['check_list']);
        if ($count == 0) {
            ?>
            <link rel="stylesheet" href="popstyles/main.css">
            <div id="boxes">
                <div  id="dialog" class="window"> Please Select Atleast One Record.
                    <a href="#" class="close" style="">X</a>
                </div>
                <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
            </div>
        <!--                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> -->
            <script src="popstyles/main.js"></script>
            <?php
        } else {
            if (isset($_POST['check_list'])) {//to run PHP script on submit
                if (!empty($_POST['check_list'])) {
                    if (isset($_POST['inviteall'])) {
                        $listsend = "";
                        $flagset = 0;
                        $inviteflag = 0;
                        echo "<div style='height: 500px;overflow: scroll;'>";
                        foreach ($_POST['check_list'] as $selected) {
                            $finalfilnam = explode("/", $selected);
                            $justfinalfile = end($finalfilnam);
                            $docObj = new Filetotext("$selected");
                            $return = $docObj->convertToText();
                            $mystring = $return;
                            $pos = 0;
                            $endpos = 0;
                            $findme = 'EMDB';
                            $pos = strpos($mystring, $findme);

                            // Note our use of ===. Simply, == would not work as expected
                            // because the position of 'a' was the 0th (first) character.

                            if ($pos === false) {
                                $text = $mystring;
                                foreach (preg_split('/\s/', $text) as $token) {
                                    $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                                    if ($email !== false) {
                                        $email = str_replace("mailto", "", $email);
                                        $emails[] = $email;
                                        break;
                                    }
                                }
                                // echo  print_r($rt=  array_unique($emails));
                                if (!empty($emails)) {
                                    $emails = array_unique($emails);

                                    foreach ($emails as $selectedemail) {
                                        if ($inviteflag == 0) {
                                            ?>  
                                            <hr>
                                            <p>Would you like to invite these users who does not have an account with Us.</p>
                                            <p><input type="checkbox" id="check_invite" value="select" onClick="do_invite()" />Select All</p>
                                            <form action="" method="POST">
                                                <input type="submit" size="11" id="invite"    name="invite" value="Invite"  />
                                                <?php
                                                $inviteflag = 1;
                                            }

                                            echo "<input type=\"checkbox\" id=\"checkforinvite\" name=\"check_invite[]\" value=\"$selectedemail\">";
                                            echo $selectedemail;
                                            echo "<br>";

                                            $emails = array();
                                        }
                                    }
                                }
                            }
                            echo "</div>";
                        }

// Loop to store and display values of individual checked checkbox.
                        elseif (isset($_POST['delete'])) {

//                                            echo "<p class=\"notify_text\">The selected entries were removed</p>";
                            echo "<p class=\"notify_green\">";

                            foreach ($_POST['check_list'] as $selected) {
                                // echo $selected;echo "<br>";echo $mid;
                                $finalfilnam = explode("/", $selected);
                                $delEmails = end($finalfilnam);
                                // echo $sqlComp = "SELECT * FROM `user` where `email`='$delEmails'";
                                $delmail_check = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id`='$selected' and recruiterId='$mid'"));
                                $delpath = $delmail_check['filepath'];
                                unlink("$delpath");
                                $delsql = "DELETE FROM `recruit_users` WHERE  `user_id`='$selected' and recruiterId='$mid'";
                                mysql_query($delsql);
                            }
                            foreach ($_POST['userId'] as $userId) {

                                //echo "mmk". $userId;echo "<br>";
                            }
                            echo "</p>";
                            ?>

                            <script src="http://code.jquery.com/jquery.min.js"></script>
                            <script type="text/javascript">
                                    $(document).ready(function () {

                                        setTimeout(function () {

                                            window.location.href = "list_resumes.php";
                                        }, 10);


                                    });
                            </script>

                            <?php
                        } elseif (isset($_POST['movefolder'])) {
                            ?>

                            <link rel="stylesheet" href="popstyles/main.css">
                            <div id="boxes" style="">
                                <div  id="dialog" style="font-family: 'Times New Roman', Times, serif;font-size: 18px;border-radius:0px;" class="window"> <b>Please Move Your Files</b><br> <?php ?>
                                    <!--- start of movefile to folder-->
                                    <form enctype="multipart/form-data" method="post" action="">
                                        <p>
                                        <p style="float:left">
                                            <input type="radio" name="folder" value="new">New Folder
                                            <input type="radio" name="folder" CHECKED value="existing">Existing Folder
                                        </p>
                                        <select name="pathspecify" id="pathspecify" style="float:left" class="form-control">
                                            <option value="">Select Parent Folder</option>
                                            <?php

                                            function listFolderFiles($dir) {

                                                foreach (new DirectoryIterator($dir) as $fileInfo) {
                                                    if (!$fileInfo->isDot()) {
                                                        global $mainfolder;
                                                        if ($fileInfo->isDir()) {
                                                            $dirnam = $fileInfo->getPathname();
                                                            $dirnamlist = str_replace($mainfolder, "", $dirnam);
                                                            echo "<option value=\"$dirnam\">$dirnamlist</option>";

                                                            //listFolderFiles($fileInfo->getPathname());
                                                        }
                                                    }
                                                }
                                            }

                                            listFolderFiles("./$mid");
                                            foreach ($_POST['check_list'] as $selected) {
                                                echo "<input type=\"hidden\" name=\"filestobemoved[]\" value=\"$selected\">";
                                            }
                                            ?>
                                        </select> <div id="div1" style="padding-left: 0px;
                                                       padding-right: 0px;
                                                       margin: 10px 0px;"></div> <br>
                                        <div  style="
                                              margin-top: 50px;
                                              ">
                                            <input style="display:none;" type="text" id="mainfolder" name="mainfolder" class="form-control" placeholder="Main Folder " >
                                            <input style="display:none;margin-top: 10px;" type="text" id="subfolder1" name="subfolder1" class="form-control" placeholder="Sub Folder " > 
                                        </div> 


                                        <p class="notify_text" style="margin-top: 10px;"><input type="submit" style="float:left" name="submit" class="btn btn-primary" id="theresume"  value="Move" /></p>
                                    </form>


                                    <script>
                                        $(document).ready(function ()
                                        {



                                            $('#pathspecify').change(function ()
                                            {
                                                var foldername = $(this).val();
                                                var folder = $('input:radio[name=folder]:checked').val();
                                                if (foldername == 'Create Parent Folder')
                                                {
                                                    $('#mainfolder').show();
                                                    $('#subfolder1').show();
                                                    $('#div1').hide();
                                                }
                                                else
                                                {
                                                    $('#mainfolder').hide();
                                                    $('#subfolder1').hide();
                                                    $('#div1').show();
                                                }
                                                if (folder == 'existing')
                                                {
                                                    $.ajax({data: {foldername: foldername}, url: "ajaxfolder.php", success: function (result) {
                                                            $("#div1").html(result);
                                                        }});
                                                }
                                                else
                                                {
                                                    $('#subfolder1').show();
                                                    $('#subfolder').hide();
                                                }
                                            });





                                            $("input[name='folder']").click(function () {
                                                if ($('input:radio[name=folder]:checked').val() == "new")
                                                {
                                                    $('#div1').hide();
                                                    $("#pathspecify").append(new Option("Create Parent Folder", "Create Parent Folder"));

                                                }
                                                else {
                                                    $('#div1').show();
                                                    $("#pathspecify option[value='Create Parent Folder']").remove();
                                                    $('#mainfolder').hide();
                                                    $('#subfolder1').hide();

                                                }
                                            });
                                        });
                                    </script>
                                    <!--- end of movefile to folder-->

                                </div>
                                <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                            </div>
                            <script src="popstyles/main.js"></script>
                            <?php
                        }
                        //Message User
                        elseif (isset($_POST['messageuser'])) {
                            ?>
                            <form  method="post" action="">
                                <HR COLOR="#258EC8"  SIZE="6" >
                                <p class="notify_text"><textarea name="messagemail" >Please enter the message to be send...</textarea>

                                    <?php
                                    foreach ($_POST['check_list'] as $selected) {
                                        echo "<input type=\"hidden\" name=\"emailstobesent[]\" value=\"$selected\">";
                                    }
                                    ?> 
                                    <input type="submit" name="submit"  id="reachuser"  value="Send" /></p>

                                <HR COLOR="#258EC8"  SIZE="6" >

                            </form>
                            </br>
                            <?php
                        }
                        //Message User
//follow User
                        elseif (isset($_POST['follow'])) {
                            ?>
                            <p class="notify_text"><!-- You are following >>>-->
                                <?php
                                $listup = "";
                                $flagset = 0;

                                foreach ($_POST['check_list'] as $selected) {

//                                                    echo "SELECT * FROM `recruit_users` where `user_id` ='$selected' and `recruiterId`='$mid'";exit;
                                    $getpath = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id` ='$selected' and `recruiterId`='$mid' ");
                                    $takepath = mysql_fetch_assoc($getpath);
                                    $fPath = $takepath['filepath'];
                                    $finalfilnam = explode("/", $fPath);
                                    $justfinalfile = end($finalfilnam);
                                    $justfinalfile = str_replace("\\", "/", $justfinalfile);
                                    $docObj = new Filetotext("$fPath");
                                    $return = $docObj->convertToText();
                                    $mystring = $return;
                                    $pos = 0;
                                    $endpos = 0;
                                    $findme = 'EMDB';
                                    $pos = strpos($mystring, $findme);

                                    // Note our use of ===. Simply, == would not work as expected
                                    // because the position of 'a' was the 0th (first) character.
                                    if ($pos === false) {
                                        
                                    } else {

                                        // echo "$pos";
                                        $endpos = 20;
                                        $caidval = substr($mystring, $pos, $endpos);
                                        $tid = str_replace("EMDB", "", $caidval);
                                        $tid = preg_replace('/\s+/', '', $tid);
                                        $tid = substr($tid, '0', '12');


                                        //echo $tid;
//echo "SELECT * FROM `user` where `member_id`='$tid'"; 

                                        $availcheck = "SELECT * FROM `user` where `member_id`='$tid'";
                                        $availcheck_result = mysql_query($availcheck);
                                        $availcheck_check = mysql_num_rows($availcheck_result);
                                        if ($availcheck_check != 1) {
                                            
                                        } else {
                                            $flagset = 1;
                                            $listup = $listup + 1;
                                            while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                                                $memberid = $availcheck_result1['member_id'];
                                                $ufname = $availcheck_result1['first'];
                                                @$umname = $availcheck_result1['middle'];
                                                $ulname = $availcheck_result1['last'];
                                            }



                                            if ($umname == "") {
                                                $ufulname = $ufname . " " . $ulname;
                                            } else {
                                                $ufulname = $ufname . " " . $umname . " " . $ulname;
                                            }
                                            $followcheck = "SELECT * FROM `follow` where `member_id`='$tid' and user_id='$mid'";
                                            $follow_result = mysql_query($followcheck);
                                            $follow_check = mysql_num_rows($follow_result);
                                            if ($follow_check == 0) {
                                                $followuserquery = "INSERT INTO `follow` (member_id,user_id,status) VALUES 
('$memberid','$mid','1')";
                                                $followuserquery_result = mysql_query($followuserquery);
                                            }
                                            ?>
                                            <link rel="stylesheet" href="popstyles/main.css">
                                        <div id="boxes" style="">
                                            <div  id="dialog" style="font-size: 18px;border-radius:0px;width: 30%;" class="window"> <b style='color:green;'>The selected resumes were added into following list.</b><br><br>


                                                <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                                            </div>
                                            <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                                        </div>
                                        <script src="popstyles/main.js"></script>


                                        <?php
                                    }
                                }
                            }
                            if ($listup == "") {
                                ?>
                                <link rel="stylesheet" href="popstyles/main.css">
                                <div id="boxes" style="">
                                    <div  id="dialog" style="font-size: 18px;border-radius:0px;width: 30%;" class="window">
                                        <?php
                                        echo "<spam style='color:red;'>No user cannot follow as the users doesnt have an EMDB ID in their documents</spam>";
                                        ?>

                                        <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                                    </div>
                                    <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                                </div>
                                <script src="popstyles/main.js"></script>

                            <?php }
                            ?>
                            </p>
                            <?php
                        }
//follow User
                        else {
                            $files = [];
                            foreach ($_POST['check_list'] as $selected) {
//                                                echo $selected;echo "<br>";
                                $checkemail = mysql_query("SELECT * FROM `recruit_users` where `user_id`='$selected' and `recruiterId`='$mid'");
                                $pathresult = mysql_fetch_assoc($checkemail);
                                $pathss = str_replace("\\", "/", $pathresult['filepath']);
                                $files[] = $pathresult['filepath'];
                            }



                            # create new zip opbject
                            $zip = new ZipArchive();

                            # create a temp file & open it
                            $tmp_file = tempnam('.', '');
                            $zip->open($tmp_file, ZipArchive::CREATE);

                            # loop through each file
                            foreach ($files as $file) {

                                # download file
                                $download_file = file_get_contents($file);

                                #add it to the zip
                                $zip->addFromString(basename($file), $download_file);
                            }

                            # close zip
                            $zip->close();

                            # send the file to the browser as a download
                            header('Content-disposition: attachment; filename=Resumes.zip');
                            header('Content-type: application/zip');
                            readfile($tmp_file);
                            unlink($tmp_file);
                        }
                    }
                }
            }
        }
        ?>
        <?php if ($_POST['delete'] != '') { ?>
            <link rel="stylesheet" href="popstyles/main.css">
            <div id="boxes" style="">
                <div  id="dialog" style="font-size: 18px;border-radius:0px;" class="window"> <b>The selected entries were removed.</b><br><br> <?php ?>

                    <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                </div>
                <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

            </div>
            <script src="popstyles/main.js"></script>
        <?php }
        ?>
        <?php if ($moveResumes == 1) { ?>
            <link rel="stylesheet" href="popstyles/main.css">
            <div id="boxes" style="">
                <div  id="dialog" style="font-family: 'Times New Roman', Times, serif;text-align:justify;font-size: 18px;border-radius:0px;" class="window"> <b>The Below Resumes Were Moved To <?php echo $pathshow; ?></b><br><br> 

                    <?php
                    foreach ($movedFiles as $resumes) {
                        echo $resumes;
                        echo "<br>";
                    }
                    ?>

                    <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                </div>
                <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

            </div>
            <script src="popstyles/main.js"></script>
        <?php }
        ?>