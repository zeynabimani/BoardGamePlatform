<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/17/2020
 * Time: 2:13 PM
 */
include "header.inc.php";
include "classes\product.php";
HTMLBegin();
if(isset($_REQUEST["Upload"]))
{
    if(isset($_FILES["ImportFile"]) && $_FILES["ImportFile"]["name"]!="")
    {
        if($_FILES["ImportFile"]["error"]!="0")
        {
            echo "Error: ".$_FILES["ImportFile"]["error"];
            die();
        }
        //$FileContent = file_get_contents($_FILES["ImportFile"]["tmp_name"]);
        //echo $FileContent;

        $myfile = fopen($_FILES["ImportFile"]["tmp_name"], "r");
        while(!feof($myfile))
        {
            $ProductName = fgets($myfile);
            echo $ProductName . "<br>";
            manage_products::Add($ProductName);
        }
        fclose($myfile);

    }

}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <table class="table table-sm table-bordered">
                <tr>
                    <td>
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" name="ImportFile" id="ImportFile">
                            <input type="submit" name="Upload" id="Upload" value="Upload">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>