<?php
include_once "autoload.php";

/**
 * show single student
 */

 if(isset($_GET['show_id'])){
	$id =$_GET['show_id'];

	$student = find('shop' , $id); 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $student->name?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<div class="container">
 		<div class="row">
			<div class="col-lg-7 mx-auto mt-5">
				<div class="card">
					<img class="rounded-circle img-thumbnail shadow mx-auto mt-3" width="300" 
					src="photos/<?php echo $student->photo?>" alt="">
					<h2 class="text-center"><?php echo $student->name?></h2>
					<p class="text-center"><?php echo $student->username?> </p>
					<div class="card-body">
						<table class= "table">
							<tr>
								<td>Name</td>
								<td><?php echo $student->name?></td>
							</tr>
							<tr>
								<td>Email</td> 
								<td><?php echo $student->email?></td>
							</tr>	
							<tr>
								<td>Cell</td>
								<td><?php echo $student->cell?></td>
							</tr>	
							<tr>
								<td>Age</td>
								<td><?php echo $student->age?></td>
								</tr>	
							<tr>
								<td>Username</td>
								<td><?php echo $student->username?></td>
							</tr>
							<tr>
								<td>Location</td>
								<td><?php echo $student->location?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?php echo $student->gender?></td>
							</tr>
							<tr>
								<td>Dept</td>
								<td><?php echo $student->dept?></td>
							</tr>

						</table>
						<a class="mx-auto btn btn-sm btn-primary" href="index.php">Back</a>

					</div>
				</div>
			</div>
		 </div>
	</div>
	

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>


	</script>
</body>
</html>