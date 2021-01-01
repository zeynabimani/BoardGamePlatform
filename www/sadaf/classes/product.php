<?php
/**
 * Created by PhpStorm.
 * User: Milanifard.O
 * Date: 12/6/2020
 * Time: 9:24 PM
 */

class product
{
    public $ProductID;
    public $name;
    public $amount;

    public function __construct($ProductID = 0, $name = "", $amount = 0)
    {
        $this->ProductID = $ProductID;
        $this->name = $name;
        $this->amount = $amount;
    }

    public function LoadFromDB($ProductID)
    {
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from sadaf.products where ProductID=?");
        $res = $mysql->ExecuteStatement(array($ProductID));
        if($rec = $res->fetch())
        {
            $this->ProductID = $rec["ProductID"];
            $this->name = $rec["name"];
        }
        else
            $this->ProductID=-1;
    }

    public function SetAmount($amount)
    {
        $mysql = pdodb::getInstance();
        $mysql->Execute("delete from productamount where ProductID=".$this->ProductID);
        $mysql->Prepare("insert into productamount (ProductID, amount) values (?, ?)");
        $mysql->ExecuteStatement(array($this->ProductID, $amount));
    }

    public function GetAmount()
    {
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select amount from productamount where ProductID=?");
        $res = $mysql->ExecuteStatement(array($this->ProductID));
        if($rec = $res->fetch())
        {
            return $rec["amount"];
        }
        return 0;
    }
}

class manage_products
{
    public static function Add($name)
    {
        $mysql = pdodb::getInstance();
        $query = "insert into sadaf.products (name) values (?)";
        $mysql->Prepare($query);
        $mysql->ExecuteStatement(array($name));
    }

    public static function Remove($ProductID)
    {
        $mysql = pdodb::getInstance();
        $query = "delete from sadaf.products where ProductID=?";
        $mysql->Prepare($query);
        $mysql->ExecuteStatement(array($ProductID));
    }

    public static function Update($UpdateID, $name)
    {
        $mysql = pdodb::getInstance();
        $query = "update sadaf.products set name=? where ProductID=?";
        $mysql->Prepare($query);
        $mysql->ExecuteStatement(array($name, $UpdateID));
    }

    public static function GetList($FromRec=-1, $ItemsCount=-1)
    {
        if(!is_numeric($FromRec))
            $FromRec = 0;
        if(!is_numeric($ItemsCount))
            $ItemsCount = 10;
        $ret = array();
        $mysql = pdodb::getInstance();
        if($FromRec>-1)
            $query = "select * from sadaf.products order by ProductID DESC limit $FromRec, $ItemsCount";
        else
            $query = "select * from sadaf.products order by ProductID DESC ";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        while($rec = $res->fetch())
        {
            $obj = new product($rec["ProductID"], $rec["name"]);
            array_push($ret, $obj);
        }
        return $ret;
    }

    public static function GetExistProducts()
    {
        $ret = array();
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.productamount JOIN sadaf.products using (ProductID) order by ProductID DESC ";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        while($rec = $res->fetch())
        {
            $obj = new product($rec["ProductID"], $rec["name"], $rec["amount"]);
            array_push($ret, $obj);
        }
        return $ret;

    }

    public  static function GetOptionList()
    {
        $ret = "<option value=0>-</option>";
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.products order by ProductID DESC ";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        while($rec = $res->fetch())
        {
            $ret .= "<option value='".$rec["ProductID"]."'>".$rec["name"]."</option>";
        }
        return $ret;

    }

    public static function GetCount()
    {
        $mysql = pdodb::getInstance();
        $query = "select count(*) as tcount from sadaf.products";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        $rec = $res->fetch();
        return $rec["tcount"];
    }
}

