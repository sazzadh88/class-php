<?php 
session_start();
require '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item active">All Users</li>
                  <li class="list-group-item ">Add User Information</li>
                  <li class="list-group-item ">Add User Wallet Balance</li>
                  <li class="list-group-item ">Logout</li>
                  
                </ul>
            </div>
            <div class="col-md-8">
                <?php

                if(isset($_GET['id'])){
                $user_id =  intval($_GET['id']);

                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->execute([':id' => $user_id]);
                $data = $stmt->fetchObject();


                if(empty($data)){
                    $display = "style='display:none'";
                    echo "<span class='alert alert-danger'>Nothing found!</span>";
                }

                }else{
                    
                    echo "<span class='alert alert-danger'>Nothing found!</span>";

                }

                ?>
                <form method="POST" action="" <?=$display?>>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_name" value="<?=$data->name?>" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_email" value="<?=$data->email?>" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_phone" value="<?=$data->phone_no?>" placeholder="Enter Phone number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_address" value="<?=$data->address?>" placeholder="Enter Address">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="dashboard.php" class="btn btn-default">Go Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>