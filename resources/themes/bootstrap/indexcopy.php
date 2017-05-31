<!DOCTYPE html>

<html>

    <head>

        <title><?php //echo $lister->getListedPath();            ?></title>
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
        <!-- META -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">

        <?php file_exists('analytics.inc') ? include('analytics.inc') : false; ?>

    </head>



    <?php $breadcrumbs = $lister->listBreadcrumbs(); ?>

    <div id="page-content" class="container">

        <p class="navbar-text">
            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                <?php if ($breadcrumb != end($breadcrumbs)): ?>
                    <?php
//                  if(){
//                      
//                  }
                    //echo $breadcrumb['link']; 
                    ?>
                    <a href="<?php echo $breadcrumb['link']; ?>"><?php echo $breadcrumb['text']; ?></a>
                    <span class="divider">/</span>
                <?php else: ?>
                    <?php echo $breadcrumb['text']; ?>
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
                    <?php endforeach;
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
            <div id="Grid">
                <?php
                if ($_POST['filepath'] != '') {
                    foreach ($dirArray as $name => $fileInfo):
                        $i++;
                        $name = strstr($name, $_POST['filepath']);
                        ?>
        <?php if ($name != '') { ?>
                            <div class="col-lg-3">
                                <div class="panel panel-primary text-center no-boder" style="padding:10px;">

                                    <a href="<?php echo $fileInfo['url_path']; ?>"   class="clearfix tooltip1"  style='opacity:1;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >
            <?php if ($i == 1) { ?>
                                            <span  onclick="back()" >
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

                                        </a> 
                            <?php } ?>
                                </div></div> <?php } ?>
                        <?php
                    endforeach;
                } else {
                    $i = 0;

                    foreach ($dirArray as $name => $fileInfo):
                        $i++;
                        $ext = pathinfo($fileInfo['url_path'], PATHINFO_EXTENSION);
                        ?>

                        <div class="col-lg-3">
                            <?php if ($ext == '') { ?>
                                <div class="panel panel-primary text-center no-boder" style="padding:10px;">
                                    <a href="<?php echo $fileInfo['url_path']; ?>"   class="clearfix tooltip1"  style='opacity:1;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >
                                        <?php if ($i == 1) { ?>
                                            <span  onclick="back()" >
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
                            <?php } else { ?>
                                <div class="panel panel-primary text-center no-boder" style="padding:10px;">
                                    <a href="<?php echo $fileInfo['url_path']; ?>"   class="clearfix tooltip1"  style='opacity:1;' title="<?php echo $name; ?>" data-name="<?php echo $name; ?>" >
                                        <?php if ($i == 1) { ?>
                                            <span  onclick="back()" >
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
                            <?php }
                            ?>


                        </div>
                        <?php
                    endforeach;
                }
                ?>

            </div>
        </div>
    </div>

    <?php //file_exists('footer.php') ? include('footer.php') : include($lister->getThemePath(true) . "/default_footer.php");          ?>

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


