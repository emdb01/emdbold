<?php if ($_SESSION['role'] == 3) { ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
        <!-- navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/img/logo.png" alt="" />
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- navbar-top-links -->
        <!--        <ul class="nav navbar-top-links navbar-right">
        
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-2x"></i>
                        </a>
                       
                                            <ul class="dropdown-menu dropdown-user">
                                                <li><a href="profile-recruiter.php"><i class="fa fa-user fa-fw"></i>User Profile</a>
                                                </li>
                                                
                                                <li class="divider"></li>
                                                <li><a href="tickets.php"><i class="fa fa-life-ring  fa-fw" ></i>Support</a>
                                                </li>
                                                    <li class="divider"></li>
                                                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                                                </li>
                                            </ul>
                      
                    </li>
                    
                </ul>-->
        <!-- end navbar-top-links -->

    </nav>
    <!-- end navbar top -->

    <!-- navbar side -->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <!-- sidebar-collapse -->
        <div class="sidebar-collapse">
            <!-- side-menu -->
            <ul class="nav" id="side-menu">
                <li>

                    <div class="user-section">

                        <div class="user-info">
                            <div style="font-family: Times New Roman, Georgia, Serif;"> <strong><i><?php echo $_SESSION['company']; ?></i></strong></div>
                            <div class="user-text-online">

                            </div>
                        </div>
                    </div>

                </li>
                <!--                    <li class="sidebar-search">
                                     
                                        <div class="input-group custom-search-form">
                                            <div style="font-family: Times New Roman, Georgia, Serif;color:#fff;"> <strong><i><?php echo $_SESSION['first']; ?></i></strong></div>
                                        </div>
                                   
                                    </li>-->
                <li class="selected">
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                </li>
                <li>
                    <a href="list_resumes.php"><i class="fa fa-group fa-fw"></i>My List</a>

                    <!-- second-level-items -->
                </li>
                <!-- <li>
                     <a href="resumes.php"><i class="fa fa-upload fa-fw"></i>Upload Resumes</a>
                 </li>-->

                <li>
                    <a href="documentation.php?dir=<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-files-o fa-fw"></i>Resume Database</a>

                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="requirements.php"><i class="fa fa-table fa-fw"></i>Requirements</a>
                </li>
                <li>
                    <a href="followers.php"><i class="fa fa-thumbs-o-up fa-fw"></i>Following</a>
                </li>
                <?php
                //       echo $_COOKIE["TestCookie"];
                $mailId = $_SESSION['email'];
                $name = $_SESSION['first'] . ' ' . $_SESSION['last'];
                $SecretKey = 'gh45jkd823njEI89vgdfrU89bfcbjzW';
                $sig = hash('sha256', $mailId . $SecretKey);
                ?> 
                <li>
                    <a href="http://emdbmail.com/customer/index.php/?user_email=<?php echo $mailId; ?>&name=<?php echo $name; ?>&sign=<?php echo $sig; ?>" target="_blank"><i class="fa fa-envelope-o fa-fw"></i>Mass Mailing</a>

                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="new_follow.php"><i class="fa fa-paper-plane fa-fw"></i>Invitations</a>

                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="vmails.php"><i class="fa fa-microphone fa-fw"></i>EMDB Voice Mailer</a>

                    <!-- second-level-items -->
                </li>
                <li>
                    <a href="rmessages.php"><i class="fa fa-envelope fa-fw"></i>EMDB  Mailer</a>

                    <!-- second-level-items -->
                </li>
               
                <li><a href="tickets.php"><i class="fa fa-life-ring  fa-fw" ></i>Help Desk</a>
                </li>
                 <li>
                    <a href="howtouse.php"><i class="fa fa-question-circle  fa-fw"></i>How To Use</a>
                </li>
                <li><a href="profile-recruiter.php"><i class="fa fa-user fa-fw"></i>My Account</a>
                </li>



                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                </li>

            </ul>
            <!-- end side-menu -->
        </div>
        <!-- end sidebar-collapse -->
    </nav>
    <?php
} else if ($_SESSION['role'] == 2) {
    include("jsidemenu.php");
    ?>

    <?php
} else if ($_SESSION['role'] == 4) {
    include("sprsidemenu.php");
    ?>
    <?php
} else if ($_SESSION['role'] == 1) {
    include("sprsidemenu.php");
    ?>

<?php } ?>