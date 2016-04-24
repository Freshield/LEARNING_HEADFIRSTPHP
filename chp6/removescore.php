<?php
require_once ('authorize.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guitar Wars - Remove a High Score</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Guitar Wars - Remove a High Score</h2>

<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/21
 * Time: 15:09
 */

require_once ('appvars.php');

if(isset($_GET['id'])&&isset($_GET['date'])&&isset($_GET['name'])&&isset($_GET['score'])&&isset($_GET['screenshot'])){
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
}
else if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['score'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_POST['screenshot'];
}
else{
    echo '<p class="error">Sorry, no high score was specified for removal.</p>';
}

if(isset($_POST['submit'])){
    if($_POST['confirm'] == 'yes'){
        @unlink(GW_UPLOADPATH.$screenshot);

        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        $query = "delete from guitarwars where id = $id limit 1;";

        mysqli_query($dbc,$query);
        mysqli_close($dbc);
        echo "<p>The high score of $score for $name was successfully removed.</p>";
    }
    else{
        echo "<p class='error'>The high score was not removed.</p>";
    }
}
else if(isset($id)&&isset($name)&&isset($date)&&isset($score)&&isset($screenshot)){
    ?>
    <p>Are you sure you want to delete the following high score?</p>
    <p>
        <strong>Name:</strong><?php echo $name; ?><br>
        <strong>Date:</strong><?php echo $date; ?><br>
        <strong>Scroe:</strong><?php echo $score; ?><br>
        <form action="removescore.php" method="post">
            <input type="radio" name="confirm" value="yes"/>Yes
            <input type="radio" name="confirm" value="no"/>No<br>
            <input type="submit" value="submit" name="submit"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="name" value="<?php echo $name; ?>"/>
            <input type="hidden" name="score" value="<?php echo $score; ?>"/>
            <input type="hidden" name="screenshot" value="<?php echo $screenshot; ?>"/>
        </form>
    </p>
    <?php
}
    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p> ';


?>
</body>
</html>
