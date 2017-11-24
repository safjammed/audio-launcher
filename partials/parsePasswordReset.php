<?php
/**
 * Created by PhpStorm.
 * User: safja
 * Date: 2/22/2017
 * Time: 11:21 PM
 */
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


if (isset($_POST['passResetBtn'])){
    //error handling
    $form_errors = array();
    $required_fields = array('email', 'new_password', 'confirm_password');
    $required_length_fields = array("new_password" => 6, "confirm_password" => 6);

    //Form validation
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    $form_errors = array_merge($form_errors, check_min_legth($required_length_fields));
    $form_errors = array_merge($form_errors, check_email($_POST));
    if(empty($form_errors)){
        //form data
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        //if the passwords do not match
        if ($new_password != $confirm_password){
            $result = flashmessage("Passwords don't match");
        }else{
            try{
                //Search for the email in the database
                $sql = "SELECT * FROM users WHERE email= :email";
                $statement = $db->prepare($sql);
                $statement->execute(array(':email' => $email));
                //if the email was found in the database
                if ($statement->rowCount() == 1){
                    //hashing the password
                    $hashed_password = password_hash($confirm_password,PASSWORD_DEFAULT);
                    //Resetting the password
                    $sql = "UPDATE users SET password=:password WHERE email=:email";
                    $statement= $db->prepare($sql);
                    $statement->execute(array(':email'=>$email, ':password' => $hashed_password));

                    //Letting user know that the password was successfully reset;
                    $result = flashmessage("Password Reset Successful","pass");
                }else{ // if the email was not found in the database
                    $result = flashmessage("Email was not found in the Rocords");
                }
            }catch (PDOException $ex){
                $result = flashmessage("An error occurred: ".$ex->getMessage());
            }
        }

    }else{
        $result = flashmessage("Please Solve ".count($form_errors)." error(s) in the form <ul style='color:red'>");
        foreach ($form_errors as $err){
            $result .= "<li>{$err}</li>";
        }
        $result .= "</ul>";
    }




}
?>