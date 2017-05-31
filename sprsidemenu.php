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
    <ul class="nav navbar-top-links navbar-right">



        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-2x"></i>
            </a>
            <!-- dropdown user-->
            <ul class="dropdown-menu dropdown-user">
                <li><a href="myprofile.php"><i class="fa fa-user fa-fw"></i>User Profile</a>
                </li>

                <li class="divider"></li>
                <li><a href="tickets.php"><i class="fa fa-life-ring  fa-fw" ></i>Support</a>
                        </li>
                            <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                </li>
            </ul>
            <!-- end dropdown-user -->
        </li>
        <!-- end main dropdown -->
    </ul>
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
                        <div style="font-family: Times New Roman, Georgia, Serif;"> <strong><i><?php echo $_SESSION['first']; ?></i></strong></div>
                        <div class="user-text-online">

                        </div>
                    </div>
                </div>

            </li>
            <li class="selected">
                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li>
                <a href="adminpanel.php"><i class="fa fa-group fa-fw"></i>Job Seekers</a>

                <!-- second-level-items -->
            </li>
            <li>
                <a href="recruiterlist.php"><i class="fa fa-search fa-fw"></i>Recruiters</a>
            </li>
            <li>
                <a href="userlist.php"><i class="fa fa-user fa-fw"></i>Users</a>
            </li>
           
<!--             <li>
                <a href="idolizeprofiles.php"><i class="fa fa-cogs fa-fw"></i>Idolize Job Seekers</a>
            </li>-->
           
          
            <li>
                <a href="report.php"><i class="fa fa-list fa-fw"></i>Report</a>
            </li>
        
           
            <li>
                <a href="notverifyjs.php"><i class="fa fa-exclamation-circle fa-fw"></i>Not Verified Job Seekers</a>
            </li>
<!--            <li>
                <a href="invites.php"><i class="fa fa-envelope fa-fw"></i>Invites</a>
            </li>-->
              <?php if($_SESSION['user_id']==1){?>
            <li>
                <a href="searchlist.php"><i class="fa fa-search fa-fw"></i>Search List</a>
            </li>
            <?php } ?>

        </ul>
        <!-- end side-menu -->
    </div>
    <!-- end sidebar-collapse -->
</nav>