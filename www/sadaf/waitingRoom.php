<?php
include "header.inc.php";
HTMLBegin();

if(isset($_REQUEST["EnterWaitingRoom"])){
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.room where roomID < 100";
    $res = $mysql->Execute($query);
    while($rec = $res->fetch()){
        $ChGameID = "ch_" . $rec["roomID"]; 
        if(isset($_REQUEST[$ChGameID]) && $rec["managerID"] == ""){            
            $query = "update sadaf.room set managerID = " . $_SESSION["PersonID"] . " where roomID= " . $rec["roomID"];
            $res = $mysql->Execute($query);

            $query2 = "insert into sadaf.game (roomID, userID) values (?,?)";
            $mysql->Prepare($query2);
            $mysql->ExecuteStatement(array($rec["roomID"], $_SESSION["PersonID"]));
        }
    }
}
?>
<?php
function getWaitingPeople(){
    $results=array();
    $i=0;
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.accountspecs";
    $query2 = "select * from sadaf.game";
    $res = $mysql->Execute($query);
    $res2 = $mysql->Execute($query2);
    while($rec = $res->fetch()){
        while($rec2 = $res2->fetch()){
            if($rec[PersonID]===$rec2[userID]){
                $results[$i]=array($rec[UserID],$rec[PersonID]);
                $i=$i+1;
            }

        }
       
    }
  return $results; 
}
?>
<form method="POST">
    <input type="hidden" name="EnterWaitingRoom" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <th>نام کاربر</th> 
            <th>شماره کاربر</th>   
        </tr>
</form>
<?php
    $mysql = pdodb::getInstance();
    $query = "select PersonID from sadaf.accountspecs";
    $res = $mysql->Execute($query);