<?php
include_once "autoload.php";

if(isset($_GET['delete_id'])){
$delete_id = $_GET['delete_id'];
$photo_name = $_GET['photo'];

unlink('photos/' . $photo_name);
delete('shop', $delete_id);
header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Products</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<?php
	// Set to see
	if( isset($_POST['stc'])){
	// get value
    $p_name = $_POST['p_name'];
    $s_description = $_POST['s_description'];
    $price= $_POST['price'];
    $categories= $_POST['categories'];
    $p_code= $_POST['p_code'];

	
	// form validation	
	if(empty($p_name) || empty($s_description) || empty($price) || empty($categories)){
		$msg = validate('All fields are required');
	}
	elseif(dataCheck('shop' , 'p_code' , $p_code)){     
		$msg = validate('This Product all ready exists !' , 'warning');
		
	}else{
	
		$data =move($_FILES['photo'], 'photos/');

		// Get function
		$unique_name = $data['unique_name'];
		$err_msg = $data['err_msg'];

		if( empty($err_msg)){
				// Data insert
	create("INSERT INTO shop (Product_name, s_description, product_price, categories, p_code, photo ) VALUES ('$p_name' , '$s_description' , '$price' , '$categories' , '$p_code' , '$unique_name')");
				
				$msg = validate('Data stable' ,  'success');
		}else{

			$msg= $err_msg;
		}
	}
}

	
	?>

	<div class="wrap-table">
		<a class="btn btn-sm btn-primary" data-toggle="modal" href="#add_student_modal">Add Product</a>
		<a class="btn btn-sm btn-primary" href="http://localhost/Assignment%20e-commerce%20add/shop/index.php">Shop</a>
		<br>
		<?php
		if(isset($msg)){
			echo $msg;
		}
		?>
		<br>
		<div class="card shadow">
			<div class="card-body">
				<h2>All Products</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Categories</th>
							<th>Product code</th>
							<th>Photo</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$data = all('shop');
					$i= 1;

					while($student = $data->fetch_object()) :
					?>
						<tr>
							<td><?php  echo $i; 
							$i++?></td>
							<td><?php echo $student->Product_name ?></td>
							<td><?php echo $student->product_price ?></td>
							<td><?php echo $student->categories ?></td>
							<td><?php echo $student->p_code ?></td>
							<td><img src="photos/<?php echo $student->photo ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="show.php?show_id=<?php echo $student->id ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $student->id ?>">Edit</a>
								<a id="delete_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $student->id ?>
								&photo=<?php echo $student->photo ?>">Delete</a>
							</td>
						</tr>
					<?php	endwhile;?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- Student create modal -->
	<div id="add_student_modal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered">
			<div style="padding:0px 20px 0px 20px;" class="modal-content">
				<div class="modal-header"></div>
				<h3>  Add Product</h3>
				<div class="modal-body"></div>
				<form action="" method="POST" enctype="multipart/form-data">
				
					<div class="form-group">
						<label for="">Product Name</label>
						<input name="p_name" class="form-control" type="text">
					</div>

					<div class="form-group">
						<label for="">Short description</label>
						<input name="s_description" class="form-control" type="text">
					</div>

					<div class="form-group">
					<label for="">Product price</label>
					<input name="price" class="form-control" type="text">
				</div>

				<div class="form-group">
					<label for="">Product code</label>
					<input name="p_code" class="form-control" type="text">
				</div>

				<div class="form-group">
					<label for="">Category</label>
					<select class="form-control" name="categories" id="">
						<option value="">--SELECT--</option>
						<option value="Men">Men's</option>
						<option value="Women">Women's</option>
						<option value="Baby">Baby's</option>
						<option value="Old">Old's</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Product photo</label><br>
					<img id="load_student_photo" style="max-width:100%;" src="" alt="">
					<br>
					<label for="student_photo"><img width="100px" src="assets/media/img/upload.webp" alt=""></label>
					<input id="student_photo" name="photo" style="display:none;" class="form-control" type="file">
				</div>

				<div class="form-group">
					<label for=""></label>
					<input name="stc" class="btn btn-primary btn-sm" type="submit" value="Add Profile">
				</div>

				</form>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
	$('#student_photo').change(function(e){
		let file_url = URL.createObjectURL(e.target.files[0]);
		$('#load_student_photo').attr('src',file_url);
	});
	$('#delete_btn').click(function(){
	let confirmation =confirm('Are you sure?');

	if(confirmation ==true){
		return true;
	}else{
		return false;
	}
	});

	</script>
</body>
</html>