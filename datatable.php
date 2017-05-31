<!DOCTYPE html>
<html>
	<title>EMDB</title>
	<head>
	 <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	   <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		
		<!------this script for select all checkboxes----->
    <script type="text/javascript">
        function do_this() {
            var checkboxes = document.getElementsByName('check_list[]');
            var checkbox = document.getElementById('selecctall');

            if (checkbox.value == 'select') {
				console.log("mmk");
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
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var page=2;
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						data:({page:page}),
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
			} );
		</script>
		
	</head>
	<body>
  <form action="excel.php"  name="checkval" id="checkval"   method="post"  >
   <button type="submit" class="btn btn-info" name="exportall" ><i class="fa fa-download"></i>  Export All </button>
   <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
			<table id="employee-grid"  class="table table-striped table-bordered table-hover" id="dataTables-example"  >
					<thead>
						<tr>
							<th>Employee name</th>
							<th>Salary</th>
							<th>Age</th>
							<th>Action</th>
							<th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
						</tr>
					</thead>
			</table>
		
		 </div>

                            </div>
                        </div>
		 </form>
	</body>
</html>
