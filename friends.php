<?php 
include 'database.php';
include 'validator/both.php';

$id = $_SESSION['id'];

$db = new database();

if (isset($_POST['accept'])) {

  $vriend_A = $_GET['id'];
  $vriend_B = $id;

  $db->accept_vriend($vriend_A, $vriend_B);
}

if (isset($_POST['decline'])) {

  $vriend_A = $_GET['id'];
  $vriend_B = $id;
  $db->decline_vriend($vriend_A, $vriend_B);
}

$vrienden = $db->select("SELECT vrienden.vriend_A, vrienden.Vriend_B, gebruiker.voornaam, gebruiker.achternaam, image.Filename, vrienden.is_bevestigd
FROM vrienden 
LEFT JOIN gebruiker
ON vrienden.vriend_A = gebruiker.id
LEFT JOIN image 
ON vrienden.vriend_A = image.id
WHERE vrienden.vriend_B = :id AND vrienden.is_bevestigd = FALSE",[':id' => $id]);

$row_data_vrienden = array_values($vrienden);
foreach ($row_data_vrienden as $data_vrieden){}

$vrienden_confirmed = $db->select("SELECT vrienden.vriend_A, vrienden.Vriend_B, gebruiker.voornaam, gebruiker.achternaam, image.Filename, vrienden.is_bevestigd
FROM vrienden 
LEFT JOIN gebruiker
ON vrienden.vriend_A = gebruiker.id
LEFT JOIN image 
ON vrienden.vriend_A = image.id
WHERE vrienden.vriend_B = :id AND vrienden.is_bevestigd = TRUE",[':id' => $id]);

$row_data_vrienden_confirmed = array_values($vrienden_confirmed);
foreach ($row_data_vrienden_confirmed as $data_vrieden_confirmed){}

$profile = $db->select("SELECT gebruiker.id, gebruiker.voornaam, gebruiker.achternaam, gebruiker.email, gebruiker.created_at, image.Filename, groep.naam, post.inhoud, groepsleden.lid_id
  FROM gebruiker
  LEFT JOIN image
  ON gebruiker.id = image.id 
  LEFT JOIN post
  ON gebruiker.id = post.poster_id 
  LEFT JOIN groepsleden
  ON gebruiker.id = groepsleden.lid_id
  LEFT JOIN groep
  ON groepsleden.groeps_id = groep.id
  WHERE gebruiker.id = :id", [':id' => $id]);

$columns = array_keys($profile[0]);  
$row_data = array_values($profile);

foreach ($row_data as $data) {}

$followers = $db->select("SELECT post.id ,post.poster_id, post.inhoud, gebruiker.voornaam, gebruiker.achternaam, image.Filename 
  FROM post 
  left JOIN gebruiker ON post.poster_id = gebruiker.id
  left JOIN image
  ON post.poster_id = image.id
  WHERE gebruiker.id = :id", [':id' => $id]);

$row_data_followers = array_values($followers);

foreach ($row_data_followers as $data_follower){}

$deletecheck =  $data_follower['poster_id'];

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
   <a href="logout.php"><button type=button class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" style="background-color:indianred;color:white;"><i class="fa fa-sign-out"></i>  Logout</button></a>

  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
   <img src="image/<?php echo $data["Filename"];?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
   <?php echo $data["voornaam"], " ", $data["achternaam"]?>
  </a>
 </div>
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
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center"><img src="image/<?php echo $data["Filename"];?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i><?php echo $data["voornaam"], " ", $data["achternaam"]?></p>
         <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i><?php echo $data["email"]?></p>
         <p><i class="fa fa-calendar fa-fw w3-margin-right w3-text-theme"></i>Lid sinds: <?php echo $data["created_at"]?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p><?php  echo $data["naam"]?></p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
          
          <?php
            foreach ($row_data as $data) { 
              echo "<div class=\"w3-half\">";
              echo "<img src=image/$data[inhoud] style=width:100% class=\"w3-margin-bottom\">";
              echo "</div>";
            }
            ?>
            
          </div>
        </div>
      </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Interests</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
          </p>
        </div>
      </div>
      <br>
      
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6>Friends:</h6>
              <!-- <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p> -->
            </div>
          </div>
        </div>
      </div>

      <?php
        foreach ($row_data_vrienden_confirmed as $data_vrienden_confirmed) {

          echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>";

          if ($data_vrienden_confirmed["Filename"] == NULL) {

            echo "<img src=image/default.png alt=Avatar class=\"w3-left w3-circle w3-margin-right\" style=width:60px;height:60px;>";

          }else{

            echo "<img src=image/$data_follower[Filename] alt=Avatar class=\"w3-left w3-circle w3-margin-right\" style=width:60px;height:60px;>";
          }

          echo "<h4>".$data_vrienden_confirmed["voornaam"], " ", $data_vrienden_confirmed["achternaam"]."</h4><br>";
          echo "<form action=friends.php?id=$data_vrienden_confirmed[vriend_A] method=post>"; 
          echo "<a href=user_user_page.php?id=$data_vrienden_confirmed[vriend_A]><button  type=button class=\"w3-button w3-theme-d1 w3-margin-bottom\"><i class=\"fa fa-paper-plane\"></i>  View</button></a>";
          echo "<button name=decline type=submit class=\"w3-button w3-margin-bottom\" style=background-color:indianred;color:white;><i class=\"fa fa-trash\"></i>  Delete friend</button>";   
          echo "</form>";
          
          echo "</div>";
        }
        
    ?>
       
      <!-- <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

        <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">16 min</span>
        <h4>Jane Doe</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>  

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar6.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">32 min</span>
        <h4>Angie Jane</h4><br>
        <hr class="w3-clear">
        <p>Have you seen this?</p>
        <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>  -->
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>

      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friends:</p>
          <?php  
            foreach ($row_data_vrienden_confirmed as $data_vrienden_confirmed) {}
              if ($data_vrienden_confirmed["Filename"] == NULL) {
                echo "<img src=image/default.png alt=\"Avatar\" style=\"width:50%\"><br>";
              }else{
                echo "<img src=image/$data_follower[Filename] alt=\"Avatar\" style=\"width:50%\"><br>";
              }  
                echo "<span>".$data_vrienden_confirmed["voornaam"]." ".$data_vrienden_confirmed["achternaam"]."</span>";
                echo "<div class=\"w3-row w3-opacity\">";
                echo "</div>";
                //}
          ?>
          <p><a href="friends.php"><button class="w3-button w3-block w3-theme-l4">See all</button></a></p>
        </div>
      </div>
      <br>

      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          
          <?php  
            foreach ($row_data_vrienden as $data_vrienden) {
              if ($data_vrienden["Filename"] == NULL) {
                echo "<img src=image/default.png alt=\"Avatar\" style=\"width:50%\"><br>";
              }else{
                echo "<img src=image/$data_follower[Filename] alt=\"Avatar\" style=\"width:50%\"><br>";
              }
              
              echo "<span>".$data_vrienden["voornaam"]." ".$data_vrienden["achternaam"]."</span>";
              echo "<div class=\"w3-row w3-opacity\">";
              echo "<form action=user_page.php?id=$data_vrienden[vriend_A] method=post>";
                echo "<div class=\"w3-half\">";
                echo "<button name=\"accept\" class=\"w3-button w3-block w3-green w3-section\" title=\"Accept\"><i class=\"fa fa-check\"></i></button>";
                echo "</div>";
                echo "<div class=\"w3-half\">";
                echo "<button name=\"decline\" class=\"w3-button w3-block w3-red w3-section\" title=\"Decline\"><i class=\"fa fa-remove\"></i></button>";
                echo "</div>";
              echo "</form>";
          echo "</div>";
                }
          ?>
          <!-- <div class="w3-row w3-opacity">
              <form>
                <div class="w3-half">
                <button name="accept" class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                </div>
                <div class="w3-half">
                <button name="decline" class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                </div>
              </form>
          </div> -->
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      
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
