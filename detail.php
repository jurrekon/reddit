<?php
  $connection = mysqli_connect('localhost', 'root');
	
  mysqli_select_db($connection, 'reddit');
?>

<html>
<head>
    <title>Reddit post</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <a class='back' href="index.php"><img src="back.png" alt="back"/></a>
<div class="content">
    <h1>My Reddit Post</h1>
    
<?php

  $query = "select * from posts";
  $id = $_GET['id'];
  $result = mysqli_query($connection, "SELECT * FROM posts WHERE id=" . $id);
 
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
    <h2>$reddit_title</h2>
    <p>$reddit_summary</p>
    
    <p><a target='_blank' href='$reddit_url'>Lees hier meer</a></p>
    
    <p class='footer'>Gepost op $reddit_date door $reddit_autor</p>
    
  
  \n";
}

?>
    
    
    <br>
</div>
</body>
</html>