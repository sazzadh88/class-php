<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 offset-md-3 col-sm-8 offset-sm-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                </div>

                <div style="padding-top:30px" class="panel-body">

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="NT Account">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="NT Password">
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <a id="btn-login" href="#" class="btn btn-success">Login  </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>