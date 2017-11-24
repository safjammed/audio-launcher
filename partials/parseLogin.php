<?php

include_once 'resource/database.php';
include_once 'resource/utilities.php';

if(isset($_POST['loginBtn'])){
$console->log('Login btn pressed');
//errors
    $form_errors = array();

//validate
    $required_fields = array('password','email');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){
        $console->log('No form Errors');
        //collect data
        $password = $_POST['password'];
        $email = $_POST['email'];
        isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember="";
        try{
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement -> execute(array(':email' => $email));

        while($row = $statement -> fetch()){
            $console->log('Data fetched');
            
            $id = $row['id'];
            $email = $row['email'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $verified = $row['verified'];
            $hashed_password = $row['password'];


            if(password_verify($password, $hashed_password)){
                $console->log('Password is correct');
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $row['role'];
                $_SESSION['fname'] =$row['fname'];
                $_SESSION['lname'] =$row['lname'];
                $_SESSION['verified'] = $row['verified'];

                $fingerprint = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
                $_SESSION['last_active'] = time();
                $_SESSION['fingerprint'] = $fingerprint;

                if ($remember === 'yes'){
                    rememberMe($id);
                }
                //call sweetAlert
                if(!isset($_GET['ref']) && $verified == 1){
                    echo $result = swal('Welcome back '.$fname.'!','You are being logged in','success','index.php',3000);

            }elseif ($verified == 0){ //IF the account is not verified
                    ?>
                    <script>
                        swal({
                            title: 'Please Activate Your account first',
                            text: "Check Your Email inbox.",
                            type: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'SEND THE MAIL AGAIN',
                         }).then(function () {
                            //Refresh the page
                            window.location.href="userLogin.php";
                        }, function (dismiss) {
                            if (dismiss === 'cancel') {
                                //Send the mail again
                                swal({
                                    title: 'Please Wait',
                                    text: 'The Email is being Sent',
                                    showConfirmButton: false,
                                    onOpen: function () {
                                        swal.showLoading();
                                        $.get('activate.php','resend=1&email=<?=$email?>&fname=<?=$fname?>&lname=<?=$lname?>', function (data, status) {
                                            if (status == 'success'){ //if the sending was successful
                                                swal('Success','The mail has been resent','success');
                                            }else{ //not successful
                                                swal('Failed','The mail Could not be sent','error');
                                            }
                                        });
                                    }
                                });



                            }
                        })
                    </script>


                    <?php
                }

            }else{
               echo $result = swal("Error","Invalid username or password", "error");
               $console->log('Invalid User password');
            }
        }
        }catch(PDOException $ex){
            $console->log ($ex->getMessage());
            swal("Your Email Does not exist in our DB");
        }
    }else{
        $result ="";
        foreach ($form_errors as $error) {
            $result .= "{$error}"." # ";
        }
        swal('error!',$result,'error');
    }

}


?>