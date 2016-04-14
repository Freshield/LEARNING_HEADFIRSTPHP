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
 * Date: 2016/4/14
 * Time: 15:01
 */

echo "here1";
$connect = mysqli_connect('localhost','root','8888','aliendatabase') or die('Unale to connect');
$sql = "select * from aliens_abduction";
$result = mysqli_query($connect,$sql);
while($row = mysqli_fetch_row($result)){
    echo "$row[0] $row[1] $row[2] $row[3] $row[4] $row[5]";
}

echo "here2";
//$query = "insert into aliens_abduction (first_name,last_name,when_it_happened,how_long,//fang_spootted,other,email) values
//('sally1','jones','3 days ago','1 day','yes','may seen your dog','sally@gregs-list.net');";

echo "here3";
//$result = mysqli_query($connect,$query)
//    or die('Error querying database.');

echo "here4";
mysqli_close($connect);

echo $query ."<br>";

echo $result;

?>
</body>
</html>
