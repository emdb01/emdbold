 <?php
			 $mid = $_SESSION['user_id'];
           // if (isset($_POST['movefolder'])) {
                                            ?>
                                            <!--- start of movefile to folder-->
                                            <form enctype="multipart/form-data" method="post" action="">
                                                <p>
                                                <p>
                                                    <input type="radio" name="folder" value="new">New Folder
                                                    <input type="radio" name="folder" CHECKED value="existing">Existing Folder
                                                </p>
                                                <select name="pathspecify" id="pathspecify" style="float:left">
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
                                                </select> <div id="div1" style="float:left"></div> 
                                                <div  style="float:left;">
                                                    <input style="display:none;" type="text" id="mainfolder" name="mainfolder" placeholder="Main Folder " >
                                                    <input style="display:none;" type="text" id="subfolder1" name="subfolder1" placeholder="Sub Folder " > 
                                                </div> 


                                                <p class="notify_text"><input type="submit" name="submit"  id="theresume"  value="Move" /></p>
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
                                            <?php
                                        // }
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
                        echo "<p class=\"notify_text\">The below entries were moved to <b>$pathshow</b></p>";
                        echo "<p class=\"notify_green\">";
                        foreach ($_POST['filestobemoved'] as $selected) {
                            //echo $selected;
                            echo "<br>";
                            $targetdir = $path;
                            @mkdir($targetdir, 0777);
                            @chmod($selected, 0777);

                            $mail_check = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id`='$selected' and recruiterId='$mid'");
                            $num = mysql_fetch_assoc($mail_check);
                            $mainpath1 = str_replace("./", "", $num['filepath']);
                            $finalfilnam = explode("/", $mainpath1);
                            echo $justfinalfile = end($finalfilnam);
                            echo "<br>";
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
                        }

                        echo "</p>";
                    }
//Change Folder
            ?>  