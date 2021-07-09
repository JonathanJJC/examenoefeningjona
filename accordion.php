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