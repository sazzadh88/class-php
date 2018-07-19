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
                  <li class="list-group-item active"><a href="dashboard.php"> All Users</a></li>
                  <li class="list-group-item "> <a href="add-user-info.php"> Add User Information</a></li>
                  <li class="list-group-item "> <a href="add-user-balance.php">Add User Wallet Balance</a></li>
                  <li class="list-group-item "> <a href="logout.php">Logout</a></li>
                  
                </ul>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                    <?php 

                    $stmt = $conn->prepare("SELECT * FROM users LEFT JOIN wallet ON users.id = wallet.user_id");
                    $stmt->execute();

                    while($data = $stmt->fetchObject()){
                        ?>
    <tr>
        <td><?=$data->id?></td>
        <td><?=$data->name?></td>
        <td><?=$data->email?></td>
        <td><?=$data->phone_no?></td>
        <td><?=$data->balance?></td>

        <td>
            <a class="btn btn-info" href="edit-user.php?id=<?=$data->id?>">Edit</a>
            <button class="btn btn-danger" onclick="test(<?=$data->id?>)">Delete</button>
        </td>
        
    </tr>

                        <?php
                    }

                     ?>
                </table>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        function test(id){
            var ans = confirm("Are you sure to delete this user?");
            if(ans){
                window.location = 'delete-user.php?id=' +id;
            }else{

            }
        }
    </script>

</body>

</html>