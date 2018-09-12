<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();

		var checkbox = $('table tbody input[type="checkbox"]');
		$("#selectAll").click(function(){
			if(this.checked){
				checkbox.each(function(){
					this.checked = true;
				});
			}else{
				checkbox.each(function(){
					this.checked = false;
				});
			}
		});
		checkbox.click(function(){
			if(!this.checked){
				$("#selectAll").prop("checked",false);
			}
		})
	});
</script>
<body>
	<div class="jumbotron text-center">
  		<h1>Welcome to Address Book Directory</h1>
  		<p>Resize this responsive page to see the effect!</p> 
	</div>
	<div class="container">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage Address Book</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addAddressModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>No.</th>
                        <th>Fullname</th>
						<th>Contact Number</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<?php
						$fetch_data= "SELECT * FROM tbl_add_info";
						$result = $conn->query($fetch_data);
						if($result->num_rows > 0){
							while($row=$result->fetch_assoc()){
								$fullname = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
							?>
					
						<td><?php echo $row['rec_id'];?></td>
						<td><?php echo $fullname;?></td>
						<td><?php echo $row['contact_no'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['bday'];?></td>
						<td> 
							<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id = "<?php echo $row['rec_id'];?>">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                       <?php }
							
                        	}else { ?>
                        <td colspan="6"><?php echo "No data";?></td>
                       <?php }
					?>
					</tr>
					
				</tbody>
		</div>
	</div>
	<div id="addAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Record</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" required name="lname">
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" required name="fname">
						</div>
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" class="form-control" required name="mname">
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" required name="address">
						</div>
						<div class="form-group">
							<label>Contact Number</label>
							<input type="text" class="form-control" required name="cnumber">
						</div>
						<div class="form-group">
							<label>Birthday</label>
							<input type="date" name="bday" required class="form-control">
							
						</div>
						<div class="form-group">
							<label>Age</label>
							<input type="text" class="form-control" required name="age" readonly="true">
						</div>
						<div class="form-group">
							<label>Birthplace</label>
							<input type="text" class="form-control" required name="bplace">
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="addAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Record</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" name="deleteBtn">

						<?php
							if(isset($_POST['deleteBtn'])){

							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>