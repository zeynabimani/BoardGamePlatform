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
    if(isset($_POST['orange'])){
        echo $array[0];
    }
}

?>

<script src="JsFile.js"></script>

<form method="POST">
    <input type="hidden" name="EnterRoom" value="1">
    <table class="table table-sm table-bordered table-striped">
        <tr>
            <td>انتخاب ۳ الماس </td>
            <td>انتخاب ۲ الماس همرنگ</td>
            <td>رزرو یک کارت پیشرفت و دریافت ۱ الماس طلا</td>
            <td>خرید یکی از کارت‌های وسط میز</td>
            <td>خرید یکی از کارت‌هایی که رزرو کرده</td>
        </tr>
        <tr>
            <td>
                <table >
                    <tr>
                        <td>orange</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                        <td><input type="checkbox" name="orange" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><input type="checkbox" name="blue" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>green</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><input type="checkbox" name="green"onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>dark blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><input type="checkbox" name="darkBlue" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>pink</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><input type="checkbox" name="pink" onclick="select1(this.name)"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table >
                    <tr>
                        <td>orange</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                        <td><input type="checkbox" name="orange" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><input type="checkbox" name="blue" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>green</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><input type="checkbox" name="green"onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>dark blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><input type="checkbox" name="darkBlue" onclick="select1(this.name)"></td>
                    </tr>
                    <tr>
                        <td>pink</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><input type="checkbox" name="pink" onclick="select1(this.name)"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            reserve one card
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img id= "img_fraction" style="width:5vw;" src="images/tokens/gold2.png" >
                        </td>
                    </tr>
                </table>
            </td>

            <td>
                <table>
                    <tr>
                        <td>
                            buy one card
                        </td>
                    </tr>

                </table>
            </td>

            <td>
                <table>
                    <tr>
                        <td>
                            buy reserved card
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td><button name="select1">انتخاب 1</button></td>
            <td><button>انتخاب 2</button></td>
            <td><button>انتخاب 3</button></td>
            <td><button>انتخاب 4</button></td>
            <td><button>انتخاب 5</button></td>
        </tr>
        <tr>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/1.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/2.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/3.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/4.png" ></td>
        </tr>
        <tr>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/5.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/6.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/7.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/8.png" ></td>
        </tr>
        <tr>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/9.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/10.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/11.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/12.png" ></td>
        </tr>
        <tr>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/13.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/14.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/15.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/16.png" ></td>
        </tr>
        <tr>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/17.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/18.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/19.png" ></td>
            <td><img id= "img_fraction" style="width:10vw;" src="images/cards/20.png" ></td>
        </tr>
        <?php


        ?>
    </table>
</form>
