<?php
//Connect met database.php
include 'database.php';

$db = new database();
// $db->insert_usertypes();
// $db->insert_users();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])){

  	
    $voornaam = htmlspecialchars(trim($_POST['voornaam']));
    $achternaam = htmlspecialchars(trim($_POST['achternaam']));
    $email = htmlspecialchars(trim($_POST['email']));
    $wachtwoord = htmlspecialchars(trim($_POST['wachtwoord']));
    $hhwachtwoord = htmlspecialchars(trim($_POST['hhwachtwoord']));

    if ($wachtwoord !== $hhwachtwoord) {

    	echo "Password do not match, please try again";

    }else{

    	$db = new database();

    	$db->signup_user($voornaam, $achternaam, $email, $wachtwoord);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php $page = 'signup'; include'header/startup.php'; ?>
    <div style="padding: 15px;">
    	<form method="post">
            <h3>Signup</h3> 

            <label>Voornaam:</label><br> 
    		<input required type="text" name="voornaam"><br> 

            <label>Achternaam:</label><br> 
            <input required type="text" name="achternaam"><br> 

            <label>Email:</label><br>
            <input required type="email" name="email"><br>
            
            <label>Password:</label><br>
    		<input required type="password" name="wachtwoord"><br>

    		<label>Repeat password:</label><br>
    		<input required type="password" name="hhwachtwoord"><br>
                   
            <button class="submit" type="submit" name="signup">Signup</button><br>

            <a href="login.php"><button class="button" type="button">Login</button></a>
        </form>
    </div>    
</body>
</html>