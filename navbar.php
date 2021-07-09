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
      <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>

    </div>
  </div>
  <a href="logout.php"><button type=button class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" style="background-color:indianred;color:white;"><i class="fa fa-sign-out"></i>  Logout</button></a>
  <a href="user_page.php?id=<?php echo $id ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    
    <?php  if ($data["Filename"] == NULL) {
                echo "<img src=image/default.png class=\"w3-circle\" style=\"height:23px;width:23px\" alt=\"Avatar\">";
              }else{
                echo "<img src=image/$data[Filename] class=\"w3-circle\" style=\"height:23px;width:23px\" alt=\"Avatar\">";
              }?>
   <?php echo $_SESSION["voornaam"], " ", $_SESSION["achternaam"]?>
  </a>

 </div>
</div>