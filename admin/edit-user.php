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
    <style>
        .alert{
            margin-top: 20px;
        }
       
    </style>
</head>

<body>
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item active"><a href="dashboard.php"> All Users</a></li>
                  <li class="list-group-item "> <a href="add-user-info.php"> Add User Information</a></li>
                  <li class="list-group-item "> <a href="add-user-balance.php">Add User Wallet Balance</a></li>
                  <li class="list-group-item "> <a href="logout.php">Logout</a></li>
                  
                </ul>
                </ul>
            </div>
            <div class="col-md-8">
                <?php


                if(isset($_POST['update'])){
                    $name = $_POST['user_name'];
                    $email = $_POST['user_email'];
                    $phone_no = $_POST['user_phone'];
                    $address = $_POST['user_address'];
                    $user_id = $_POST['user_id'];

                    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, phone_no = :phone_no, address = :address WHERE id = :id");
                    $stmt->execute([':name' => $name, ':email' => $email, 'phone_no' => $phone_no, ':address' => $address, ':id' => $user_id]);
                    if($stmt->rowCount() == 1){
                        $msg = "<div class='alert alert-success'>Updated!</div>";
                    }else{
                        $msg = "<div class='alert alert-danger'>Failed!</div>";
                    }
                }



                if(isset($_GET['id'])){
                $user_id =  intval($_GET['id']);

                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->execute([':id' => $user_id]);
                $data = $stmt->fetchObject();


                if(empty($data)){
                    $display = "style='display:none'";
                    echo "<div class='alert alert-danger'>Nothing found!</div>";
                }

                }else{
                    
                    echo "<div class='alert alert-danger'>Nothing found!</div>";

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

                        <input type="hidden" name="user_id" value="<?=$user_id?>">


                    </div>
                    
                    <button type="submit" name="update" class="btn btn-primary">Submit</button>
                    
                    <a href="dashboard.php" class="btn btn-default">Go Back</a>
                
                </form>
            <?php 

            if(isset($msg)){
                echo $msg;
            }

             ?>

               
            </div>

           
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>