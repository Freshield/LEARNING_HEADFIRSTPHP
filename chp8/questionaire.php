<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/5
 * Time: 19:05
 */
require_once ('connectvars.php');
require_once ('appvars.php');

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "select * from mismatch_response where user_id = '{$_SESSION['user_id']}'";
$data = mysqli_query($dbc,$query);

if(mysqli_num_rows($data) == 0){
    $query = "select topic_id from mismatch_topic order by topic_id";

    $data = mysqli_query($dbc,$query);
    $topicIDs = array();
    while($row = mysqli_fetch_array($data)){
        array_push($topicIDs,$row['topic_id']);
    }
    foreach ($topicIDs as $topic_id){
        $query = "insert into mismatch_response user_id,topic_id values ('{$_SESSION['user_id']}','$topic_id')";
        mysqli_query($dbc,$query);
    }
}

if(isset($_POST['submit'])){
    foreach ($_POST as $response_id => $response){
        $query = "update mismatch_response set response = '$response' where response_id = '$response_id'";
        mysqli_query($dbc,$query);
    }
    echo "<p>Your responses have been saved.</p>";
}

$query = "select response_id,topic_id,response from mismatch_response where user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
$response = array();

while($row = mysqli_fetch_array($data)){
    $query2 = "select name,category from mismatch_topic where topic_id = '{$row['topic_id']}'";
    $data2 = mysqli_query($dbc,$query2);
    if(mysqli_num_rows($data2) == 1){
        $row2 = mysqli_fetch_array($data2);
        $row['topic_name'] = $row2['name'];
        $row['category_name'] = $row2['category'];
        array_push($response,$row);
    }
}

?>