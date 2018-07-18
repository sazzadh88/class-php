<?php 
require '../config/db.php';

if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
	$stmt->execute([':id' => $id]);

	if($stmt->rowCount() == 1){
		header("Location:dashboard.php");
		exit;
	}else{
		echo "Error";
	}
}

 ?>