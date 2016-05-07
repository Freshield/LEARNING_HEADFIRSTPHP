<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/5
 * Time: 19:05
 */
require_once ('startsession.php');

$page_title = "Questionnaire";
require_once ('header.php');

require_once ('connectvars.php');
require_once ('appvars.php');

if(!isset($_SESSION['user_id'])){
    echo"<p class='login'>Please<a href='login.php'>log in</a> to access this page.</p>";
    exit();
}

require_once ('navmenu.php');

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
        $query = "insert into mismatch_response (user_id,topic_id) values ('{$_SESSION['user_id']}','$topic_id')";


        mysqli_query($dbc,$query);
    }
}

if(isset($_POST['submit'])){
    foreach ($_POST as $response_id => $response){
        $query = "update mismatch_response set response = '$response' where response_id = '$response_id'";
        //echo "$query<br>";
        mysqli_query($dbc,$query);
    }
    echo "<p>Your responses have been saved.</p>";
}

$query = "select mr.response_id,mr.topic_id,mr.response,mt.name as topic_name,mc.name as category_name from mismatch_response 
as mr inner join mismatch_topic as mt using (topic_id) inner join mismatch_category as mc using (category_id) where 
user_id = 
'{$_SESSION['user_id']}'";

//echo "$query<br>";
$data = mysqli_query($dbc,$query);
$responses = array();

while($row = mysqli_fetch_array($data)){

    //$query2 = "select name,category_id from mismatch_topic where topic_id = '{$row['topic_id']}'";
    //$query2 = "select mt.name as topic_name, mc.name as category_name
   // from mismatch_topic as mt
   // inner join mismatch_category as mc
    //using (category_id)
    //where mt.topic_id = '{$row['topic_id']}'";
   // $data2 = mysqli_query($dbc,$query2);
   // if(mysqli_num_rows($data2) == 1){

       // $row2 = mysqli_fetch_array($data2);
       // $row['topic_name'] = $row2['topic_name'];

        //$query3 = "select name from mismatch_category where category_id = '{$row2['category_id']}'";
        //$data3 = mysqli_query($dbc,$query3);
        //if(mysqli_num_rows($data3) == 1){
        //    $row3 = mysqli_fetch_array($data3);
            //$row['category_name'] = $row2['category_name'];

        //}
        array_push($responses,$row);
    
}

mysqli_close($dbc);

echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<p>How do you feel about each topic?</p>';
$category = $responses[0]['category_name'];
echo '<fieldset><legend>' . $responses[0]['category_name'] . '</legend>';
foreach ($responses as $response) {
    // Only start a new fieldset if the category has changed
    if ($category != $response['category_name']) {
        $category = $response['category_name'];
        echo '</fieldset><fieldset><legend>' . $response['category_name'] . '</legend>';
    }

    // Display the topic form field
    echo '<label ' . ($response['response'] == NULL ? 'class="error"' : '') . ' for="' . $response['response_id'] . '">' . $response['topic_name'] . ':</label>';
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="1" ' . ($response['response'] == 1 ? 'checked="checked"' : '') . ' />Love ';
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="2" ' . ($response['response'] == 2 ? 'checked="checked"' : '') . ' />Hate<br />';
}
echo '</fieldset>';
echo '<input type="submit" value="Save Questionnaire" name="submit" />';
echo '</form>';

// Insert the page footer
require_once('footer.php');

?>