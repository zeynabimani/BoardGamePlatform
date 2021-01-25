<?php
include "header.inc.php";
HTMLBegin();



?>

<form method="POST">
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
            echo "<td><input type=\"buttom\" class=\"btn btn-success btn-sm\" name=\"enterRoom\" id=\"" .  $rec["roomID"] . "\" value=\"ورود\"" . $disabled . "></td></tr>";
        }
    ?>
    </table>
</form>

</body>
</html>