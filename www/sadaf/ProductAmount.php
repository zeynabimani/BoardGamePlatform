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
HTMLBegin();

if(isset($_REQUEST["Save"]))
{
    $obj = new product();
    $obj->LoadFromDB($_REQUEST["ProductID"]);
    $obj->SetAmount($_REQUEST["amount"]);
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
    <form method="POST" autocomplete="off">
        <table class="table table-sm table-bordered">
            <tr>
                <td>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>نام کالا</td>
                            <td>
                                <select name="ProductID" id="ProductID">
                                    <?php echo manage_products::GetOptionList(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>موجودی</td>
                            <td>
                                <input type="text" name="amount" id="amount">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="btn btn-sm btn-primary" type="submit" name="Save" id="Save" value="ذخیره">
                </td>
            </tr>

        </table>
    </form>
    <form method="post">
        <input type="hidden" name="DeletePart" value="1">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th width="1%">ردیف</th>
                    <th>نام کالا</th>
                    <th>موجودی</th>
                </tr>
                </thead>
                <?php
                $list = manage_products::GetExistProducts();
                $row = 0;
                for($i=0; $i<count($list); $i++)
                {
                    $row++;
                    echo "<tr>";
                    echo "<td>".$row."</td>";
                    echo "<td>".htmlentities($list[$i]->name, ENT_QUOTES, "UTF-8")."</td>";
                    echo "<td>".htmlentities($list[$i]->amount, ENT_QUOTES, "UTF-8")."</td>";
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
