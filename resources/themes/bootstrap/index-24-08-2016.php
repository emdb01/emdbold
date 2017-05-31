<!DOCTYPE html>

<html>

    <head>

        <title><?php //echo $lister->getListedPath();                                        ?></title>
        <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/img/folder.png">

        <!-- STYLES -->
<!--                <script type="text/javascript" src="//code.jquery.com/jquery-1.7.0.min.js"></script>-->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/style.css">

        <!-- SCRIPTS -->
      <!--  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/directorylister.js"></script>

        <!-- FONTS -->
        <link rel="stylesheet" type="text/css"  href="//fonts.googleapis.com/css?family=Cutive+Mono">
        <script>
            function back() {
                window.history.back();
            }
        </script>
        <style>
            .titleemdbg{
                background-color: #fff;
                background-clip: padding-box; 
                min-height: 28px;
                /*                -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.25);
                                box-shadow: 0 2px 8px 0 rgba(0,0,0,.25);*/
                padding: 30px; 
                position: relative;

            }
            .titleemdbg i{
                font-size: 49px;
                margin-right: 0px! important;
                text-align: center;
                font-weight: 400;
            }
            .textch{
                color: #222;
                font-size: 15px;
                text-transform:captalise;
                font-weight:600;
                line-height: 40px;
                width: 100%; 
                background: #f1f1f1;

                text-align:center
            }

        </style>
        <!-- META -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">

        <?php file_exists('analytics.inc') ? include('analytics.inc') : false; ?>

    </head>



    <?php
    $breadcrumbs = $lister->listBreadcrumbs();
//    print_r($breadcrumbs);
    $user_id = $_SESSION['user_id'];
    ?>

    <div id="page-content" class="container">

        <p class="navbar-text">

            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                <?php if ($breadcrumb != end($breadcrumbs)): ?>

                    <a href="<?php echo $breadcrumb['link']; ?>"><?php
                        echo str_replace($user_id, "", $breadcrumb['text']);
//                    echo $breadcrumb['text']; 
                        ?></a>
                    <span class="divider">></span>
                <?php else: ?>
                    <?php echo str_replace($user_id, "", $breadcrumb['text']); ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php file_exists('header.php') ? include('header.php') : include($lister->getThemePath(true) . "/default_header.php"); ?>

            <?php if ($lister->getSystemMessages()): ?>
                <?php foreach ($lister->getSystemMessages() as $message): ?>
                <div class="alert alert-<?php echo $message['type']; ?>">
                    <?php
                    echo $message['text'];
                    exit;
                    ?>
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="col-lg-12">


            <div id="List">

                <div id="directory-list-header">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 col-xs-10">File</div>
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right">Size</div>
                        <div class="col-md-3 col-sm-4 hidden-xs text-right">Last Modified</div>
                    </div>
                </div>
                <?php
                if ($_POST['filepath'] != '') {
                    $i = 0;
                    foreach ($dirArray as $name => $fileInfo):
                        $i++;
                        $name = strstr($name, $_POST['filepath']);
                        ?>
                        <?php if ($name != '') { ?>
                            <ul id="directory-listing" class="nav nav-pills nav-stacked">

                                <li data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                                    <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>" >


                                        <div class="row">
                                            <?php if ($i == 1) { ?>
                                                <span class="file-name col-md-7 col-sm-6 col-xs-9" onclick="back()" >
                                                    <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                                                    <?php echo $name; ?>
                                                </span>
                                            <?php } else { ?>
                                                <span class="file-name col-md-7 col-sm-6 col-xs-9" >
                                                    <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                                                    <?php echo $name; ?>
                                                </span>
                                            <?php } ?>
                                            <span class="file-size col-md-2 col-sm-2 col-xs-3 text-right">
                                                <?php echo $fileInfo['file_size']; ?>
                                            </span>

                                            <span class="file-modified col-md-3 col-sm-4 hidden-xs text-right">
                                                <?php echo $fileInfo['mod_time']; ?>
                                            </span>
                                        </div>

                                    </a>

                                    <?php if (is_file($fileInfo['file_path'])): ?>

                                        <!--<a href="javascript:void(0)" class="file-info-button">
                                            <i class="fa fa-info-circle"></i>
                                        </a>-->

                                    <?php else: ?>

                                        <?php if ($lister->containsIndex($fileInfo['file_path'])): ?>

                                            <a href="<?php echo $fileInfo['file_path']; ?>" class="web-link-button" <?php if ($lister->externalLinksNewWindow()): ?>target="_blank"<?php endif; ?>>
                                                <i class="fa fa-external-link"></i>
                                            </a>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                </li>


                            </ul> 
                        <?php } ?>
                        <?php
                    endforeach;
                }else {
                    ?>
                    <ul id="directory-listing" class="nav nav-pills nav-stacked">

                        <?php
                        $i = 0;
                        foreach ($dirArray as $name => $fileInfo):
                            $i++;
                            ?>
                            <li data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                                <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>" >


                                    <div class="row">
                                        <?php if ($i == 1) { ?>
                                            <span class="file-name col-md-7 col-sm-6 col-xs-9" onclick="back()" >
                                                <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                                                <?php echo $name; ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="file-name col-md-7 col-sm-6 col-xs-9" >
                                                <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                                                <?php echo $name; ?>
                                            </span>
                                        <?php } ?>
                                        <span class="file-size col-md-2 col-sm-2 col-xs-3 text-right">
                                            <?php echo $fileInfo['file_size']; ?>
                                        </span>

                                        <span class="file-modified col-md-3 col-sm-4 hidden-xs text-right">
                                            <?php echo $fileInfo['mod_time']; ?>
                                        </span>
                                    </div>

                                </a>

                                <?php if (is_file($fileInfo['file_path'])): ?>

                                    <!--<a href="javascript:void(0)" class="file-info-button">
                                        <i class="fa fa-info-circle"></i>
                                    </a>-->

                                <?php else: ?>

                                    <?php if ($lister->containsIndex($fileInfo['file_path'])): ?>

                                        <a href="<?php echo $fileInfo['file_path']; ?>" class="web-link-button" <?php if ($lister->externalLinksNewWindow()): ?>target="_blank"<?php endif; ?>>
                                            <i class="fa fa-external-link"></i>
                                        </a>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>

                    </ul>         
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-12">
            <div id="Grid">
                <?php
                $i = 0;
                if ($_POST['filepath'] != '') {
                    ?>
                    <div class="row">
                        <?php
                        foreach ($dirArray as $name => $fileInfo):
                            $i++;
                            $name = strstr($name, $_POST['filepath']);
                            $ext = pathinfo($fileInfo['url_path'], PATHINFO_EXTENSION);
                            ?>

                            <?php if ($name != '') { ?>
                                <?php
                                if ($ext == '') {
                                    $findme = 'https://';
                                    $pos = strpos($fileInfo['url_path'], $findme);
                                    if (strlen($pos) != 0) {
                                        
                                    } else {
                                        ?>
                                        <div class="col-lg-3">
                                            <div class="panel panel-primary text-center no-boder " id="bgstyle<?php echo $i; ?>" style="padding:10px;" onClick="myStyle('<?php echo urldecode(ltrim($fileInfo['url_path'], "?dir=")); ?>',<?php echo $i; ?>, '<?php echo $name; ?>');">
                                                <a href="<?php echo $fileInfo['url_path']; ?>"   class="clearfix tooltip1"  style='opacity:1;color: #161616;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >
                                                    <?php if ($i == 1) { ?>
                                                        <span  onclick="back()" clas="textch">
                                                            <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw" style="float:left;"></i>
                                                            <?php
                                                            echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name;
                                                            ?>
                                                        </span>
                                                    <?php } else { ?>
                                                        <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw" style="float:left;"></i>
                                                        <?php
                                                        echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name;
                                                        ?>
                                                    <?php } ?>
                                                </a> 
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            } endforeach;
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($dirArray as $name => $fileInfo):
                            $i++;
                            $name = strstr($name, $_POST['filepath']);
                            $ext = pathinfo($fileInfo['url_path'], PATHINFO_EXTENSION);
                            if ($name != '') {
                                if ($ext != '') {
                                    ?>

                                    <div class="col-lg-3"  >
                                        <div id="bgstyle<?php echo $i; ?>" class="panel panel-primary text-center no-boder "  style="padding:2px;" onClick="myStyle('<?php echo urldecode($fileInfo['url_path']); ?>',<?php echo $i; ?>, '<?php echo $name; ?>');">
                                            <div class="titleemdbg">
                                                <!--<a href="#<?php //echo $fileInfo['url_path'];   ?>"  id='golink<?php echo $i; ?>' onClick="myStyle('<?php echo urldecode($fileInfo['url_path']); ?>',<?php echo $i; ?>, '<?php echo $name; ?>');" class="clearfix tooltip1"  style='opacity:1;text-decoration:none;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >-->
                                                <?php if ($i == 1) { ?>
                                                    <span  onclick="back()" >
                                                        <i class="fa <?php
                                                        if ($ext == 'docx' || $ext == 'doc') {
                                                            echo 'fa-file-word-o';
                                                        } else if ($ext == 'pdf') {
                                                            echo 'fa-file-pdf-o';
                                                        }
                                                        ?> fa-fw" style=""></i>                                                    
                                                    </span>
                                                    <!--<div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>--> 

                                                <?php } else { ?>
                                                    <i class="fa <?php
                                                    if ($ext == 'docx' || $ext == 'doc') {
                                                        echo 'fa-file-word-o';
                                                    } else if ($ext == 'pdf') {
                                                        echo 'fa-file-pdf-o';
                                                    }
                                                    ?> fa-fw" style=""></i>
                    <!--                                                <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>   -->
                                                <?php } ?>
                                                <!--</a>--> 
                                            </div>
                                            <?php if ($i == 1) { ?>
                                                <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>
                                            <?php } else { ?>
                                                <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>
                                            <?php } ?>
                                        </div> 
                                    </div>


                                    <?php
                                }
                            }
                            ?>



                            <?php
                        endforeach;
                        ?>
                    </div>

                    <?php
                } else {
                    $i = 0;
                    ?>
                    <div class="row">
                        <?php
                        foreach ($dirArray as $name => $fileInfo):
                            $i++;
                            $ext = pathinfo($fileInfo['url_path'], PATHINFO_EXTENSION);
                            ?>


                            <?php
                            if ($ext == '') {
                                $findme = 'https://';
                                $pos = strpos($fileInfo['url_path'], $findme);
                                if (strlen($pos) != 0) {
                                    
                                } else {
                                    ?>
                                    <div class="col-lg-3">
                                        <div class="panel panel-primary text-center no-boder " id="bgstyle<?php echo $i; ?>" style="padding:10px;" onClick="myStyle('<?php echo urldecode(ltrim($fileInfo['url_path'], "?dir=")); ?>',<?php echo $i; ?>, '<?php echo $name; ?>');">
                                            <a href="<?php echo $fileInfo['url_path']; ?>"   class="clearfix tooltip1"  style='opacity:1;color: #161616;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >
                                                <?php if ($i == 1) { ?>
                        <!--                                                <span  onclick="back()" clas="textch">
                                                                <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw" style="float:left;"></i>
                                                    <?php
//                                                    echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name;
                                                    ?>
                                                            </span>-->
                                                <?php } else { ?>
                                                    <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw" style="float:left;"></i>
                                                    <?php
                                                    echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name;
                                                    ?>
                                                <?php } ?>
                                            </a> 
                                        </div>
                                    </div>
                                <?php }
                            } endforeach;
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($dirArray as $name => $fileInfo):
                            $i++;
                            $ext = pathinfo($fileInfo['url_path'], PATHINFO_EXTENSION);
                            if ($ext != '') {
                                ?>

                                <div class="col-lg-3"  >
                                    <div id="bgstyle<?php echo $i; ?>" class="panel panel-primary text-center no-boder "  style="padding:2px;" onClick="myStyle('<?php echo urldecode($fileInfo['url_path']); ?>',<?php echo $i; ?>, '<?php echo $name; ?>');">
                                        <div class="titleemdbg">
                                            <!--<a  id='golink<?php echo $i; ?>' class="clearfix tooltip1"  style='opacity:1;text-decoration:none;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >-->
            <?php if ($i == 1) { ?>
                                                <span  onclick="back()" >
                                                    <i class="fa <?php
                                                    if ($ext == 'docx' || $ext == 'doc') {
                                                        echo 'fa-file-word-o';
                                                    } else if ($ext == 'pdf') {
                                                        echo 'fa-file-pdf-o';
                                                    }
                                                    ?> fa-fw" style=""></i>                                                    
                                                </span>
                                                <!--<div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>--> 

                                            <?php } else { ?>
                                                <i class="fa <?php
                                                if ($ext == 'docx' || $ext == 'doc') {
                                                    echo 'fa-file-word-o';
                                                } else if ($ext == 'pdf') {
                                                    echo 'fa-file-pdf-o';
                                                }
                                                ?> fa-fw" style=""></i>
                <!--                                                <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>   -->
            <?php } ?>
                                            <!--                                            </a> -->
                                        </div>
                                        <?php if ($i == 1) { ?>
                                            <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>
                                        <?php } else { ?>
                                            <div class="textch">  <span>    <?php echo $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name; ?> </span>   </div>
            <?php } ?>
                                    </div> 
                                </div>


                            <?php }
                            ?>



                            <?php
                        endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#showRemove').hide();
        $('#showRename').hide();
        $('#previewF').hide();
        $('#DelSucc').hide();
        $('#movesucc').hide();
        $('#downSucc').hide();
        $("#loadStatus").hide();
        $("#loadStatus1").hide();
        $("#loadStatusMove").hide();
        $("#loadStatusDown").hide();
        $("#RenSucc").hide();
        $("#eroor").hide();
        $("#showMovef").hide();
        $("#showDownf").hide();
        function myStyle(data, val, rename) {


//            alert(val);
//            alert(rename);
            //doubleclick
//            jQuery(function ($) {
//                $('#golink' + val).click(function () {
//                    return false;
//                }).dblclick(function () {
//                    window.location = this.href;
//                    return false;
//                });
//            });
//
//            $('.btn').bind('click', function () {
//                var previouslySelectedButton = $('.course-btn-tab-selected');
//                var selectedButton = $(this);
//
//                if (previouslySelectedButton)
//                    previouslySelectedButton.removeClass('course-btn-tab-selected').addClass('course-btn-tab');
//
//                selectedButton.removeClass('course-btn-tab').addClass('course-btn-tab-selected');
//            });
            //doubleclick

            var path = rename;
            var totalpath = data;
            $("#bgstyle" + val).toggleClass('back-blue');
            $.ajax({
                url: 'docsDelete.php',
                data: ({data: data}),
                type: 'post',
                cache: false,
                dataType: 'html',
                success: function (data) {

                    if (data == 1) {
                        var renamepath = document.getElementById('renameFile').value = path;
                        var tpath = document.getElementById('tpathFileOne').value = totalpath;

                    } else if (data > 1) {
                        $('#showRename').hide();
                        $('#previewF').hide();
                        $("#showMovef").show();
                        $("#showDownf").show();

                    } else if (isNaN(data)) {
                        var last = data.substring(data.lastIndexOf("/") + 1, data.length);
                        $('#renameFile').hide();
                        $('#tpathFile').hide();
                        $("#showMovef").show();
                        $("#showDownf").show();
                        var renamepath = document.getElementById('renameFileOne').value = last;
                        var tpath = document.getElementById('tpathFileOne').value = data;
                        $("#RenSucc").hide();
                        $("#showMovef").show();
                        $("#showDownf").show();


                    } else {
                        $('#showRemove').hide();
                        $('#showRename').hide();
                        $('#previewF').hide();
                        $("#showMovef").hide();
                        $("#showDownf").hide();

                    }
                    if (!/(\.txt|\.pdf|\.exls|\.doc|\.docx|\.zip)$/i.test(rename))
                    {
                        $('#previewF').hide();
                    }
                }

            });
            $("#DelSucc").hide();
            $("#movesucc").hide();
            $("#downSucc").hide();
            $('#showConf').show();
            $('#showRemove').show();
            $('#showRename').show();
            $('#previewF').show();
            $("#loadStatus1").hide();
            $("#loadStatusMove").hide();
            $("#loadStatusDown").hide();
            $("#eroor").hide();

        }
        function second() {
            $("#loadStatus").fadeIn("slow");
            $('#showConf').hide();
            var dataf = 'DELETE';
            $.ajax({
                url: 'confirmDel.php',
                data: ({data: dataf}),
                type: 'post',
                cache: false,
                dataType: 'html',
                success: function (data) {
                    $("#loadStatus").fadeOut("slow");
                    $('#DelSucc').show();
                    setTimeout(function () {
                        window.location.href = "";
                    }, 900);
                }

            });
        }
        function renameFiles() {
            $("#loadStatus1").fadeIn("slow");
            var rfileone = document.getElementById('renameFileOne').value;
            var rfile = document.getElementById('renameFile').value;
            var tpathFileone = document.getElementById('tpathFileOne').value;
            var tpathFile = document.getElementById('tpathFile').value;
            if (rfileone) {
                $.ajax({
                    url: 'renamefile.php',
                    data: ({data: tpathFileone, rename: rfileone}),
                    type: 'post',
                    cache: false,
                    dataType: 'html',
                    success: function (data) {
                        $("#loadStatus1").fadeOut("slow");
                        $('#eroor').hide();
                        $('#RenSucc').show();
                        setTimeout(function () {
                            window.location.href = "";
                        }, 900);

                    }
                });
            } else {

                $('#eroor').show();
                $("#loadStatus1").fadeOut("slow");
            }

        }
        function moveFiles() {
            var folder = $('input:radio[name=folder]:checked').val();
            $("#loadStatusMove").fadeIn("slow");
            $('#hideMove').hide();
            if (folder == 'new')
            {
                var mainfolder = document.getElementById('mainfolder').value;
                if (mainfolder == '') {
                    var mainfolder = document.getElementById('pathspecify').value;
                    var subfolder = document.getElementById('subfolder1').value;
//                    alert("mmk" + pathspecify + subfolder);
                } else {
                    var mainfolder = document.getElementById('mainfolder').value;
                    var subfolder = document.getElementById('subfolder1').value;
//                    alert("krish" + mainfolder + subfolder);
                }

            } else if (folder == 'existing')
            {

                var topath = document.getElementById('subfolder').value;
                if (topath) {
                } else {
                    var mainfolder = document.getElementById('pathspecify').value;
                }


            } else {
                var mainfolder = "";
                var subfolder = "";
                var topath = "";
            }

            $.ajax({
                url: 'filemoveto.php',
                data: ({data: topath, mainfolder: mainfolder, subfolder: subfolder}),
                type: 'post',
                cache: false,
                dataType: 'html',
                success: function (data) {

                    $("#loadStatusMove").fadeOut("slow");
                    $('#movesucc').show();
                    setTimeout(function () {
                        window.location.href = "";
                    }, 900);
                }

            });
        }
        function previewreq() {
            $("#loadStatusDown").fadeIn("slow");
            var down = 0;
            $.ajax({
                url: 'filepreview.php',
                data: ({data: down}),
                type: 'post',
                cache: false,
                dataType: 'html',
                success: function (data) {
                    $("#loadStatusDown").fadeOut("slow");
                    $('#getPreview').html('<iframe src="https://docs.google.com/viewerng/viewer?url=https://www.employeemasterdatabase.com/newversion/' + data + '&embedded=true" width="100%" height="50%" scrolling="no" style="overflow:hidden; margin-top:-4px; margin-left:-4px; border:none;"></iframe>');

//                    setTimeout(function () {
//                        window.location.href = "";
//                    }, 900);
                }

            });
        }
    </script>
    <style>
        .back-blue { background-color: #428BCA; }
    </style>
    <script>

    </script>
<?php //file_exists('footer.php') ? include('footer.php') : include($lister->getThemePath(true) . "/default_footer.php");                       ?>

    <div id="file-info-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{modal_header}}</h4>
                </div>

                <div class="modal-body">

                    <table id="file-info" class="table table-bordered">
                        <tbody>

                            <tr>
                                <td class="table-title">MD5</td>
                                <td class="md5-hash">{{md5_sum}}</td>
                            </tr>

                            <tr>
                                <td class="table-title">SHA1</td>
                                <td class="sha1-hash">{{sha1_sum}}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

                                                                                                   