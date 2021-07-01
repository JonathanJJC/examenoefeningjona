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
    	echo 'U bent niet gemachtigd om deze pagina te bekijken, u word nu verwezen naar de home pagina';

    	 header("refresh:3;url=welcome.php");
    	 exit;
    	
    }else{
    	$message = 'hallo user, ' . $_SESSION['username'];
    }

?>