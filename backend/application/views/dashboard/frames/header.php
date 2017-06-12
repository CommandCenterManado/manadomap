<!DOCTYPE HTML>
<html>
<head>
    <title>Dashboard</title>
    <link rel="icon" href="<?php echo base_url("assets/img/logo.png"); ?>" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<!--    <link rel="stylesheet" href="--><?php //echo base_url("assets/css/bootstrap.min.css"); ?><!--"/>-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/master.css"); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-datepicker.min.css"); ?>"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/fontawesome-iconpicker.min.css"); ?>"/>

    <script src="<?php echo base_url("assets/js/jquery-3.0.0.min.js"); ?>"></script>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyBwTMhjPlZtwMX3mbZz1AjJrDJq-Uh-Wvw'></script>
    <script src="<?php echo base_url("assets/js/locationpicker.jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/fungsi.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/gmaps.js"); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>"></script>
    <?php $id = $this->session->userdata("idpengguna");if(isset($id)): ?>
    <script src="http://localhost:7001/socket.io/socket.io.js"></script>
    <script src="<?php echo base_url("assets/js/clientsocket.js"); ?>"></script>
    <?php endif; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="<?php echo base_url("assets/js/fontawesome-iconpicker.min.js"); ?>"></script>
</head>
<body>

<div id="notif"><i class="fa fa-exclamation-circle fa-lg"></i>&nbsp;Anda punya <b id="counter">0</b> laporan baru!</div>

<header>
    <h1>PEMERINTAH&nbsp;<img src="<?php echo base_url("assets/img/logo.png");?>"/>&nbsp;KOTA MANADO</h1>
</header><hr />
<div class="container">
<nav>
    <?php $id = $this->session->userdata("idpengguna");if(isset($id)): ?>
        <b>Login Sebagai : <?php echo $this->session->userdata("nama_lengkap"); ?></b><br /><br />
        <a href="<?php echo base_url("index.php/dashboard/index"); ?>" class="btn green"><i class="fa fa-dashboard fa-lg"></i>&nbsp;Dashboard Card</a>
        <a href="<?php echo base_url("index.php/dashboard/map"); ?>" class="btn midnight-blue"><i class="fa fa-map fa-lg"></i>&nbsp;Dashboard Map</a>

        <?php if($this->session->userdata("bagian") == "root" || $this->session->userdata("bagian") == "ccenter"):?>
            <a href="<?php echo base_url("index.php/dashboard/form"); ?>" class="btn"><i class="fa fa-file-text-o fa-lg"></i>&nbsp;Halaman Verifikasi</a>
            <a href="<?php echo base_url("index.php/dashboard/kategori"); ?>" class="btn yellow"><i class="fa fa-building fa-lg"></i>&nbsp;Pengaturan Kategori</a>
            <a href="<?php echo base_url("index.php/dashboard/pengguna"); ?>" class="btn pumpkin"><i class="fa fa-user-circle fa-lg"></i>&nbsp;Pengaturan Pengguna</a>
        <?php endif;?>
        <a href="<?php echo base_url("index.php/dashboard/api_logout"); ?>" class="btn red"><i class="fa fa-sign-out fa-lg"></i>&nbsp;Logout</a>
    <?php endif; ?>
</nav>