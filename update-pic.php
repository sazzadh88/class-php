<?php
session_start();

//Session Check
if(!isset($_SESSION['email'])){
header("Location:index.php");
exit;
}


//Add DB Configuration
require 'config/db.php';


//Update Query

if(isset($_POST['update'])){

	print_r($_FILES);

	$tmp_name = $_FILES['img']['tmp_name'];
	$file_name = md5(time()).$_FILES['img']['name'];

	if(move_uploaded_file($tmp_name, "img/".$file_name)){
		$stmt = $conn->prepare("UPDATE users SET user_img = :user_img WHERE email = :email");
		$stmt->execute([':email' => $_SESSION['email'], ':user_img' => "img/".$file_name]);
		
		if($stmt->rowCount() == 1){
		 	$msg = "<div class='mt20 alert alert-success'>Profile Pic Uploaded :)</div>";
		}else{
			 $msg = "<div class='mt20 alert alert-danger'>Error :(</div>";
		}
	}

	

}	


//Query to fetch Data
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([':email' => $_SESSION['email']]);
$data = $stmt->fetchObject();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    	.top{
    		margin-top: 50px;
    	}
    	.user-image{
    height: 250px;
    width: 250px;
}
    </style>
</head>
<body>
	
	<div class="container top">
		<div class="row text-center">
			<div class="col-md-4 offset-md-4">
				<img src="<?php echo $data->user_img; ?>" alt="" class="user-image">
				<br>
				<br>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="file" name="img" required class="form-control">
					<br>
					<button type="submit" name="update" class="btn btn-success">Upload</button>
					<a href="edit.php" class="btn btn-info">Edit</a>
				</form>
			</div>
			
		</div>

	<?php echo $msg; ?>
				
	</div>

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>