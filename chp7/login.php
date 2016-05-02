<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/2
 * Time: 13:24
 */

require_once ('connectvars.php');

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])){
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Mismatch"');
    exit('<h3>Mismatch</h3>Sorry, you must enter your username and password to log in and access this page. If you aren\'t a
regisered member, please < a href = "signup.php" > signup</a > \')');
}

//connect to database
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$user_username = mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_USER']));
$user_password = mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_PW']));

//look up the name and password in database

$query = "select user_id, username from mismatch_user where username='$user_username' and password= sha('$user_password')";

$data = mysqli_query($dbc,$query);

if(mysqli_num_rows($data) == 1){
    $row = mysqli_fetch_array($data);
    $user_id = $row['user_id'];
    $username = $row['username'];

}
else{
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Mismatch"');
    exit('<h3>Mismatch</h3>Sorry, you must enter your username and password to log in and access this page. If you aren\'t a 
regisered member, please <a href="signup.php">signup</a>');
}

echo('<p class="login">You are logged in as '.$username.'.<p>');


?>