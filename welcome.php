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
</head>
<body>
	
	<div class="container">
		<div class="row text-center">
			<div class="col-md-6 offset-md-3">
				<table class="table">
					<tr>
						<td>Name: </td>
						<td><?php echo $data->name ?></td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td><?php echo $data->email ?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><?php echo $data->phone_no ?></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><?php echo $data->address ?></td>
					</tr>
				</table>
				<a href="edit.php" class="btn btn-info">Edit</a>
				<a href="logout.php" class="btn btn-danger">Logout</a>
			</div>

		</div>
		
	</div>

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js.js"></script>
</body>
</html>