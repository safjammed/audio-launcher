<?php
include_once 'resource/session.php';

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log in to continue</title>   
    <!-- <link rel="stylesheet" href="assets/css/reset.css"> -->
    <script src='assets/js/jquery.min.js'></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
    <!-- <script src="assets/js/materialize.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/materialize/materialize.min.css"> -->
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='assets/css/font-awesome.min.css'/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/login-scripts.js"></script>    
    <link rel="stylesheet" href="assets/css/login.css">    
  </head>
  <body>
<div class="pen-title">
</div>
<div class="container">
  <div class="card"></div>
    <?php    IF (isset($_GET['forgotpass']))  : ?>
        <?php include_once 'partials/parseForgotPass.php'; ?>

        <?php IF (isset($_GET['token'])) :?>         
          <div class="card">
            <h1 class="title">RESET Password</h1>
            <form action="" method="post" onSubmit="return validateForm();">
                <input type="checkbox" id="terms" checked hidden/>
              <input type="hidden" name="token" value="<?=$_GET['token'];?>">
              <input type="hidden" name="email" value="<?=base64_decode($_GET['email']);?>">
                <div class="input-container">
                  <input type="password" name="password" id="reg-password" required="required"/>
                  <label for="reg-password" id="password-avl">Password</label>
                  <div class="bar"></div>
                </div>
                <div class="input-container">
                  <input type="password" name="reg-repassword" id="reg-repassword" required="required"/>
                  <label for="reg-repassword">Repeat Password</label>
                  <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit" name="forgotPassChngBtn" id="submit_login"><span>Reset Password</span></button>
                </div>
                <div class="footer"><a href="userlogin.php">Login Instead</a><br><br><br><a href="userlogin.php" id="home"><?= $GLOBALS['sitename']?></a></div>
            </form>
        </div>        
        <?php ELSE: ?>
        <div class="card">
            <h1 class="title">Forgot Password</h1>
            <form action="" method="post">
                <div class="input-container">
                    <input type="text" name="email" id="email" required="required"/>
                    <label for="email">Email</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit" name="forgotPassEmailBtn" id="submit_login"><span>Send Email</span></button>
                </div>
                <div class="footer"><a href="userlogin.php">Login Instead</a><br><br><br><a href="userlogin.php" id="home"><?= $GLOBALS['sitename']?></a></div>
            </form>
        </div>
        <?php ENDIF; ?>
    <?php ELSE : ?>
  <div class="card">
    <h1 class="title">Login</h1>
    <form action="" method="post">
    <?php include_once 'partials/parseLogin.php'; ?>
      <div class="input-container">
        <input type="text" name="email" id="email" required="required"/>
        <label for="email">Email</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" name="password" required="required"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
          <a class="remember" href="userlogin.php?forgotpass=1"> Forgot Password?</a><br><br>            
        </div>



      <div class="button-container">
        <button type="submit" name="loginBtn" id="submit_login"><span>Login</span></button>
      </div>
      <div class="footer"><a id="reg" href="#">Register</a><br><br><br><a href="index.php" id="home"><?= $GLOBALS['sitename']?></a></div>
    </form>
  </div>
  <!-- Regestration panel -->
   <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <?php include_once 'partials/parseSignup.php';?>
    <form method="post" action="" id="reg-form" onsubmit="return validateForm();">

      <div class="input-container col6">
        <input type="text" name="fname" id="reg-fname" required="required"/>
        <label for="#reg-fname">First Name</label>
        <div class="bar"></div>
      </div>
      <div class="input-container col6">
        <input type="text" name="lname" id="reg-lname" required="required"/>
        <label for="#reg-lname">Last Name</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">
        <input type="text" name="email" id="reg-email" required="required"/>
        <label for="reg-email">email</label>
        <div class="bar"></div>
      </div>      
      <div class="input-container">
        <input type="password" name="password" id="reg-password" required="required"/>
        <label for="reg-password" id="password-avl">Password</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" name="reg-repassword" id="reg-repassword" required="required"/>
        <label for="reg-repassword">Repeat Password</label>
        <div class="bar"></div>
      </div>
      <div class="input-container inline">
        <input type="checkbox" name="terms" id="terms" required="required"/>       
        <label for="#terms" class="terms">I have read and agree with terms and conditions</label>        
      </div>
      
      <div class="button-container">
        <button name="signupBtn" type="submit" id="signupBtn"><span>Sign-up</span></button>
      </div>
    </form>
  </div>


<?php ENDIF;?>
</div>

<script type="text/javascript">
  $('.toggle').on('click', function() {
      $('.container').stop().addClass('active');
  });
  $('#reg').on('click', function() {
      $('.container').stop().addClass('active');
  });

  $('.close').on('click', function() {
      $('.container').stop().removeClass('active');
  });

  function validateForm(){
      console.log('submit');
      
      //Check if everything is okay
      //password matching
      if ($('#reg-password').val() != $('#reg-repassword').val()){
        swal({
            title:"The passwords Do not match",
            text: "Please retype the passwords",
            type:"error"
          });
        return false;
      }else if ($('#terms').prop('checked') == 'false') {
        swal({
            title:"Error",
            text: "You must agree to the terms and condditions",
            type:"error"
          });
        return false;
      }else{
        return true;
      }    
  }
</script>

</body>

</html>
