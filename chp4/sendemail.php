
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Make Me Elvis - Send Email</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
<p><strong>Private:</strong> For Elmer's use ONLY<br />
    Write and send an email to mailing list members.</p>



<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/16
 * Time: 19:21
 */

if(isset($_POST['submit'])){

    $from = "zxdsw199182@gmail.com";
    $subject = $_POST['subject'];
    $text = $_POST['elvismail'];
    $output = false;

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
        if(empty($text)) {

            echo "You forgot the email body text.<br>";
        }

        $output = true;

    }

}
else{
    $output = true;
}

if($output == true) {
    ?>

    <br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="subject">Subject of email:</label><br/>
        <input id="subject" name="subject" type="text" size="30" value="<?php echo "$subject"; ?>"/><br/>
        <label for="elvismail">Body of email:</label><br/>
        <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo "$text"; ?></textarea><br/>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    <?php
}
?>
</body>
</html>