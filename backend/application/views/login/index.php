<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link rel="icon" href="<?php echo base_url("assets/img/logo.png"); ?>" type="image/png">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css");?>"/>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/master.css");?>"/>
    </head>
    <body>
        <div class="col-md-12"><hr />
            <h1>&raquo;&nbsp;Login ke Dashboard</h1><br />
            <div class="col-md-6">
                <form action="<?php echo base_url("index.php/login/api_login"); ?>" method="POST" id="loginForm">
                    <p><b>&rarr;&nbsp;Username</b></p>
                    <input type="text" name="username" required/><hr />
                    <p><b>&rarr;&nbsp;Password</b></p>
                    <input type="password" name="password" required/><hr />
                    <button type="submit" class="btn">Masuk</button>
                </form>
            </div>
        </div>
    </body>
</html>