<?php
  $connection = mysqli_connect('localhost', 'root');
	
  mysqli_select_db($connection, 'reddit');
?>

<html>
<head>
    <title>Reddit</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="content">
    <h1>My Reddit</h1>
    
    <table>
<tr>
    <th>Titel</th><th>Datum</th><th>Auteur</th> 
</tr>
    
<?php

  $query = "select * from posts";
  
  $result = mysqli_query($connection, $query);
 
while ($row = mysqli_fetch_assoc($result))
{
  $reddit_id = $row["id"];
  $reddit_date = $row["date"];
  $reddit_title = $row["title"];
  $reddit_url = $row["url"];
  $reddit_summary = $row["summary"];
  $reddit_autor = $row["autor"];
  $small = substr($reddit_summary, 0 , 100);
    
  echo "
<tr>
    <td><a href='detail.php?id=$reddit_id'>$reddit_title</a></td>
    <td>$reddit_date</td>
    <td>$reddit_autor</td>
</tr>
    <td>$small...</td>
  
 
  \n";
}

?>
    
    
    </table>
    <br>
</div>
</body>
</html>