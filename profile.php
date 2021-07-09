<!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         <p class="w3-center">
          <?php  if ($data["Filename"] == NULL) {
                echo "<a href=user_page.php?id=$data[id]><img src=image/default.png class=\"w3-circle\" style=\"height:106px;width:106px;\" alt=Avatar></a><br>";
              }else{
                echo "<a href=user_page.php?id=$data[id]><img src=image/$data[Filename] class=\"w3-circle\" style=\"height:106px;width:106px;border:5px solid #F5F7F8;\" alt=Avatar></a><br>";
              }?>
          </p>
         <hr>
         <p><i class="fa fa-address-card fa-fw w3-margin-right w3-text-theme"></i><?php echo $data["voornaam"], " ", $data["achternaam"]?></p>
         <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i><?php echo $data["email"]?></p>
         <p><i class="fa fa-calendar fa-fw w3-margin-right w3-text-theme"></i>Lid sinds: <?php echo $data["created_at"]?></p>
        </div>
      </div>
      <br>
