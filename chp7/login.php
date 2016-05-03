<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/2
 * Time: 13:24
 */

require_once ('connectvars.php');

session_start();

$error_msg = "";

//if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])){
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);


        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

        if(!empty($user_username) && !empty($user_password)){
            $query = "select user_id, username from mismatch_user where username = '$user_username' and password=sha('$user_password')";
            $data = mysqli_query($dbc,$query);

            if(mysqli_num_rows($data) == 1){
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                setcookie('user_id',$row['user_id'],time()+(30*60*60));
                setcookie('username',$row['username'],time()+(30*60*60));

                $home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'index.php';
                header('Location: '.$home_url);
            }
            else{
                $error_msg = "Sorry, you must enter a valid username and password to log in.";
            }
        }
        else{
            $error_msg = "Sorry, you must enter a valid username and password to log in.";
        }
    }
    //header('HTTP/1.1 401 Unauthorized');
    //header('WWW-Authenticate: Basic realm="Mismatch"');
    //exit('<h3>Mismatch</h3>Sorry, you must enter your username and password to log in and access //this page. If you aren\'t a
//regisered member, please < a href = "signup.php" > signup</a > \')');
}
/*
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
*/

?>
<html>
<head>
    <title>Mismatch - Log In</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h3>Mismatch - Log In</h3>
<?php
if(empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';

    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Log In</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"
                   value="<?php if (!empty($user_username)) echo $user_username; ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </fieldset>
        <input type="submit" value="Log In" name="submit">
    </form>
    <?php
}
else{
    $user_id = $_SESSION['user_id'];
    echo "<p class='login'>You are logged in as {$_SESSION['username']}</p>";
}
?>
</body>
</html>
