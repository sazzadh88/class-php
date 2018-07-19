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
        .active > a{
            color:#FFF;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item "><a href="dashboard.php"> All Users</a></li>
                  <li class="list-group-item "> <a href="add-user-info.php"> Add User Information</a></li>
                  <li class="list-group-item active"> <a href="add-user-balance.php">Add User Wallet Balance</a></li>
                  <li class="list-group-item "> <a href="logout.php">Logout</a></li>
                  
                </ul>
            </div>
            <div class="col-md-8">
               <form action="" method="POST">
                 <div class="form-group">
                        <select name="user_id" class="form-control">
                            <?php

                                $stmt = $conn->prepare("SELECT * FROM users");
                                $stmt->execute();
                                while($data = $stmt->fetchObject()){
                                    echo "<option value='$data->id'>$data->name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_balance" placeholder="Enter Amount">
                    </div>
                    
                    <button type="submit" name="add" class="btn btn-primary">Add Balance</button>
                    
                    <a href="dashboard.php" class="btn btn-default">Go Back</a>
               </form>
               <?php

                    if(isset($_POST['add'])){
                        $balance = $_POST['user_balance'];
                        $user_id = $_POST['user_id'];
                        
                        $stmt = $conn->prepare("SELECT * FROM wallet WHERE user_id = :user_id");
                        $stmt->execute(['user_id' => $user_id]);
                        
                        $userData = $stmt->fetchObject();

                        // print_r($userData);

                        // print_r($_POST);
                        // exit;
                        if(empty($userData)){
                            $stmt2 = $conn->prepare("INSERT INTO wallet VALUES(:id, :user_id,:balance)");
                            $stmt2->execute([':id' => NULL,':user_id' => $user_id, ':balance' => $balance]);
                            if($stmt2->rowCount() == 1){
                                echo "<div class='alert alert-success'>Balance Added!</div>";
                            }else{
                                echo "<div class='alert alert-danger'>Error in adding balance!</div>";
                            }
                        }else{
                            $current_balance = intval($userData->balance);
                            $updated_balance = $balance + $current_balance;

                            $stmt3 = $conn->prepare("UPDATE wallet set balance = :updated_balance WHERE user_id = :user_id");
                            $stmt3->execute([':updated_balance' => $updated_balance, ':user_id' => $user_id]);
                            if($stmt3->rowCount() == 1){
                                echo "<div class='alert alert-success'>Balance Updated!</div>";
                            }else{
                                echo "<div class='alert alert-danger'>Error in updating balance!</div>";
                            }

                        }

                    }
                ?>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    

</body>

</html>