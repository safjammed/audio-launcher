<?php
/**
 * Created by PhpStorm.
 * User: safjammed
 * Date: 9/29/2017
 * Time: 10:54 PM
 */
include_once 'resource/database.php';
include_once 'resource/utilities.php';
if (isset($_GET['resend'])){ // If user Requested to send the mail again
$lname = $_GET['lname'];
$fname = $_GET['fname'];
$email = $_GET['email'];

sendActivationMail($email, $fname, $lname);

}else{
IF(isset($_GET['user'])) :
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
</head>
<body>
<?php
$email = base64_decode($_GET['user']);
activateUser($db, $email);
ELSE:
header("location:index.php");
ENDIF;
}
?>
</body>

</html>
