<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/4/2020
 * Time: 3:38 PM
 */
ini_set("error_reporting", E_ALL & ~E_STRICT);
include "header.inc.php";
include "classes/product.php";

if(isset($_REQUEST["Export"]))
{
    header("Content-Disposition: attachment; filename=product.txt");
    $list = manage_products::GetList(0, 1000);

    for($i=0; $i<count($list); $i++) {
        echo $list[$i]->name."\r\n";
    }
    die();
}

$ItemsCount = 10;
$FromRec = 0;
if(isset($_REQUEST["FromRec"]))
{
    if(is_numeric($_REQUEST["FromRec"]))
        $FromRec = $_REQUEST["FromRec"];
}
HTMLBegin();
if(isset($_REQUEST["DeletePart"]))
{
    $list = manage_products::GetList();
    for($i=0; $i<count($list); $i++)
    {
        $CName = "ch_".$list[$i]->ProductID;
        if(isset($_REQUEST[$CName]))
        {
            manage_products::Remove($list[$i]->ProductID);
        }
    }
}

if(isset($_REQUEST["Save"]))
{
    if(isset($_REQUEST["UpdateID"]))
    {
        manage_products::Update($_REQUEST["UpdateID"], $_REQUEST["name"]);
    }
    else {
        manage_products::Add($_REQUEST["name"]);
    }
}

$CurrentName = "";
if(isset($_REQUEST["UpdateID"]))
{
    if(is_numeric($_REQUEST["UpdateID"]))
    {
       $UpdateID = $_REQUEST["UpdateID"];
    }
    else
    {
        echo "Wrong parameter!";
        die();
    }
    $obj = new product();
    $obj->LoadFromDB($UpdateID);
    if($obj->ProductID>0)
    {
        $CurrentName = $obj->name;
    }
    else
        {
            echo "Not found!";
        }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
    <form method="POST" autocomplete="off">
        <?php
            if(isset($_REQUEST["UpdateID"]))
            {
                echo "<input type=hidden name='UpadteID' id='UpdateID' value='".$_REQUEST["UpdateID"]."'>";
            }
        ?>
        <table class="table table-sm table-bordered">
            <tr>
                <td>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>نام کالا</td>
                            <td><input type="text" size=45 name="name" id="name" autocomplete="false" value="<?php echo $CurrentName ?>"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="btn btn-sm btn-secondary" type="button" name="NewBtn" id="NewBtn" onclick="javascript: document.location='ManageProducts.php'" value="جدید">
                    <input class="btn btn-sm btn-primary" type="submit" name="Save" id="Save" value="ذخیره">
                    <input class="btn btn-sm btn-success" type="button" name="Export" id="Export" value="Export" onclick="javascript: document.location='ManageProducts.php?Export=1';">
                </td>
            </tr>

        </table>
    </form>
    <form method="post">
        <input type="hidden" name="DeletePart" value="1">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th width="1%">&nbsp;</th>
                    <th width="1%">ردیف</th>
                    <th>نام کالا</th>
                </tr>
                </thead>
                <?php
                $list = manage_products::GetList($FromRec, $ItemsCount);
                $row = $FromRec;
                for($i=0; $i<count($list); $i++)
                {
                    $row++;
                    echo "<tr>";
                    echo "<td>";
                    $CName = "ch_".$list[$i]->ProductID;
                    echo "<input type=checkbox name='".$CName."' id='".$CName."'>";
                    echo "</td>";
                    $EditLink = "ManageProducts.php?UpdateID=".$list[$i]->ProductID;
                    $EditLink .= "&FromRec=".$FromRec;
                    echo "<td><a href='".$EditLink."'>".$row."</a></td>";
                    echo "<td>".htmlentities($list[$i]->name, ENT_QUOTES, "UTF-8")."</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3" class="text-center">
                        <input type="submit" value="حذف" class="btn btn-sm btn-danger">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                            $TotalCount = manage_products::GetCount();
                            for($p=1; $p<=ceil($TotalCount/$ItemsCount); $p++)
                            {
                                if(($p-1)*$ItemsCount!=$FromRec) {
                                    echo "<a href='ManageProducts.php?FromRec=" . (($p - 1) * $ItemsCount) . "'>";
                                    echo $p;
                                    echo "</a> ";
                                }
                                else
                                    echo "<b>".$p."</b> ";
                            }
                        ?>
                    </td>
                </tr>
            </table>
    </form>
        </div>
    </div>
</div>
</body>
</html>
