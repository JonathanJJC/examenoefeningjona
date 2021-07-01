<?php
// include 'database.php';
// include 'validator/both.php';

$id = $_SESSION['id'];

$msg = "";
if (isset($_POST['upload'])) {

    if(empty($_FILES['uploadfile']['tmp_name']) || !is_uploaded_file($_FILES['uploadfile']['tmp_name']))
{
    $msg = "Failed to upload image";
}else{
          
    

    $db = new database();

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
    $folder = "image/".$filename;
        
        // Get all the submitted data from the form
        // $sql = "INSERT INTO image (filename) VALUES ('$filename')";
 
        // Execute query
        $db->insert_image($id, $filename);
         
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }

      }
          
  }

  if (isset($_POST['update_img'])) {

    $db = new database();

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
    $folder = "image/".$filename;

           // $db->select("INSERT INTO image (filename) VALUES ('$filename')", []);
         
        // Get all the submitted data from the form
        // $sql = "INSERT INTO image (filename) VALUES ('$filename')";
 
        // Execute query
        
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
            $db->update_image($id, $filename);
        }else{
            $msg = "Failed to upload image";
      }

        }
    $db = new database();
  $result = $db->select("SELECT post.inhoud, gebruiker.voornaam FROM post INNER JOIN gebruiker ON post.poster_id = gebruiker.id WHERE post.poster_id = :id", [':id' => $id]);
  // foreach ($result as $data) {
  //   echo "<img src=image/$data[inhoud]>";
  // }
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Feed</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
</head>
<body>
    <?php $page = 'feed'; include'header/header.php'; ?>
    
            <?php  
                if (empty($result)) {
                    echo "<h3 class=error>Er zijn nog geen posts om van te genieten</h3>";
                    // echo "<h3 class=succes><a href=add_post.php><button >Maak je eigen post</button></a><h3>";
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
               // echo "<button type=submit name=update_img>UPDATE</button>";
               // echo "<button type=submit name=upload>UPLOAD</button>";
            }
            ?>
                
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="uploadfile" value="" /><br>
            <button type=submit name=upload>UPLOAD</button>
        </form>

        <?php echo $msg; ?>
        
        
</body>
</html> -->