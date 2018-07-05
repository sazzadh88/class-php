<?php
session_start();

//Session Check
if(!isset($_SESSION['email'])){
header("Location:index.php");
exit;
}

//Add DB Configuration
require 'config/db.php';

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
    </style>
</head>
<body>
	
	<div class="container top">
		<div class="row text-center">
			<div class="col-md-4">
				<img src="img/user.png" alt="" class="user-image">
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

		<?php

		if(isset($_POST['update'])){
			
		}

	
		?>









































		
	</div>

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js.js"></script>
</body>
</html>