<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/7
 * Time: 17:23
 */
// Start the session
require_once('startsession.php');

// Insert the page header
$page_title = 'My Mismatch';
require_once('header.php');

require_once('appvars.php');
require_once('connectvars.php');

// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}

// Show the navigation menu
require_once('navmenu.php');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "select * from mismatch_response where user_id = '{$_SESSION['user_id']}'";
$data = mysqli_query($dbc,$query);

if(mysqli_num_rows($data) != 0){
    $query = "select mr.response_id,mr.topic_id,mr.response,mt.name as topic_name, mc.name as category_name
    from mismatch_response as mr
    inner join mismatch_topic as mt using (topic_id)
    inner join mismatch_category as mc using (category_id)
    where mr.user_id = '{$_SESSION['user_id']}'";

    $data = mysqli_query($dbc,$query);
    $user_response = array();
    while($row = mysqli_fetch_array($data)){
        array_push($user_response,$row);
    }


    $mismatch_score = 0;
    $mismatch_user_id = -1;
    $mismatch_topics = array();

    $query = "select user_id from mismatch_user where user_id != '{$_SESSION['user_id']}'";
    $data = mysqli_query($dbc,$query);
    while($row = mysqli_fetch_array($data)){
        $query2 = "select response_id,topic_id,response from mismatch_response
        where user_id = '{$row['user_id']}'";
        $data2 = mysqli_query($dbc,$query2);
        $mismatch_responses = array();
        while($row2 = mysqli_fetch_array($data2)){
            array_push($mismatch_responses,$row2);
        }
        $score = 0;
        $topic = array();
        $categorys = array();
        for($i = 0;$i<count($user_response);$i++){
            if(((int)$user_response[$i]['response'])+((int)$mismatch_responses[$i]['response']) == 3){
                $score += 1;
                array_push($topic,$user_response[$i]['topic_name']);
                array_push($categorys,$user_response[$i]['category_name']);
            }

        }

        if($score>$mismatch_score){
            $mismatch_score = $score;
            $mismatch_user_id = $row['user_id'];
            $mismatch_topics = array_slice($topic,0);
        }

    }

    if($mismatch_user_id != -1){
        $query = "select username,first_name,last_name,city,state,picture from mismatch_user where user_id = $mismatch_user_id";
        $data = mysqli_query($dbc,$query);
        if(mysqli_num_rows($data) == 1){
            $row = mysqli_fetch_array($data);
            echo "<table><tr><td class='label'>";
            if(!empty($row['first_name']) && !empty($row['last_name'])){
                echo "{$row['first_name']},{$row['last_name']}<br>";
            }
            if(!empty($row['city']) && !empty($row['state'])){
                echo "{$row['city']},{$row['state']}<br>";
            }
            echo "</td><td>";
        }
        if(!empty($row['picture'])){
            echo '<img src="'.MM_UPLOADPATH.$row['picture'].'" width="120" alt="Profile Picture"><br>';

        }
        echo "</td></tr></table>";

        echo "<h4>You are mismatched on the following ". count($mismatch_topics)." topics:</h4>";
        foreach ($mismatch_topics as $topics){
            echo "$topics<br>";
        }
        echo "<h4>View <a href='viewprofile.php?user_id=$mismatch_user_id'>{$row['first_name']}'s profile</a></h4>";

        $category_totals = array(array($categorys[0],0));//
        foreach ($categorys as $category){
            if($category_totals[count($category_totals)-1][0] != $category){
                array_push($category_totals,array($category,1));
            }
            else{
                $category_totals[count($category_totals)-1][1]++;
            }
            //echo "$category<br>";

        }
        for ($i = 0;$i<count($category_totals);$i++){
            //echo "category is {$category_totals[$i][0]}, value is {$category_totals[$i][1]}.<br>";
        }
        echo "<h4>Mismatched category breakdown:</h4>";
        draw_bar_graph(480,120,$category_totals,5,MM_UPLOADPATH.sha1($_SESSION['user_id']).'mymismatchgraph.png');
        echo "<img src=".MM_UPLOADPATH.sha1($_SESSION['user_id'])."mymismatchgraph.png alt='Mismatch category graph'><br>";
    }

}
else{
    echo "<p>You must first <a href='questionaire.php'>answer the questionnaire</a> before you can be mismatched.</p>";
}


mysqli_close($dbc);

// Insert the page footer
require_once('footer.php');

?>