<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
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
		});
		$('#bday').datepicker({
		    onSelect: function(value, ui) {
		        var today = new Date(), 
		            age = today.getFullYear() - ui.selectedYear;
		        $('#age').text(age);
		    },
		    maxDate: '+0d',
		    changeMonth: true,
		    changeYear: true,
		    defaultDate: '-18yr',
		});
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
							<!-- delete button add -->
                            <a class="delete_product" data-id="<?php echo $row['rec_id']; ?>" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i>
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
	<!-- add to the project -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootbox.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		
		$('.delete_product').click(function(e){
			
			e.preventDefault();
			
			var pid = $(this).attr('data-id');
			var parent = $(this).parent("td").parent("tr");
			
			bootbox.dialog({
			  message: "Are you sure you want to Delete ?",
			  title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
			  buttons: {
				success: {
				  label: "No",
				  className: "btn-success",
				  callback: function() {
					 $('.bootbox').modal('hide');
				  }
				},
				danger: {
				  label: "Delete!",
				  className: "btn-danger",
				  callback: function() {
					  $.post('delete.php', { 'delete':pid })
					  .done(function(response){
						  bootbox.alert(response);
						  parent.fadeOut('slow');
					  })
					  .fail(function(){
						  bootbox.alert('Something Went Wrog ....');
					  })
					  					  
				  }
				}
			  }
			});
		});
	});
	</script>

</body>
</html>