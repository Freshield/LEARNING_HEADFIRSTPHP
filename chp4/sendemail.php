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

if(!empty($subject) && !empty($text)){

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
    if(empty($subject)){

        echo "You forgot the email subject.<br>";
    }
    if(empty($text)){

        echo "You forgot the email body text.<br>";
    }
    ?>
    <br>
    <form method="post" action="sendemail.php">
        <label for="subject">Subject of email:</label><br />
        <input id="subject" name="subject" type="text" size="30" /><br />
        <label for="elvismail">Body of email:</label><br />
        <textarea id="elvismail" name="elvismail" rows="8" cols="40"></textarea><br />
        <input type="submit" name="Submit" value="Submit" />
    </form>
<?php
}


?>