<html>

<head>
    <title>Aliens Abducted Me - Report an Abduction</title>
</head>

<body>

    <h2>Aliens Abducted Me - Report an Abduction</h2>

<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/7
 * Time: 20:15
 */
    $name = $_POST['firstname'] .' ' .$_POST['lastname'];
    $when_it_happened = $_POST['whenithappened'];
    $how_long = $_POST['howlong'];
    $fang_spootted = $_POST['fangspotted'];
    $email = $_POST['email'];
    $other = $_POST['other'];

    $message =
        "$name was abducted $when_it_happened\n".
        "and was gone for $how_long.\n".
        "number of aliends many\n".
        " Fang spotted: $fang_spootted\n".
        "Other comments: $other";
    $to = "zxdsw199182@gmail.com";
    $subject = "Aliens Abducted Me - Abduction Report";
/*
if (mail($to, $subject, $message, "From:".$email))
{
    echo 'success!<br>';
}
else
{
    echo 'fail';
}*/

$dbc = mysqli_connect('localhost','root','8888','aliendatabase')
or die('Eroor connecting to MySQL server');

$result = mysqli_query($dbc,'select * from aliens_abduction')
or die('Error querying database.');

mysqli_close($dbc);

echo $result;

echo 'Thanks for submitting the form.<br>';
echo 'Your name is '.$name .'<br>';
echo 'you were abducted ' .$when_it_happened .'<br>';
echo ' and were gone for ' .$how_long .'<br>';
echo 'was Fang there?' .$fang_spootted .'<br>';
echo 'Your email address is ' .$email .'<br>';
echo 'Other information is ' .$other .'<br>';
?>
</body>
</html>
