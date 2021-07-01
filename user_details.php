<?php 
include 'database.php';
include 'validator/both.php';
include 'add_post.php';
$id = $_SESSION['id'];
//validator checkt wie ingelogd is, als niemand is ingelogd dan word de gebruiker verwezen naar de inlog pagina


$db = new database();

$result = $db->select("SELECT post.id, post.inhoud, gebruiker.voornaam, gebruiker.achternaam, gebruiker.email, gebruiker.created_at FROM post INNER JOIN gebruiker ON post.poster_id = gebruiker.id WHERE post.poster_id = :id", [':id' => $id]);
  


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
     <?php $page = 'userdetails'; include'header/header.php'; ?>


   
        <?php  
                if (empty($result)) {
                    echo "<h3 class=error>Er zijn nog geen posts om van te genieten</h3>";
                    echo "<h3 class=succes><a href=add_post.php><button >Maak je eigen post</button></a><h3>";
            }else{
            //     foreach ($result as $data) {

            //         echo "<div class=polaroid>";
            //         echo "<img src=image/$data[inhoud] style=width:100%>";
            //         echo "<div class=container>";
            //         echo "<p>$data[voornaam]</p>";
            //         echo "</div>";
            //         echo "</div>";
            //         echo "<br>";
            // }
                
                      
                foreach ($result as $info){}
    
                echo "<div class=user_info>";
                    echo "<h4>Name:  $info[voornaam]</h4>";
                    echo "<h4>Achternaam:  $info[achternaam]</h4>";
                    echo "<h4>Email:  $info[email]</h4>";
                    echo "<h4>Lid sinds:  $info[created_at]</h4>";

                    echo "<form method=POST enctype=multipart/form-data>";
            echo "<input type=file name=uploadfile value= /><br>";
           echo  "<button class=upload type=submit name=upload>upload</button>";
        echo "</form>";

        echo $msg;
                echo "</div>"; 

            foreach ($result as $data){

                    echo "<div class=responsive>";
                    echo "<div class=gallery>";
                    echo "<img src=image/$data[inhoud] width=600 height=400>";
                    echo "<div class=desc>";
                    echo "<a href=delete_post.php?id=$data[id]><button class=delete type=submit name=upload>delete</button>";
                    echo "<a href=view_post.php?id=$data[id]><button class=view type=submit name=upload>view</button>";
                    echo "</div>";
                    echo "</div>";
                     echo "</div>";
            }
            
    }
?>

</div>
</body>
</html>