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
    function getPersons(){
        $results= array();
        $persons=array();
        $i=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.game where roomID = " . $_SESSION["id"];
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
         $copypersons=$persons;
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
        for($j=0;$j<count($persons);$j++){
            $is_recognize=false;
           if($persons[$j][0]===$rec["userID"]&& $is_recognize==false){
            unset($copypersons[$j]);
            $is_recognize=true;
               
    
          }
       }
    }
    $copypersons=array_values($copypersons);
    $results=$copypersons;
    $stOptions="";
    for($p=0;$p<count($results);$p++){
        $stOptions.="<option value='".$results[$p][1]."'>";
        $stOptions.=$results[$p][1];
        $stOptions.="</option>";

    }
    return $stOptions;
    }


    ?>
    <?php
     function addtoDataBase($v){
        $isManager=0;
        $i=0;
        $persons=array();
        $mysql = pdodb::getInstance();
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
        for($s=0;$s<count($persons);$s++){
            if($persons[$s][1]===$v){
                $idNew=$persons[$s][0];
            }
        }
        $query = "insert into sadaf.game_request (roomID, userID, status)
        values (".$_SESSION["id"].",".$idNew.", 'Waiting');";
        $mysql->Execute($query); 
       echo "pppppp";
        
    }
    
      
    ?>
    <?php
    if(isset($_REQUEST["Users"])&&isset($_REQUEST["ersal"])){
        addtoDataBase($_REQUEST["Users"]);
    }
    
    ?>


<form method="POST" >
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <?php
  $isManager=isRoomManager();
  if($isManager===1){
      echo "1";
     echo " <button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">Send Invitation to your Freinds</button>" ;
  }
  elseif($isManager===0){
      echo "2";
      $disabled="disabled";
    echo " <button type=\"button\" class=\"btn btn-success btn-sm\"".$disabled.">Send Invitation to your Freinds</button>" ;

  }
  ?>
 
 <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Send Invitation to your Freinds</button>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header align-right DivRtl">
         <h4 class="modal-title ">ارسال دعوت نامه</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <div class="row">
		<div class="col">
          <p> انتخاب لیست کاربران</p>
          <hr>
          <table class="table table-sm table-stripped table-bordered">
          <tr>
					
			<td>
            <select class="form-control sadaf-m-input" name="Users" id="Persons">
            <option value=0>-
            <? echo getPersons();?>
           
        </td>
        <td>
        <input type="submit" name="ersal" class="btn btn-primary" value="Send">
        </td>
        </tr>
        </select>
          </table>
        </div>
        </div>
        </div>
        <div class="modal-footer DivRtl">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>          
  
</div>   
</form>

   
    </body>
    </html>