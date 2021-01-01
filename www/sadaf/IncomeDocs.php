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
include "classes/WarehouseDoc.php";
HTMLBegin();

if(isset($_REQUEST["Save"]))
{
    $FileName = $FileContent = "";
    if(isset($_FILES["AttachFile"]) && $_FILES["AttachFile"]["name"]!="")
    {
        if($_FILES["AttachFile"]["error"]!="0")
        {
            echo "Error: ".$_FILES["AttachFile"]["error"];
            die();
        }
        //$FileContent = file_get_contents($_FILES["AttachFile"]["tmp_name"]);
        $FileName = $_FILES["AttachFile"]["name"];
        $_size = $_FILES["AttachFile"]["size"];
        $ext = pathinfo($FileName, PATHINFO_EXTENSION);
        if($ext=="jpg" || $ext=="jpeg")
            move_uploaded_file($_FILES["AttachFile"]["tmp_name"], "d:\\UploadFile\\".$FileName);
        else
        {
            echo "Invalid File type!";
            die();
        }
    }

    manage_IncomeDoc::Add($_REQUEST["DocDate"], $_REQUEST["description"], $_REQUEST["supplier"], $FileName, $FileContent);

}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
    <form method="POST" autocomplete="off" enctype="multipart/form-data">
        <table class="table table-sm table-bordered">
            <tr>
                <td>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>تاریخ</td>
                            <td>
                                <input type="date" id="DocDate" name="DocDate">
                            </td>
                        </tr>
                        <tr>
                            <td>شرح</td>
                            <td>
                                <input type="text" name="description" id="description">
                            </td>
                        </tr>
                        <tr>
                            <td>تامین کننده</td>
                            <td>
                                <input type="text" name="supplier" id="supplier">
                            </td>
                        </tr>
                        <tr>
                            <td>فایل پیوست</td>
                            <td>
                                <input type="file" name="AttachFile" id="AttachFile">
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
                        <th width="1%">کد</th>
                        <th>تاریخ</th>
                        <th>تامین کننده</th>
                        <th>پیوست</th>
                    </tr>
                    </thead>
                    <?php
                    $list = manage_IncomeDoc::GetList();
                    $row = 0;
                    for($i=0; $i<count($list); $i++)
                    {
                        $row++;
                        echo "<tr>";
                        echo "<td>".$list[$i]->WarehouseDocID."</td>";
                        echo "<td>".htmlentities($list[$i]->DocDate, ENT_QUOTES, "UTF-8")."</td>";
                        echo "<td>".htmlentities($list[$i]->RelatedPersonCompany, ENT_QUOTES, "UTF-8")."</td>";
                        echo "<td><a href='ShowAttach.php?DocID=".$list[$i]->WarehouseDocID."'>پیوست</a>";
                        echo " / ";
                        echo "<a href='UploadFile/".$list[$i]->AttachFileName."'>نمایش</a>";
                        echo "</td>";
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
