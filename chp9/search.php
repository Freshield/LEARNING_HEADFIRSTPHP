<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Risky Jobs - Search</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Risky Jobs - Search Results</h3>

<?php
  // Grab the sort setting and search keywords from the URL using GET
  require_once ('functions.php');

  $sort = $_GET['sort'];
  $user_search = $_GET['usersearch'];

  $cur_page = isset($_GET['page'])? $_GET['page'] : 1;
  $results_per_page = 5;
  $skip = (($cur_page-1) * $results_per_page);
  //echo "<br>cur_page=$cur_page skip=$skip<br>";

  // Start generating the table of results
  echo '<table border="0" cellpadding="2">';

  // Generate the search result headings
  echo '<tr class="heading">';
  echo generate_sort_links($user_search,$sort,$cur_page);

  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Query to get the results
  $query = build_query($user_search,$sort);

  $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_page = ceil($total/$results_per_page);

  $query = $query . " limit $skip, $results_per_page";
  //echo "<br>$query<br>";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr class="results">';
    echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
    echo '<td valign="top" width="50%">' . substr($row['description'],0,100) . '...</td>';
    echo '<td valign="top" width="10%">' . $row['state'] . '</td>';
    echo '<td valign="top" width="20%">' . substr($row['date_posted'],0,10) . '</td>';
    echo '</tr>';
  } 
  echo '</table>';
  
  if($num_page > 1){
    echo generate_page_links($user_search,$sort,$cur_page,$num_page);
  }

  mysqli_close($dbc);
?>

</body>
</html>
