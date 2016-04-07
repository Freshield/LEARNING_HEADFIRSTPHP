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
