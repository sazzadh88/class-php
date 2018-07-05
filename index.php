<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .user-image{
    height: 250px;
    width: 250px;
}
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 offset-md-4">
            <h1 class="text-center login-title">Sign in</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" method="POST" action="">
                <input type="email" name="email"  class="form-control" placeholder="Email" required autofocus autocomplete="off">
                <input type="password"  name="password" class="form-control" placeholder="Password" required>
                <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign In</button>
                
                </form>
            </div>
            <a href="register.php" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>
<?php

require "config/db.php";

if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->execute([':email' => $email, ':password' => $password]);
    if($stmt->rowCount() == 1){
        $_SESSION['email'] = $email;
       
        // header("Location: welcome.php");
        // exit;
        echo "<script>window.location='welcome.php'</script>";
        

    }else{
        echo "<div class='mt20 alert alert-danger'>Login Invalid</div>";
    }
}
?>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js.js"></script>
</body>
</html>