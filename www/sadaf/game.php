<?php
include "header.inc.php";
HTMLBegin();

if(isset($_REQUEST["EnterRoom"])){
    $mysql = pdodb::getInstance();
    $query = "select * from sadaf.room where roomID < 100";
    $res = $mysql->Execute($query);
    while($rec = $res->fetch()){
        $ChGameID = "ch_" . $rec["roomID"]; 
        if(isset($_REQUEST[$ChGameID])){
            $query = "update sadaf.room set managerID = " . $_SESSION["PersonID"] . " where roomID= " . $rec["roomID"];
            $res = $mysql->Execute($query);
        }
    }
}

?>

<form method="POST">
    <input type="hidden" name="EnterRoom" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <th>شماره اتاق</th>
            <th>نام مدیر</th> 
            <th>وضعیت</th> 
            <th>ورود</th>
        </tr>
    <?php
        ini_set("error_reporting", E_All);
        
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.room where roomID < 100";
        $res = $mysql->Execute($query);
        while($rec = $res->fetch()){
            
            echo  "<tr><td>" . $rec["roomID"] . "</td>";
            if($rec["managerID"] == ""){
                $disabled = "";
                echo  "<td>ندارد</td>";
            }
            else{
                $disabled = "disabled";
                echo  "<td>" . $rec["managerID"] . "</td>";
            }
            echo  "<td>" . $rec["status"] . "</td>";
            $ChGameID = "ch_" . $rec["roomID"]; 
            echo "<td><input type=\"submit\" class=\"btn btn-success btn-sm\" name=\"" .  $ChGameID . "\" value=\"ورود\"" . $disabled . "></td></tr>";
        }
    ?>
    </table>
</form>

</body>
</html>