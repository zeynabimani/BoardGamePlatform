<?php
include "header.inc.php";
include "gameClasses/Player.php";
//include "JsFile.js";

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

            $query2 = "insert into sadaf.game (roomID, userID) values (?,?)";
            $mysql->Prepare($query2);
            $mysql->ExecuteStatement(array($rec["roomID"], $_SESSION["PersonID"]));
        }
    }
}
$bankRedTokens = 7;
$bankBlueTokens = 7;
$bankGreenTokens = 7;
$bankWhiteTokens = 7;
$bankBrownTokens = 7;
$bankGoldenTokens = 5;

$turn =0;

$players= array();
ini_set("error_reporting", E_All);
$mysql = pdodb::getInstance();
$query = "SELECT userID FROM sadaf.game where roomID=?;";
$mysql->Prepare($query);
// which room we choose (fatemeh bayad bezane)
$res = $mysql->ExecuteStatement(array(1));
while($rec = $res->fetch()){

//            echo  "<tr><td>" . $rec["userID"] . "</td>";
    array_push($players, new Player($rec["userID"]));

}

if(array_key_exists('select1', $_POST)){
    function1($players);
}

function function1($array)
{
    if(isset($_POST['red'])){
        echo $array[0];
    }
}

?>

<script src="JsFile.js"></script>

<form method="POST">
    <input type="hidden" name="EnterRoom" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <td>انتخاب 3 توکن از 3 رنگ مختلف</td>
            <td>انتخاب 2 توکن همرنگ</td>
            <td>رزرو یک کارت پیشرفت و دریافت ۱ توکن طلا</td>
            <td>خرید یکی از کارت‌های وسط میز</td>
            <td>خرید یکی از کارت‌هایی که رزرو کرده</td>
        </tr>
        <tr>
            <td>
                <table >
                    <tr>
                        <td>red token</td>
                        <td><input type="checkbox" name="red" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>blue token</td>
                        <td><input type="checkbox" name="blue" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>green token</td>
                        <td><input type="checkbox" name="green"onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>brown token</td>
                        <td><input type="checkbox" name="brown" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>white token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table >
                    <tr>
                        <td>red token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>blue token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>green token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>brown token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>white token</td>
                        <td><input type="checkbox"></td>
                    </tr>
                </table>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><button name="select1">انتخاب 1</button></td>
            <td><button>انتخاب 2</button></td>
            <td><button>انتخاب 3</button></td>
            <td><button>انتخاب 4</button></td>
            <td><button>انتخاب 5</button></td>
        </tr>
        <?php


        ?>
    </table>
</form>
