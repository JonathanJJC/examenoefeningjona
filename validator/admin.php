<?php  
session_start();

if(isset($_SESSION['email']) && $_SESSION['email'] == true){

    $_SESSION['loggedin'] = true;
    // echo $_SESSION['id'];
}else{
    echo "<link rel=stylesheet type=text/css href=style.css>";
    $page = 'default'; include'header/startup.php';
    echo "<h3 class=error>U bent niet ingelogd, u word nu verwezen naar de inlog pagina</h3>";
    header("refresh:3;url=login.php");
         exit;
}

    if ($_SESSION['is_admin'] == 1) {
    	$message = 'hallo admin, ' . $_SESSION['username'];
    	
    }else{
    	echo '<h1>U bent niet gemachtig voor deze pagina, u word nu verwezen naar de inlog pagina</h1>';

    header("refresh:3;url=index.php");
    exit;
    }

?>