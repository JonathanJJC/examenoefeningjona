<?php 
echo "<header>";
    echo "<ul>";
        echo "<li style=float:left;><img style=width:70px;padding:5px; src=https://www.lowes.com/images/logos/2016_lowes_logo/lowes_logo_white/lowes_logo_white.png></li>";
        echo "<li class=".($page=='signup'? "active":"")."><a href=signup.php>Registreren</a></li>";
        echo "<li class=".($page=='login'? "active":"")."><a href=login.php>Login</a></li>";
    echo "</ul>";
echo "</header>"; 
?>