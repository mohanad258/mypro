 
<?php
$con=new mysqli('localhost','root','','messageauthentication');
if(!$con){
    die(mysqli_error($con));
}
