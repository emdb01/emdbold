<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
$mid = $_SESSION['user_id'];
//$str = 34;
// $mk=base64_encode($str);
// base64_decode($mk);
$theroot = "./$mid";
@mkdir($theroot, 0777,true);
?>
<head>
    <title> EMDB Documentation </title> 
    <link rel="icon"  type="image/ico" href="images/favicon.ico">
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <style>
        .search {
            width: 74%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            float:right;
            background-color: white;
            background-image: url('assets/img/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 8px 20px 8px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }
        .search:focus {
            width: 100%;
        }
        .topicons i{
            font-size:20px;
            color:#656464;
            border-radius: 2px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border: 1px solid transparent;
            cursor: pointer;
            height: 32px;
            outline: none;
            padding: 0;
            position: relative;
            vertical-align: top;
            width: 32px;
        }
        #page-wrapper {
            position: inherit;
            margin: 0 0 0 250px;
            padding: 0 15px!important;    
        }
    </style>
</head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row" style="position: fixed;
                 z-index: 999;

                 width: 100%;
                 background: #f1f1f1;position: fixed;
                 z-index: 999;
                 width: 100%;
                 margin-bottom: 20px;
                 padding-bottom: 20px;
                 background: #f1f1f1;
                 -webkit-box-shadow: 0 2px 4px rgba(0,0,0,.2);
                 box-shadow: 0 2px 4px rgba(0,0,0,.2);
                 -webkit-transition: height .35s cubic-bezier(0.4,0.0,1,1),border-color .4s;
                 transition: height .35s cubic-bezier(0.4,0.0,1,1),border-color .4s;
                 background-color: #fafafa;
                 border-bottom: 1px solid transparent;
                 border-top: 1px solid #e5e5e5;">
                <!-- Page Header -->
                <div class="col-lg-12" >
                    <div class="col-lg-6">
                        <h1 class="page-header1" style="margin: 40px 0 0px;">Resume Database  
                        </h1> 
                        <?php $actual_link = $_GET['dir']; ?>
                    </div>  
                    <div class="col-lg-3" style="margin: 40px 0 0px;"> <div class="page-header1">
                            <form action="documentation.php?dir=<?php echo $actual_link; ?>" target="_blank" method="POST" role="form" style="" >
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" style="float:left;" required="required" name="filepath" value="" placeholder="Search by file name" />
                                </div>

                                <div class="col-lg-2">
                                    <button type="submit" id="register"  value="Search" class="btn btn-primary" style="float:right;">Search</button>  
                                </div>
                            </form> 
                        </div>

                    </div>

                </div>
                <div class="col-lg-12">

                    <!--                    <button type="button" id='gridView' class="btn btn-info" style="float:right;height: 34px;
                                                margin-top: 9px;" ><a href="#"><i class="fa fa-th-large"></i></a></button>
                                        <button type="button" id='listView' class="btn btn-info" style="float:right;height: 34px;
                                                margin-top: 9px;" ><a href="#"><i class="fa fa-th-list"></i></a></button>-->
                    <?php //  include('navigation.php'); ?>

                    <div class="col-lg-5" style="border:none;margin: 20px 0 0px;">
 

                        <ul class="nav1 nav-tabs" style="border:none;"> 
                            <li class="dropdown" style="list-style:none;">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button type="button" style="margin-top: ;margin-left: px;color: #222;
                                                                                                   background-color: transparent;font-weight:600;padding:5px;border-color:#fff" class="btn btn-success" ><?php
                $actual_link;
                $cnt = count($expl = explode("/", $actual_link));
                for ($i = 0; $i < $cnt; $i++) {
                    ?>
                    <a href="#" style="text-decoration:none;" onclick="myfun('<?php echo $i + 1; ?>');"> <?php // echo $mid. $expl[$i];
                    
                    echo str_replace($mid,"My Home >",$expl[$i]);
                echo " >";
                    ?> </a>  
                <?php
                }?> &nbsp;
                <!--<span class="caret"></span>-->
                                    </button></a>
<!--                                <ul class="dropdown-menu">
                                    <li><a href='#' data-display="newFolder"><i class="fa  fa-folder fa-fw"></i> New Folder</a></li>
                                    <li><a href="#" data-display="fileUpload" ><i class="fa fa-upload fa-fw"></i> File Upload</a></li>
                                </ul>-->
                            
                            </li></ul>



                    </div>
                    <div class="col-lg-3" style="border:none;margin: 20px 0 0px;">
                        <a href="#" class="topicons" id="previewF" onclick="previewreq();"   data-display="previewFile" title="View">  <i class="fa fa-eye fa-fw"></i></a>
                        <a href="#" class="topicons" id="showRename" data-display="renameFolder"  title="Rename">  <i class="fa fa-edit fa-fw"></i></a>
                        <a href="#" class="topicons" id="showMovef" data-display="moveFile"  title="Move">  <i class="fa fa-mail-forward fa-fw"></i></a>
                        <a href="filedown.php" class="topicons" id="showDownf"   title="Download">  <i class="fa fa-download fa-fw"></i></a>
                        <a href="#" class="topicons" id="showRemove" data-display="delFolder"  title="Delete">  <i class="fa fa-trash fa-fw"></i></a>



                    </div>

                    <div class="col-lg-1" style="border:none;margin: 15px 0 0px;">
                        <ul class="nav1 nav-tabs" style="border:none;"> 
                            <li class="dropdown" style="list-style:none;">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><button type="button" style="margin-top: ;margin-left: px;width:66px;" class="btn btn-success">ADD &nbsp;<span class="caret"></span></button></a>
                                <ul class="dropdown-menu">
                                    <li><a href='#' data-display="newFolder"><i class="fa  fa-folder fa-fw"></i> New Folder</a></li>
                                    <li><a href="#" data-display="fileUpload" ><i class="fa fa-upload fa-fw"></i> File Upload</a></li>
                                </ul></li></ul>

                    </div>



                </div>
                <!--End Page Header -->
            </div>
            <?php
            if (isset($_POST['newFolder'])) {
                $folderPath = $_GET['dir'] . '/' . $_POST['newFolder'];
                @mkdir($folderPath, 0777);
            }
            ?>
            <div id="delFolder" class="portBox" style="width: 23%;left: 359.5px;border-radius:0px;">
                <div id="showConf">  <b  style="">Are you sure you want to delete permanently?</b><br><br>
                     <!-- <input type="submit" class="close-portBox" value="Cancel">--> <input type="submit" onclick="second();" value="Yes" style="float:right;" class="btn btn-primary"> 
                </div>
                <div id="loadStatus"><img src="images/ajaxloader.gif"/> Deleting...</div><b id="DelSucc" style="">Deleted Succesfully.</b>
            </div>
            <div id="newFolder" class="portBox" style="width: 28%;left: 359.5px;height:31%;border-radius:0px;">
                <b id="" style="">New Folder</b><br>
                <form action=""  method="POST" role="form" style="margin-top:30px;" >
                    <input type="text" required class="form-control" placeholder='Create New Folder' name="newFolder" style="width: 100%;"><br>
                   <!-- <input type="submit" class="close-portBox" value="Cancel">--> <input type="submit" value="Submit" style="float:right;" class="btn btn-primary"> 
                </form>
            </div>



            <!--Popup for View Resume  and Voice message------>
            <script src="js/jquery-1.10.2.min.js"></script>
            <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
            <script src="js/portBox.slimscroll.min.js"></script>
            <link href="css/portBox.css" rel="stylesheet" />
            <!--Popup for View Resume  and Voice message------>
            <script src="js/jquery.min.js"></script>
            <script>
                         $(document).ready(function () {
                             $("#gridView").hide();
                             $("#List").hide();
                             $(document).on("click", "#listView:not(.disabled)", function () {
                                 $("#listView").hide();
                                 $("#gridView").show();
                                 $("#List").show();
                                 $("#Grid").hide();
                             });
                             $(document).on("click", "#gridView:not(.disabled)", function () {
                                 $("#listView").show();
                                 $("#gridView").hide();
                                 $("#Grid").show();
                                 $("#List").hide();
                             });
                         });
            </script>




            <!--            <div class="row" >
                            <form action=""  method="POST" role="form" style="" >
                                  <div class="col-lg-12" style="">
                                      <div id="page-content" class="container">
                                          <div class="col-lg-4">
              
                                          </div>
                                          <div class="col-lg-4">
              
                                              <input class="form-control" type="text" style="margin-left: -294px;" required="required" name="filepath" value="" placeholder="Search by File Name" />
                                          </div>
                                          <div class="col-lg-4">
                                              <button type="submit" id="register"  value="Search" class="btn btn-primary" style="margin-left: -300px;">Search</button>  
                                          </div>
              
              
              
                                      </div>	</div>
                              </form>
            
                            <br><br>
                        </div>-->

        </div>
        <script>

            function myfun(path) {
                var actlink = '<?php echo $actual_link; ?>';
                var parts = actlink.split('/');
                var p1 = parts.slice(0, path).join('/');
                window.location.href = "documentation.php?dir=" + p1;
            }
        </script>
        <!-- end page-wrapper -->
        <div id="page-wrapper" style="margin-top: -415px;">
            <div class="row" style="">               
              <?php  include('documents.php');
                ?>
            </div></div>

    </div>


    <!-- end wrapper -->

<!--    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>-->

</body>

</html>



<div id="downFile" class="portBox" style="width: 28%;left: 359.5px;border-radius:0px;">
    <b id="downPrepare" style="">Preparing Download...</b>
    <div id="loadStatusDown"><img src="images/ajaxloader.gif"/></div><b id="downSucc" style="">Download Succesfully.</b>
</div>


<div id="previewFile" class="portBox" style="width: 72%;left: 170px;border-radius:0px;height: 501px;
    margin-top: -134px">
    <div id="getPreview">
    </div>
</div>
<div id="renameFolder" class="portBox" style="width: 28%;left: 359.5px;height:31%;border-radius:0px;">
    <b  style="pading:10px;">Rename</b>
    <!--                <form action=""  method="POST" role="form" style="" > -->
   <p style="margin-top:30px;">
   </p>
    <input type="text" required placeholder='Rename File' class="form-control" id="renameFile" name="reFolder" >
    <input type="text" required placeholder='Rename File' class="form-control" id="renameFileOne" name="reFolder" >

    <br>
    <input type="hidden"  placeholder='Rename File'  id="tpathFile" name="reFolder" >
    <input type="hidden"  placeholder='Rename File' id="tpathFileOne" name="reFolder" >
  <!-- <input type="submit" class="close-portBox" value="Cancel">--> <input type="submit" style="float:right;" class="btn btn-primary" onclick="renameFiles();" value="Rename" > 
    <!--                </form>-->           
    <div id="loadStatus1"><img src="images/ajaxloader.gif"/></div><b id="RenSucc" style="">Renamed Succesfully.</b><b id="eroor" style="">Please Enter Name</b>
</div>
<div id="moveFile" class="portBox" style="width: 28%;left: 359.5px;border-radius:0px;">
    <div id="loadStatusMove"><img src="images/ajaxloader.gif"/> </div><b id="movesucc" style="">Moved Succesfully.</b>
    <div   id="hideMove" style="font-family: 'Times New Roman', Times, serif;font-size: 18px;border-radius:0px;" class="window">  <?php ?>
        <!--- start of movefile to folder-->


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


        <p class="notify_text" style="margin-top: 10px;"><input type="submit" style="float:left" name="submit" class="btn btn-primary" id="theresume" onclick="moveFiles();" value="Move" /></p>


    </div>
</div>
<?php
$sql1 = "UPDATE `removefiles` SET  `status`=1  WHERE recruiterId='$mid'";
$mys1 = mysql_query($sql1);
?>
<div id="fileUpload" class="portBox" style="width: 60%;left: 359.5px;border-radius:0px;height:400px;">
<div class="col-lg-12">
    <b id="" style="color: #015498;">File Upload</b><br><br>
    <p><i class="fa fa-arrow-right"></i>  To share the login credentials with the job seeker, please choose Send Logins option.</p>
   <p><i class="fa fa-arrow-right"></i>   To send an invitation email to the job seeker, please choose Invite option. </p>
   <p> <b style="color:red;">Note:</b>These options are applicable only to the new job seekers.</p></div>
    <div class="col-lg-5">
      
        <?php include('indexfile.html'); ?>
</div>
<div class="col-lg-7"></br>
    <b id="" style="color: #015498;">Points to be considered while uploading</b><br><br>
    <p><i class="fa fa-arrow-right"></i> Upload a compressed zip folder with all your resumes.</p>
                            <p><i class="fa fa-arrow-right"></i> Only the extensions .pdf, .docx and .doc are allowed.</p>
                            <p><i class="fa fa-arrow-right"></i> Resumes with same name will be overwritten.</p>
                            <p><i class="fa fa-arrow-right"></i> Do not zip a folder, the zip should contain only the files not any folder.</p>
                            <p><i class="fa fa-arrow-right"></i> File size must be less than 10 MB.</p>
</div>
</div>
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
//                                $("#div3").html(result);
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

<?php
// include('tooltip.html');?>