<?php
//add our database connection script
include_once 'resource/Database.php';
//include form validation utilities
include_once 'resource/utilities.php';


//if sign up is clicked
if(isset($_POST['signupBtn'])){
    //empty array for storing errors  
    $form_errors = array();

    //array containing form validation required fields

    $required_fields = array('email', 'password','fname','lname');

    //check empty fields
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $minimum_lengths_fields = array('email' => 8 , 'password' => 8);

    //checking the minimum lengths
    $form_errors = array_merge($form_errors, check_min_legth($minimum_lengths_fields));

    //validating the email from the posed data

    $form_errors = array_merge($form_errors, check_email($_POST));

    //collect form data and store in variables
    $email = $_POST['email'];    
    $password = $_POST['password'];    
    $fname= $_POST['fname'];
    $lname =  $_POST['lname'];
    
    if(checkDuplicateEntries("users","email",$email,$db)){
        swal('Sorry','Email is Already Taken','error');
    }
    //now if there's no error then
    else if(empty($form_errors)){


        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{
            //create SQL insert statement
            $sqlInsert = "INSERT INTO users (email, password, fname, lname, join_date)
              VALUES (:email, :password, :fname, :lname, now())";

            //use PDO prepared to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into the database
            $statement->execute(array(':email' => $email, ':password' => $hashed_password, ':fname' => $fname, ':lname' => $lname));
            $this_id=$db->lastInsertId();
            //check if one new row was created
            if($statement->rowCount() == 1){
                sendActivationMail($email, $fname, $lname);

                echo $result ="<script type='text/javascript'>
                    swal({
                        title:\"Thank you\",
                        text: \"Registration Completed Successfully. Please Verify Your Email\",
                        type:\"success\"}).then(function() {
                            window.location.href='userlogin.php';
                         }, function(dismiss){});

                </script>";
            }
        }catch (PDOException $ex){
            swal("An error occurred: ",$ex->getMessage(), 'error');
        }
    }else {
        //if there is an error
        if (count($form_errors) == 1) {
            $result = "<ul style='color:red'>";
            foreach ($form_errors as $error) {
                $result .= "<li> {$error} </li>";
            }
            $result .= "</ul>";
            swal('Error', $result,'error');

        } else {
            $result = "There were " . count($form_errors) . " errors in the form <ul style='color:red'>";
            //loop through all the errors for printing
            foreach ($form_errors as $error) {
                $result .= "<li> {$error} </li>";
            }
            $result .= "</ul>";
            swal('Error', $result,'error');


        }
    }
}
?>