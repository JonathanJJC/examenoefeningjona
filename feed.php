<?php 
include 'database.php';

//validator checkt wie ingelogd is, als niemand is ingelogd dan word de gebruiker verwezen naar de inlog pagina
include 'validator/both.php';

$db = new database();

$result = $db->select("SELECT post.inhoud, gebruiker.voornaam FROM post INNER JOIN gebruiker ON post.poster_id = gebruiker.id", []);
  


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
     <?php $page = 'feed'; include'header/header.php'; ?>
   
        <?php  
                if (empty($result)) {
                    echo "<h3 class=error>Er zijn nog geen posts om van te genieten</h3>";
                    echo "<h3 class=succes><a href=add_post.php><button >Maak je eigen post</button></a><h3>";
            }else{
                foreach ($result as $data) {

                    echo "<div class=polaroid>";
                    echo "<img src=image/$data[inhoud] style=width:100%>";
                    echo "<div class=container>";
                    echo "<p>$data[voornaam]</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<br>";
            }
    }
?>

</div>
</body>
</html>