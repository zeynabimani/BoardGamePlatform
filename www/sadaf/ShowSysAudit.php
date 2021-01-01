<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/4/2020
 * Time: 3:38 PM
 */
ini_set("error_reporting", E_ALL & ~E_STRICT);
include "header.inc.php";

HTMLBegin();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
    <form method="post">
        <input type="hidden" name="DeletePart" value="1">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th width="1%">ردیف</th>
                    <th>کاربر</th>
                    <th>زمان</th>
                    <th>IP</th>
                    <th>عمل</th>
                </tr>
                </thead>
                <?php
                $query = "select * from SysAudit ";
                $res = $mysql->Execute($query);
                $row = 0;
                while($rec = $res->fetch())
                {
                    $row++;
                    echo "<tr>";
                    echo "<td>".$row."</td>";

                    echo "<td>".htmlentities($rec["UserID"], ENT_QUOTES, "UTF-8")."</td>";
                    echo "<td>".htmlentities($rec["ATS"], ENT_QUOTES, "UTF-8")."</td>";

                    echo "<td>".htmlentities($rec["IPAddress"], ENT_QUOTES, "UTF-8")."</td>";
                    echo "<td>".htmlentities($rec["ActionDesc"], ENT_QUOTES, "UTF-8")."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
    </form>
        </div>
    </div>
</div>
</body>
</html>
