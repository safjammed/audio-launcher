<?php 
    include_once 'resource/session.php';
    include_once 'resource/Database.php';
    
    include_once 'resource/utilities.php';
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Audio Launcher</title>
<link rel="stylesheet" href="assets/css/player.css">
    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/small-business.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css" />
      
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/howler.core.js"></script>
    <script src="assets/js/siriwave.js"></script>
    <script src="assets/js/player.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>


  </head>

  <body>
<input type="hidden" id="usrId" name="user_id" value="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : ''; ?>">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="http://localhost/audiolauncher">AUDIO LAUNCHER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>      
            <?php if((isset($_SESSION['id']))): ?>
                <li class="nav-item">
                <a class="nav-link" href="upload.php">Upload</a>
              </li>
                     <li class="nav-item">
                      <a class="nav-link" href="account.php">Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                      <?php else:?>
                        <li class="nav-item"><a href="userlogin.php" class="nav-link">Login</a></li>
                      <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>