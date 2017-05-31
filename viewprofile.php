<?php 
include('header.php');
?>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
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
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger">3</span><i class="fa fa-envelope fa-2x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-danger">Andrew Smith</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-info">Jonney Depp</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-success">Jonney Depp</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-messages -->
                </li>

                

               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-2x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
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
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div>Jonny <strong>Deen</strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!--end search section-->
                    </li>
                    <li class="selected">
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="list_resumes.php"><i class="fa fa-bar-chart-o fa-fw"></i> My List</a>
                         
                        <!-- second-level-items -->
                    </li>
                     <li>
                        <a href="resumes.php"><i class="fa fa-upload fa-fw"></i>Upload Resumes</a>
                    </li>
                    <li>
                        <a href="requirements.php"><i class="fa fa-table fa-fw"></i>Requirements</a>
                    </li>
					<li>
                        <a href="documentation.php"><i class="fa fa-folder-open-o fa-fw"></i>Documentation</a>
                        
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="followers.php"><i class="fa fa-thumbs-o-up fa-fw"></i>Following list</a>
                    </li>
                    <li>
                        <a href="http://emdbmail.com/customer/dashboard.php/dashboard/index"><i class="fa fa-envelope-o fa-fw"></i>Bulk Email</a>
                         
                        <!-- second-level-items -->
                    </li>
                    <li>
                        <a href="excelinvite.php"><i class="fa fa-edit fa-fw"></i>Send Invites</a>
                        
                        <!-- second-level-items -->
                    </li>
                     
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">View Profile</h1>
                </div>
                <!--End Page Header -->
            </div>

              
            

            <div class="row">
			<div class="col-lg-12">
			<div class="changep">
			<button type="button" class="btn btn-info"><a href="postrequirement.html"><i class="fa fa-pencil"></i> Post requirement</a></button>
                                <button type="button" class="btn btn-danger"><a href="requirement.html"><i class="fa fa-file-text"></i> Requirement List</a></button>
								</div>
								</div>
                <div class="col-lg-12">

<div class="panel panel-default">
                        <div class="panel-heading" style="float:right">
                            <a href="" style="color:#fff"><i class="fa fa-eye"></i> View Resume</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
									<tr>
                                            <td>EMDB ID</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Middle Name</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Last Name</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Email Id</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Phone</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Availability</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Job</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Technology</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Salary</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Skills</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
										<tr>
                                            <td>Experience</td>
                                            <td>Jacob</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--Area chart example -->
                    
                    <!--End area chart example -->
                    <!--Simple table example -->
                     
                </div>
<div class="col-lg-4">
                    <!-- Donut Example-->
                     
                    <!--End Donut Example-->
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
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>

</html>
