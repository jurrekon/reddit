<!DOCTYPE HTML>

<html>
<head>
    <title>My reddit</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--<?php include 'header.php';?>-->
<div id="content">
<?php
  $connection = mysqli_connect('localhost', 'root');
	
  mysqli_select_db($connection, 'reddit');
// define variables and set to empty values
$autorErr = $titleErr = $urlErr = $summaryErr = "";
$autor = $title = $url = $summary = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["autor"])) {
     $autorErr = "Author is required";
       
   }else{
       $autor = $_POST["autor"];
       $autor = mysqli_real_escape_string($connection,$autor);
   }
   if (empty($_POST["title"])) {
     $titleErr = "Title is required";
   } else{
       $title = $_POST["title"];
       $title = mysqli_real_escape_string($connection,$title);
   }
   
  if (empty($_POST["url"])) {
     $urlErr = "URL is required";
   } else{
       $url = $_POST["url"];
      $url = mysqli_real_escape_string($connection,$url);
  }
   
   if (empty($_POST["summary"])) {
     $summaryErr = "Summary is required";
   }else{
       $summary = $_POST["summary"];
       $summary = mysqli_real_escape_string($connection,$summary); 
   }
}

?>
    
    <div class="content">
<h2>Voeg uw eigen post toe.</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   <p class="form">Auteur: <input class="auteur" type="text" name="autor" value="">
   <span class="error">* <?php echo $autorErr;?></span>
   <br><br>
   Titel: <input class="titel" type="text" name="title" value="">
   <span class="error">* <?php echo $titleErr;?></span>
   <br><br>
   URL: <input class="url" type="text" name="url" value="">
   <span class="error">* <?php echo $urlErr;?></span>
   <br><br>
   Samenvatting: <textarea class="samenvatting" name="summary" rows="5" cols="40"></textarea>
   <span class="error">* <?php echo $summaryErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
       </p>
</form>

<?php
     if (isset($_POST['submit'])){

$required = array('autor', 'title', 'url', 'summary');

$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if ($error) {
  echo "Nog niet alle velden zijn ingevuld";
} else {
$sql = "INSERT INTO posts (autor, title, url, summary)
VALUES ('$autor', '$title', '$url', '$summary')";
    echo "Post added";
   header("Location: index.php"); 
    if ($connection->query($sql) === TRUE) {
   echo "Post added";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

}
     }
?>
</div>
</body>
</html>