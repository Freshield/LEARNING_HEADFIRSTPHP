<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/3
 * Time: 20:33
 */

if(isset($_SESSION['username'])){
    echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
    echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    echo '&#10084; <a href="logout.php">Log Out ('.$_SESSION['username'].')</a><br />';
}
else{
    echo '&#10084; <a href="login.php">Log In</a><br />';
    echo '&#10084; <a href="signup.php">Sign Up</a><br />';
}
?>