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

	$name = $_POST['name'];
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];

	$email = $_SESSION['email'];



	$stmt = $conn->prepare("UPDATE users SET name = :name, phone_no = :phone_no, address = :address WHERE email = :email");
	$stmt->execute([':name' => $name, ':phone_no' => $phone_no, ':address' => $address, ':email' => $email]);

	if($stmt->rowCount() == 1){
		 $msg = "<div class='mt20 alert alert-success'>Profile Updated :)</div>";
	}else{
		 $msg = "<div class='mt20 alert alert-danger'>Error :(</div>";
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
			<div class="col-md-4">
				<img src="<?php echo $data->user_img; ?>" alt="" class="user-image">
				<br>
				<a href="update-pic.php" class="btn btn-info">Update Picture</a>
			</div>
			<div class="col-md-6">
				<table class="table">
					<form action="" method="POST">
					<tr>
						<td>Name: </td>
						<td>
							<input type="text" name="name" value="<?php echo $data->name ?>">
						</td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td>
							<input type="email" name="email" value="<?php echo $data->email ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td>
							<input type="text" name="phone_no" value="<?php echo $data->phone_no ?>">
						</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>
							<input type="text" name="address" value="<?php echo $data->address ?>">
						</td>
					</tr>
				</table>
				
				<button name="update" type="submit" class="btn btn-info">Update</button>
			</form>
				<a href="welcome.php" class="btn btn-success">Home</a>
				<a href="logout.php" class="btn btn-danger">Logout</a>
			</div>

		</div>

	<?php echo $msg; ?>
				
	</div>

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>