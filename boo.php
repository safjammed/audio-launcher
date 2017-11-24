<pre>
<?php 
var_dump($_SERVER); 
?>

<br>
<br>
<?php 
var_dump('http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
 ?>