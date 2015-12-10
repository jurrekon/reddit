<!DOCTYPE HTML>

<html>
<head>
    <title>My reddit</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <script>
(function($,W,D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#myform").validate({
                rules: {
                    autor: "required",
                    title: {
                        required: true,
                    minlength: 10
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    summary: {
                        required: true,
                        minlength: 100
                    },
                },
                messages: {
                    autor: "Please enter the author",
                    title: {
                        required: "Please provide a title",
                        minlength: "Your title must be at least 10 characters long"
                    },
                    url: {
                        required: "Please provide a url",
                        url: "please give a valid url"
                    },
                    summary: {
                        required: "Please provide a summary",
                        minlength: "The summary must be aleast 100 characters long"
                    },
                  
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
})(jQuery, window, document);
    
    </script>
</head>

<body>

<div id="content">
<?php
  $connection = mysqli_connect('localhost', 'root');
	
  mysqli_select_db($connection, 'reddit');
// define variables and set to empty values

$autor = $title = $url = $summary = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["autor"])) {
       
       $autor = $_POST["autor"];
       $autor = mysqli_real_escape_string($connection,$autor);
   }
   if (!empty($_POST["title"])) {

       $title = $_POST["title"];
       $title = mysqli_real_escape_string($connection,$title);
   }
   
  if (!empty($_POST["url"])) {
    
       $url = $_POST["url"];
      $url = mysqli_real_escape_string($connection,$url);
  }
   
   if (!empty($_POST["summary"])) {

       $summary = $_POST["summary"];
       $summary = mysqli_real_escape_string($connection,$summary); 
   }
}
?>
    
    <div class="content">
<h2>Voeg uw eigen post toe.</h2>
<p><span class="error">* required field.</span></p>
<form id="myform" method="post" novalidate="novalidate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   <p class="form">
    Auteur: <input class="auteur" type="text" name="autor" value="">

   <br><br>
   Titel: <input class="titel" type="text" name="title" value="">

   <br><br>
   URL: <input class="url" type="text" name="url" value="">

   <br><br>
   Samenvatting: <textarea class="samenvatting" name="summary" rows="5" cols="40"></textarea>

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

} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

}
     }
?>
</div>
</body>
</html>

</div>
</body>
</html>