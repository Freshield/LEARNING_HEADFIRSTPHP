<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/4/21
 * Time: 14:41
 */

require_once ('appvars.php');

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "select * from guitarwars order by score desc, date asc;";
$data = mysqli_query($dbc,$query);

echo '<table>';

while($row = mysqli_fetch_array($data)){
    echo '<tr class="scorerow"><td><strong>'.$row['name'].'</strong></td>';
    echo '<td>'.$row['date'].'</td>';
    echo '<td>'.$row['score'].'</td>';
    echo '<td>'.$row['screenshot'].'</td>';
    echo '<td><a 
href="removescore.php?id='.$row['id'].'&amp;date='.$row['date'].
        '&amp;name='.$row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.$row['screenshot'].'">Remove</a></td></tr> ';

}
echo '</table>';

mysqli_close($dbc);