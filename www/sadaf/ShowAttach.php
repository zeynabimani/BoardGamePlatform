<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/17/2020
 * Time: 2:13 PM
 */
include "header.inc.php";
header("Content-Type: image/jpeg");

$mysql->Prepare("select * from sadaf.warehousedoc where WarehouseDocID=?");

$res = $mysql->ExecuteStatement(array($_REQUEST["DocID"]));
$rec = $res->fetch();

header("Content-Disposition: ; filename=".$rec["AttachFileName"]);
echo readfile("d:\\UploadFile\\".$rec["AttachFileName"]);

