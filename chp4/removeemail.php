<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Make Me Elvis - Remove Email</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
<p>Enter an email address to remove.</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/16
 * Time: 20:34
 */

//$email = $_POST['email'];
$dbc = mysqli_connect('localhost','root','8888','elvis_store') or die("Error connecting to MySQL");

if(isset($_POST['submit'])){
    foreach ($_POST['todelete'] as $delete_id){
        $query = "delete from email_list where id = $delete_id";
        mysqli_query($dbc,$query) or die("Error querying database");
    }
    echo "Customer removed.<br>";
}
$query = "select * from email_list";
$result = mysqli_query($dbc,$query) or die("Error querying to MySQL");
while($row = mysqli_fetch_array($result)){
    echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
    echo $row['first_name'];
    echo $row['last_name'];
    echo $row['email'];
    echo '<br>';
}


mysqli_close($dbc);



?>

    <input type="submit" name="submit" value="Remove" />
</form>
</body>
</html>

