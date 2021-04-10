<?php
include_once "autoload.php";

	// Set to see
	if( isset($_POST['stc'])){
		// get value
		$name= $_POST['name'];
		$email= $_POST['email'];
		$cell= $_POST['cell'];
		$username= $_POST['username'];
		$age= $_POST['age'];
		$location= $_POST['location'];
		$gender=' ';
		if(isset($_POST['gender'])){
			$gender =$_POST['gender'];
		}
		$dept= $_POST['dept'];
		$id = $_GET['edit_id'];
	
	// form validation	
		if(empty($name) || empty($email) || empty($cell) || empty($username) || empty($age) || empty($location) || empty($gender) || empty($dept)){
			$msg = validate('All fields are required');
		}
		else if(filter_var($email, FILTER_VALIDATE_EMAIL)== false){
			$msg = validate('Invalid email');
			
		}
		else{
			if( !empty($_FILES['new_photo']['name'])){

				$data = move($_FILES['new_photo'], 'photos/');
				$photo_name = $data['unique_name'];
				unlink('photos/' . $_POST['old_photo']);
			}else{
				$photo_name = $_POST['old_photo'];
			}
			
			update("UPDATE shop SET name='$name', email='$email', 
			cell='$cell', username='$username', location='$location', 
			age= '$age', gender='$gender', dept='$dept' , photo='$photo_name' 
			WHERE id='$id' ");
			$msg= validate('Data updated successfully!','success');
	
		}
	}

// Find edit student data

if(isset($_GET['edit_id'])){
	$id=$_GET['edit_id'];

	$edit_data=find('shop' , $id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

			<div class="container">
				<div class="row">
					<div class="col-lg-6 mx-auto mt-5 ">
						<a class="btn btn-primary btn-sm" href="index.php">Back</a>
						<br>
						<br>
						<div class="card">
							<div class="card-body">
								<h2>STUDENT DATA EDIT</h2>
								<hr>
								<?php
								if(isset($msg)){
									echo $msg;
								}
								?>
								<form action="" method="POST" enctype="multipart/form-data">
				
					<div class="form-group">
						<label for="">Student name</label>
						<input name="name" class="form-control" value="<?php echo $edit_data->name; ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" value="<?php echo $edit_data->email; ?>" type="text">
					</div>

					<div class="form-group">
					<label for="">Cell</label>
					<input name="cell" class="form-control" value="<?php echo $edit_data->cell; ?>" type="text">
				</div>

				<div class="form-group">
					<label for="">username</label>
					<input name="username" class="form-control" value="<?php echo $edit_data->username; ?>" type="text">
				</div>

				<div class="form-group">
					<label for="">Age</label>
					<input name="age" class="form-control" value="<?php echo $edit_data->age; ?>" type="text">
				</div>

				<div class="form-group">
					<label for="">Location</label>
					<select class="form-control" name="location" id="">
						<option value="">--SELECT--</option>
						<option <?php echo ($edit_data->location =='CTG') ? 'selected' : ' ';?>  value="CTG">CTG</option>
						<option <?php echo ($edit_data->location =='DHK') ? 'selected' : ' ';?> value="DHK">DHK</option>
						<option <?php echo ($edit_data->location =='RAJ') ? 'selected' : ' ';?> value="RAJ">RAJ</option>
						<option <?php echo ($edit_data->location =='SAY') ? 'selected' : ' ';?> value="SAY">SAY</option>
						<option <?php echo ($edit_data->location =='BAR') ? 'selected' : ' ';?> value="BAR">BAR</option>
						<option <?php echo ($edit_data->location =='KHU') ? 'selected' : ' ';?> value="KHU">KHU</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Gender</label><br>
<input name="gender" type="radio" <?php echo ($edit_data->gender =='male') ? 'checked' : ' '; ?>
			value ="male" id="male"><label for="male">Male</label>

<input name="gender" type="radio" <?php echo ($edit_data->gender== 'female' )? 'checked' : ' ';?>
			value ="female" id="female"><label for="femal">Female</label>
				</div>
				
				<div class="form-group">
					<label for="">Department</label>
					<select class="form-control"  name="dept" id="">
						<option value="">--SELECT--</option>
						<option <?php echo ($edit_data->dept == 'Math' ) ? 'selected' : ' ';?> value="Math">MATH</option>
						<option <?php echo ($edit_data->dept =='CSC') ? 'selected' : ' ';?> value="CSC">CSC</option>
						<option  <?php echo ($edit_data->dept =='EEE') ? 'selected' : ' ';?> value="EEE">EEE</option>
						<option  <?php echo ($edit_data->dept =='English') ? 'selected' : ' ';?> value="English">ENG</option>
						<option  <?php echo ($edit_data->dept =='Bangla') ? 'selected' : ' ';?> value="Bangla">BANGLA</option>
						<option  <?php echo ($edit_data->dept =='LAW') ? 'selected' : ' ';?> value="LAW">LAW</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Profile photo</label><br>
					<img id="load_student_photo_edit" style="max-width:100%;" src="" alt="">
					<br>
					<label for="student_photo_edit"><img width="200px" src="photos/<?php echo $edit_data->photo; ?>" alt=""></label>
					<input id="student_photo_edit" name="new_photo" style="display:none;" class="form-control" type="file">
					<input type="hidden" value="<?php echo $edit_data->photo;?>" name="old_photo">
				</div>

				<div class="form-group">
					<label for=""></label>
					<input name="stc" class="btn btn-primary btn-sm" type="submit" value="Update Profile">
				</div>

				</form>
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
			$('#student_photo_edit').change(function(e){
		let file_url = URL.createObjectURL(e.target.files[0]);
		$('#load_student_photo_edit').attr('src',file_url);
	});

	</script>
</body>
</html>