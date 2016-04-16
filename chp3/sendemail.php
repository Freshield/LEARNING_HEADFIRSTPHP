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

$query = "select * from email_list";
$dbc = mysqli_connect('localhost','root','8888','elvis_store');
$result = mysqli_query($dbc,$query);

while ($row = mysqli_fetch_array($result)){
    echo $row['first_name'] . ' ' . $row['last_name'] . ' : ' . $row['email'] . '<br>';
    echo "{$row['first_name']} {$row['last_name']} : {$row['email']}<br>";
}






?>