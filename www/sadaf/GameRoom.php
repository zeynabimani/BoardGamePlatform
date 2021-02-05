<?php
    include "header.inc.php";
    include "classes/SystemFacilities.class.php";

    HTMLBegin();
      
    ?>
    <?php
     function isRoomManager(){
        $isManager=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.room where roomID = " . $_SESSION["id"];
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
           if($_SESSION["PersonID"]===$rec["managerID"]){
            
              $isManager=1;
               
    
          }
       }
        
        return $isManager;
    }
    ?>


<form method="POST" >
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
 
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Send Invitation to your Freinds</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
          <button type="button" class="btn btn-success btn-sm">ssss</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>          
  
</div>   
</form>
   
    </body>
    </html>