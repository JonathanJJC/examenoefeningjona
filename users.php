<?php 
include 'database.php';
include 'validator/both.php';

// include 'export.php';

//validator checkt wie ingelogd is, als niemand is ingelogd dan word de gebruiker verwezen naar de inlog pagina

$db = new database();
$users = $db->select("SELECT id, voornaam, achternaam, email, created_at, updated_at FROM gebruiker", []);



 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
     <?php $page = 'users'; include'header/header.php'; ?>
   
        <?php 
    if (empty($users)) {
    echo "<h1 class=no_data>There is no data to be seen</h1>";
    }else{

        $columns = array_keys($users[0]);
        $row_data = array_values($users);

        echo "<div>";
            echo "<table class=table>";
                echo "<tr>";
                    foreach($columns as $column){
                        echo "<th><strong>$column</strong></th>";
                    }
            echo "<th>action</th>";           
            foreach($row_data as $rows){
                echo "<tr>";
                  foreach($rows as $data)
                    echo "<td>$data</td>";
                    
                echo "<td>";
                       // echo "<a style=float:left; href=update_user.php?id=".$rows['id']."><button class=edit>edit</button></a>";
                       // echo "<a style=float:left; onclick=return confirm(Are you sure?) href=delete_user.php?id=$rows[id]><button class=delete>delete</button></a>";
            //            echo "<form action=users.php?id=".$rows['id']." class=export_form style=float:left; method='post'>";
            //             echo "<button class=export type='submit' name='export_id' value='Export to excel file'/>Export</button>";
            // echo "</form>";
                        // echo "<a href=delete_user.php"?"id=".$rows['id']."onclick=return confirm(are you sure you want to delete this user?)>delete</a>";
}
                   echo "</td>";
            echo "</table>";
            echo "<br>";
           // echo "<a onclick=history.go(-1);><button> Terug</button></a>";
            echo "<form class=export_form  method='post'>";
            
            echo "<button class=export type='submit' name='export' value='Export to excel file'/>Export to excel file</button>";
            echo "</form>";

        echo "</div>";}?>


</div>

</div>
</body>
</html>