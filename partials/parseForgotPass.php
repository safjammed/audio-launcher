<?php
/**
 * Created by PhpStorm.
 * User: safjammed
 * Date: 9/30/2017
 * Time: 1:02 AM
 */

//add our database connection script
include_once 'resource/Database.php';
//include form validation utilities
include_once 'resource/utilities.php';


if (isset($_POST['forgotPassEmailBtn'])){ //If send Email was pressed
    $email = $_POST['email'];
    $console->log($email);
    //Check if the email exists in DB
    if (checkDuplicateEntries ('users','email',$email, $db ) == 1){
        //Generate security Token
        $token = generateRandomString(20);
        $console->info('Your Token is'.$token);

        //Save it to db
        if (addToken($db, $email,$token) == true) {
        	//On successful insertion
        	//Sendd Forgotpass mail to user
        	sendForgotPassMail($email, $token);
        	swal('Success!',"Password reset mail has been sent to Your inbox",'success');
        }



    }else{ //If the email Does not exist
        swal("Error!","The Email was not found in the database","Error");
    }
}

//IF the the passwords are provided

if (isset($_POST['forgotPassChngBtn'])) {
	//empty array for storing errors
    $console->log('Button pressed');
    $form_errors = array();

    //array containing form validation required fields

    $required_fields = array('email', 'password','token');

    //check empty fields
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $minimum_lengths_fields = array('email' => 8 , 'password' => 8);

    //checking the minimum lengths
    $form_errors = array_merge($form_errors, check_min_legth($minimum_lengths_fields));

//    //validating the email from the posed data
//
//    $form_errors = array_merge($form_errors, check_email($_POST));

    //Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $token = $_POST['token'];




    if(checkDuplicateEntries("users","email",$email,$db) != 1){
        swal('Sorry','Your Account Does Not exist anymore','error');
    }
    //now if there's no error then
    else if(empty($form_errors)){
    	if (matchToken($db,$email,$token) == true) { //if Token matches
    		//Set token to used
    		useToken($db,$token);

    		//Update Password to new
    		//hashing the password
	        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

	        if(updatePassword($db,$hashed_password,$email)){
	        	swal('Success','The password has been reset','success','userlogin.php');
	        }
    	}else{ //token Mismatch
    	    swal('Expired Token','Please request for password reset again','error');
        }
        
	}
}