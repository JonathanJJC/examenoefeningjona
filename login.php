<?php 
//Connect met database.php
include 'database.php';

$db = new database();
// $db->insert_usertypes();
// $db->insert_users();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

    $email = htmlspecialchars(trim($_POST['email']));
    $wachtwoord = htmlspecialchars(trim($_POST['wachtwoord']));

    $db = new database();

   $login =  $db->login($email, $wachtwoord);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php $page = 'login'; include'header/startup.php'; ?>
    <div>
        
    	<form method="post">
            <h3>Login</h3> 
            <span><?php echo ((isset($login) && $login != '') ? $login ."<br>" : '')?></span>
            <label>Email:</label><br> 
    		<input required type="text" name="email"><br> 

            <label>Password:</label><br>
    		<input required type="password" name="wachtwoord"><br>
                   
            <button class="submit" type="submit" name="login">Login</button>

            <a href="signup.php"><button class="button" type="button">Signup</button></a>
        </form>
    </div>    
</body>
</html>