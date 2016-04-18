<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/16
 * Time: 19:21
 */

$from = "zxdsw199182@gmail.com";
$subject = $_POST['subject'];
$text = $_POST['elvismail'];

if(!empty($subject) && !empty($subject)){

    $query = "select * from email_list";
    $dbc = mysqli_connect('localhost','root','8888','elvis_store') or die("Error connecting to MySQL");
    $result = mysqli_query($dbc,$query) or die("Error querying database");

    while ($row = mysqli_fetch_array($result)){
        $firstname = $row['first_name'];
        $lastname = $row['last_name'];

        $msg = "Dear $firstname $lastname ,\n$text";
        $to = $row['email'];

        mail($to,$subject,$msg);
        echo "Email sent to: $to<br>";
    }

    echo "<br>Send mail finished";
    mysqli_close($dbc);
}
else{
    echo "You forgot the email subject and/or body text.<br>";
}







?>