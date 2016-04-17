
<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/15
 * Time: 18:44
 */
$dbc = mysqli_connect('localhost','root','8888','elvis_store') or die('Error connecting to MySQL');

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];

$query = "insert into email_list (first_name,last_name,email) ".
    "values ('$first_name','$last_name','$email')";

mysqli_query($dbc,$query) or die('Error querying database.');

echo '<a href="addemail.html">Customer added.</a>';

mysqli_close($dbc);


?>