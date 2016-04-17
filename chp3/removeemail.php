<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/16
 * Time: 20:34
 */

$email = $_POST['email'];
$dbc = mysqli_connect('localhost','root','8888','elvis_store') or die("Error connecting to MySQL");
$query = "delete from email_list where email = '$email'";
mysqli_query($dbc,$query) or die("Error querying to MySQL");
echo "Success delete email $email from database";

mysqli_close($dbc);



?>