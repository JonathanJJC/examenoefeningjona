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

    $signup = $db->signup_user($voornaam, $achternaam, $email, $wachtwoord);
  }
}

?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button">One new friend request</a>
      <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
      <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
    </div>
  </div>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    <img src="/w3images/avatar2.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Kwanta</h4>
         <p class="w3-center"><img src="./image/social.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>Museumstraat 1, 1071 XX Amsterdam</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> Opgericht: 1800</p>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>020 674 7000</p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->

      <div class="w3-card w3-round"></div>

      <!-- Interests --> 

      <div class="w3-card w3-round w3-white w3-hide-small"></div>

      <!-- Alert Box -->

      <div style="height:235px;"></div>
    
    <!-- End Left Column -->

    </div>

    <!-- Middle Column -->

    <div class="w3-col m7">
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
                <form method="POST">
                  <h6>Signup</h6>

                  <p><span ><?php echo ((isset($signup) && $signup != '') ? $signup ."<br>" : '')?></span></p>

                  <label>Voornaam:</label>
                  <p><input required type="text" name="voornaam" class="w3-border w3-padding" style="width:100%;"></p>

                  <label>Achternaam:</label><br> 
                  <p><input required type="text" name="achternaam" class="w3-border w3-padding" style="width:100%;"></p> 

                  <label>Email:</label>
                  <p><input required type="email" name="email" class="w3-border w3-padding" style="width:100%;"></p>

                  <label>Password:</label><br>
                  <p><input required type="password" name="wachtwoord" class="w3-border w3-padding" style="width:100%;"></p>

                  <label>Repeat password:</label><br>
                  <p><input required type="password" name="hhwachtwoord" class="w3-border w3-padding" style="width:100%;"></p>
      
                  <button type="submit" name="signup" class="w3-button w3-theme"><i class="fa fa-pencil"></i> ??Signup</button>
                  <a href="logintest.php"><button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i> ??Login</button></a>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Middle Column -->
    
    
    <!-- Right Column -->

    <div class="w3-col m2"></div>
      
    <!-- End Right Column -->

    </div>
    
  <!-- End Grid -->

  </div>
  
<!-- End Page Container -->

</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
