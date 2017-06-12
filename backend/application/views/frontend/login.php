<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
    <!-- main.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/css/main.css");?>">

</head>
<body style="background-color: #3498db;">
<div id="login-form">
    <form action="<?php echo base_url("index.php/login/api_login"); ?>" method="POST">
        <h3>Login-ke-Dashboard</h3>
        <div class="form-group">
            <label>Username</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                <input type="text" name="username" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                <input type="password" name="password" class="form-control"/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
</html>