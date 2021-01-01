<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/9/2020
 * Time: 4:36 PM
 */

class WarehouseDoc
{
    public $WarehouseDocID;
    public $DocDate;
    public $description;
    public $DocType;
    public $RelatedPersonCompany;
    public $AttachFileName;

    public function __construct($WarehouseDocID = 0)
    {
        if($WarehouseDocID>0)
        {
            $mysql = pdodb::getInstance();
            $mysql->Prepare("select * from sadaf.warehousedoc where WarehouseDocID=?");
            $res = $mysql->ExecuteStatement(array($WarehouseDocID));
            if($rec = $res->fetch()) {
                $this->DocDate = $rec["DocDate"];
                $this->description = $rec["description"];
                $this->DocType = $rec["DocType"];
                $this->RelatedPersonCompany = $rec["RelatedPersonCompany"];
                $this->WarehouseDocID = $rec["WarehouseDocID"];
            }
        }
        else {
            $this->DocDate = "";
            $this->description = "";
            $this->DocType = "IN";
        }

    }
}

class manage_WarehouseDoc
{
    public static function Add($DocDate, $description, $RelatedPersonComapy, $DocType, $FileName, $FileContent)
    {
        $mysql = pdodb::getInstance();
        $query = "insert into sadaf.warehousedoc (DocDate, description, RelatedPersonCompany, DocType, AttachFileName, AttachFileContent) values (?,?,?, ?, ?, ?)";
        $mysql->Prepare($query);
        $mysql->ExecuteStatement(array($DocDate, $description, $RelatedPersonComapy, $DocType, $FileName, $FileContent));
    }

}

class manage_IncomeDoc extends manage_WarehouseDoc
{
    public static function Add($DocDate, $description, $supplier, $FileName, $FileContent)
    {
        parent::Add($DocDate, $description, $supplier, "IN", $FileName, $FileContent);
        // ...
    }

    public static function GetList()
    {
        $ret = array();
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.warehousedoc where DocType='IN'";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        while($rec = $res->fetch())
        {
            $obj = new WarehouseDoc();
            $obj->DocDate = $rec["DocDate"];
            $obj->description = $rec["description"];
            $obj->RelatedPersonCompany = $rec["RelatedPersonCompany"];
            $obj->DocType = $rec["DocType"];
            $obj->WarehouseDocID = $rec["WarehouseDocID"];
            $obj->AttachFileName = $rec["AttachFileName"];
            array_push($ret, $obj);
        }
        return $ret;
    }

}

class IncomeDoc extends WarehouseDoc
{
    public function __construct($WarehouseDocID = 0)
    {
        parent::__construct($WarehouseDocID);
        $this->supplier = $this->RelatedPersonCompany;

    }

    public $supplier;
}

class OutDoc extends WarehouseDoc
{
    public function __construct($WarehouseDocID = 0)
    {
        parent::__construct($WarehouseDocID);
        $this->customer = $this->RelatedPersonCompany;
    }

    public $customer;
}