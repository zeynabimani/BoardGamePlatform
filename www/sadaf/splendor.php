<?php
include "header.inc.php";
include "gameClasses/Player.php";
include "gameClasses/Card.php";
//include "JsFile.js";

HTMLBegin();

if(isset($_REQUEST["ChatSubmit"])){
    $message= $_POST['message'];
    $mysql = pdodb::getInstance();
    $query = "insert into sadaf.chat (roomID, userID, msg) values (?,?,?)";
    $mysql->Prepare($query);
    $mysql->ExecuteStatement(array($rec["roomID"], $_SESSION["PersonID"], $message));
}

$bankRedTokens = 7;
$bankBlueTokens = 7;
$bankGreenTokens = 7;
$bankWhiteTokens = 7;
$bankBrownTokens = 7;
$bankGoldenTokens = 5;


$cards= array();
$turn =0;
$flag = 1;
$players= array();

$cardOne=0;
$cardTwo=10;
$cardThree=20;
$cardPrince=30;

$imageSelectedId = 0;

//ini_set("error_reporting", E_All);
$mysql = pdodb::getInstance();
$query = "SELECT userID FROM sadaf.game where roomID=?;";
$mysql->Prepare($query);
// which room we choose (fatemeh bayad bezane)
$res = $mysql->ExecuteStatement(array(1) );
while($rec = $res->fetch()){
    if($flag==1) {
        array_push($players, new player($rec["userID"], 0, 0, 0, 0,
            0, 0, 0, null));

//        echo $rec["userID"];
    }
}

array_push($cards, new Card(1,1,1,1,1,0,
    0,0,1,"images/our/cards/1/1.png",1));

array_push($cards, new Card(2,1,2,1,1,0,
    0,0,1,"images/our/cards/1/2.png",1));
array_push($cards, new Card(3,0,2,1,0,1,
    0,0,1,"images/our/cards/1/3.png",1));

array_push($cards, new Card(4,1,1,0,2,0,
    0,0,1,"images/our/cards/1/17.png",2));
array_push($cards, new Card(5,0,1,1,1,0,
    0,0,1,"images/our/cards/1/18.png",2));
array_push($cards, new Card(6,0,0,1,3,0,
    0,0,1,"images/our/cards/1/20.png",2));

array_push($cards, new Card(7,1,0,2,1,0,
    0,0,1,"images/our/cards/1/31.png",4));

array_push($cards, new Card(8,1,1,1,0,1,
    0,0,1,"images/our/cards/1/34.png",4));

array_push($cards, new Card(9,0,0,2,0,2,
    0,0,1,"images/our/cards/1/46.png",3));

array_push($cards, new Card(10,2,0,2,1,0,
    0,0,1,"images/our/cards/1/30.png",5));



//2
array_push($cards, new Card(11,0,2,3,3,0,
    0,2,2,"images/our/cards/1/35.png",3));

array_push($cards, new Card(12,3,0,0,0,3,
    0,2,2,"images/our/cards/1/25.png",4));

array_push($cards, new Card(13,2,0,2,3,0,
    0,2,2,"images/our/cards/1/18.png",5));

array_push($cards, new Card(14,0,0,3,3,0,
    0,1,2,"images/our/cards/1/10.png",2));

array_push($cards, new Card(15,3,0,3,0,0,
    0,1,2,"images/our/cards/1/6.png",1));

array_push($cards, new Card(16,3,2,0,0,0,
    0,1,2,"images/our/cards/1/1.png",1));

array_push($cards, new Card(17,0,0,0,3,3,
    0,2,2,"images/our/cards/1/22.png",4));

array_push($cards, new Card(18,2,0,0,3,0,
    0,1,2,"images/our/cards/1/33.png",3));

array_push($cards, new Card(19,2,0,0,3,2,
    0,2,2,"images/our/cards/1/19.png",5));
array_push($cards, new Card(20,0,3,2,3,0,
    0,3,2,"images/our/cards/1/28.png",4));


//type 3
array_push($cards, new Card(21,6,4,0,0,0,
    0,3,3,"images/our/cards/3/1.png",1));

array_push($cards, new Card(22,5,0,3,4,0,
    0,3,3,"images/our/cards/3/22.png",4));

array_push($cards, new Card(23,6,0,3,0,0,
    0,3,3,"images/our/cards/3/30.png",3));

array_push($cards, new Card(24,5,4,0,0,0,
    0,3,3,"images/our/cards/3/17.png",5));

array_push($cards, new Card(25,0,0,0,5,5,
    0,3,3,"images/our/cards/3/10.png",2));

array_push($cards, new Card(26,0,4,0,6,0,
    0,3,3,"images/our/cards/3/26.png",3));
$flag = 0;

//echo $cards[0]->imageLink;
if(array_key_exists('btn1', $_POST)){
    function1($players, $turn);
}

function function1($array, $tu)
{
    if(isset($_POST['orange'])){
        $array[$tu]->f1('orange');
    }
    if(isset($_POST['blue'])){
        $array[$tu]->f1('blue');
    }
    if(isset($_POST['green'])){
        $array[$tu]->f1('green');
    }
    if(isset($_POST['darkBlue'])){
        $array[$tu]->f1('darkBlue');
    }
    if(isset($_POST['pink'])){
        $array[$tu]->f1('pink');
    }
}

if(array_key_exists('btn2', $_POST)){
    function2($players, $turn);
}

function function2($array, $tu)
{
    if(isset($_POST['orange'])){
        $array[$tu]->f1('orange');
        $array[$tu]->f1('orange');
    }
    if(isset($_POST['blue'])){
        $array[$tu]->f1('blue');
        $array[$tu]->f1('blue');
    }
    if(isset($_POST['green'])){
        $array[$tu]->f1('green');
        $array[$tu]->f1('green');
    }
    if(isset($_POST['darkBlue'])){
        $array[$tu]->f1('darkBlue');
        $array[$tu]->f1('darkBlue');
    }
    if(isset($_POST['pink'])){
        $array[$tu]->f1('pink');
        $array[$tu]->f1('pink');
//        echo $array[$tu]->pinkTokens;
    }
}

if(array_key_exists('btn3', $_POST)){
    function3($players, $turn, $imageSelectedId, $cards);
//    $cardOne = $_SESSION['cardOne'];
//    $cardOne++;
//    $_SESSION['cardOne']= $cardOne;
}

function function3($array, $tu, $cardId, $cards)
{
    echo $cardId;
    $array[$tu]->reserveACard($cards[$cardId]);
}

function imageClick($imageSelectedId,$cards, $cardOne, $counter){
//    $imageSelectedId = $_SESSION['imageSelectedId'];
//    echo $imageSelectedId;
//    $cards = $_SESSION['cards'];
//    $cardOne = $_SESSION['cardOne'];
    $imageSelectedId."' = '".$cards[$cardOne+$counter]->id;
//    $_SESSION['imageSelectedId'] = $imageSelectedId;
}
?>
<?php
     function isRoomManager(){
        $isManager=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.room where roomID = " . $_SESSION["id"];
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
           if($_SESSION["PersonID"]===$rec["managerID"]){
            
              $isManager=1;
               
    
          }
       }
        
        return $isManager;
    }
    function getPersons(){
        $results= array();
        $persons=array();
        $i=0;
        $mysql = pdodb::getInstance();
        $query = "select * from sadaf.game where roomID = " . $_SESSION["id"];
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
         $copypersons=$persons;
        $res = $mysql->Execute($query); 
       while($rec = $res->fetch()){
        for($j=0;$j<count($persons);$j++){
            $is_recognize=false;
           if($persons[$j][0]===$rec["userID"]&& $is_recognize==false){
            unset($copypersons[$j]);
            $is_recognize=true;
               
    
          }
       }
    }
    $copypersons=array_values($copypersons);
    $results=$copypersons;
    $stOptions="";
    for($p=0;$p<count($results);$p++){
        $stOptions.="<option value='".$results[$p][1]."'>";
        $stOptions.=$results[$p][1];
        $stOptions.="</option>";

    }
    return $stOptions;
    }


    ?>
    <?php
     function addtoDataBase($v){
        $isManager=0;
        $i=0;
        $persons=array();
        $mysql = pdodb::getInstance();
        $query2 = "select * from sadaf.accountspecs";
        $res2 = $mysql->Execute($query2); 
        while($rec2 = $res2->fetch()){
            $persons[$i]=array($rec2["PersonID"],$rec2["UserID"]);
            $i=$i+1;

        }
        for($s=0;$s<count($persons);$s++){
            if($persons[$s][1]===$v){
                $idNew=$persons[$s][0];
            }
        }
        $query = "insert into sadaf.game_request (roomID, userID, status)
        values (".$_SESSION["id"].",".$idNew.", 'Waiting');";
        $mysql->Execute($query);
        
    }
    
      
    ?>
    <?php
    if(isset($_REQUEST["Users"])&&isset($_REQUEST["ersal"])){
        addtoDataBase($_REQUEST["Users"]);
    }
    
    ?>


<form method="POST" >
<div class="container">
  
  <!-- Trigger the modal with a button -->
  <?php
  $isManager=isRoomManager();
  if($isManager===1){
     
     echo " <button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">Send Invitation to your Freinds</button>" ;
  }
  elseif($isManager===0){
     
      $disabled="disabled";
    echo " <button type=\"button\" class=\"btn btn-success btn-sm\"".$disabled.">Send Invitation to your Freinds</button>" ;

  }
  ?>

<div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header align-right DivRtl">
         <h4 class="modal-title ">ارسال دعوت نامه</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <div class="row">
		<div class="col">
          <p> انتخاب لیست کاربران</p>
          <hr>
          <table class="table table-sm table-stripped table-bordered">
          <tr>
					
			<td>
            <select class="form-control sadaf-m-input" name="Users" id="Persons">
            <option value=0>-
            <? echo getPersons();?>
           
        </td>
        <td>
        <input type="submit" name="ersal" class="btn btn-primary" value="Send">
        </td>
        </tr>
        </select>
          </table>
        </div>
        </div>
        </div>
        <div class="modal-footer DivRtl">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>          
  
</div>   
</form>

<script src="JsFile.js"></script>

<form  action="" method="POST">
    <input type="hidden" name="ChatSubmit" value="1">
    <div style="display:flex; flex-direction:row">
        <table class="table table-sm table-bordered table-striped" style="width:80%">
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
                        <td><input type="checkbox" name="orange" id="orange" onclick="select1(this.id)"></td>
                    </tr>
                    <tr>
                        <td>blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><input type="checkbox" name="blue" id="blue" onclick="select1(this.id)"></td>
                    </tr>
                    <tr>
                        <td>green</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><input type="checkbox" name="green" id="green" onclick="select1(this.id)"></td>
                    </tr>
                    <tr>
                        <td>dark blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><input type="checkbox" name="darkBlue" id="darkBlue" onclick="select1(this.id)"></td>
                    </tr>
                    <tr>
                        <td>pink</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><input type="checkbox" name="pink" id="pink" onclick="select1(this.id)"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table >
                    <tr>
                        <td>orange</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/orange2.png" ></td>
                        <td><input type="checkbox" name="orange" id="orange1"  onclick="select2(this.id)"></td>
                    </tr>
                    <tr>
                        <td>blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/blue2.png" ></td>
                        <td><input type="checkbox" name="blue" id="blue1" onclick="select2(this.id)"></td>
                    </tr>
                    <tr>
                        <td>green</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/green2.png" ></td>
                        <td><input type="checkbox" name="green" id="green1" onclick="select2(this.id)"></td>
                    </tr>
                    <tr>
                        <td>dark blue</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/dark_blue2.png" ></td>
                        <td><input type="checkbox" name="darkBlue" id="darkblue1" onclick="select2(this.id)"></td>
                    </tr>
                    <tr>
                        <td>pink</td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><img id= "img_fraction" style="width:2vw;" src="images/tokens/pink2.png" ></td>
                        <td><input type="checkbox" name="pink" id="pink1" onclick="select2(this.id)"></td>
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
            <td><button name="btn1">انتخاب 1</button></td>
            <td><button name="btn2">انتخاب 2</button></td>
            <td><button name="btn3">انتخاب 3</button></td>
            <td><button>انتخاب 4</button></td>
            <td><button>انتخاب 5</button></td>
        </tr>
        <tr>
            <?php
            echo "<td><img name='image' style='width:10vw;' onclick='".imageClick($imageSelectedId,$cards, $cardOne, 0)."' src='".$cards[$cardOne]->imageLink."'></td>";
            echo "<td><img name='image' style='width:10vw;' onclick='".imageClick($imageSelectedId,$cards, $cardOne,1)."' src='".$cards[$cardOne+1]->imageLink."'></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".imageClick($imageSelectedId,2)."' src='".$cards[$cardOne+2]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".$imageSelectedId."' = '".$cards[$cardOne+3]->id."' src='".$cards[$cardOne+3]->imageLink."' ></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".$imageSelectedId."' = '".$cards[$cardTwo]->id."' src='".$cards[$cardTwo]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".$imageSelectedId."' = '".$cards[$cardTwo+1]->id."' src='".$cards[$cardTwo+1]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".$imageSelectedId."' = '".$cards[$cardTwo+2]->id."' src='".$cards[$cardTwo+2]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' onclick='".$imageSelectedId."' = '".$cards[$cardTwo+3]->id."' src='".$cards[$cardTwo+3]->imageLink."' ></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+1]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+2]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardThree+3]->imageLink."' ></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince+1]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince]->imageLink."' ></td>";
            echo "<td><img id= 'img_fraction' style='width:10vw;' src='".$cards[$cardPrince]->imageLink."' ></td>";
            echo "</tr>";
            //            echo "<tr>";
            //            echo "<td><img id= 'img_fraction' style='width:10vw;' src='images/our/cards/1/17.png' ></td>";
            //            echo "<td><img id= 'img_fraction' style='width:10vw;' src='images/our/cards/1/18.png' ></td>";
            //            echo "<td><img id= 'img_fraction' style='width:10vw;' src='images/our/cards/1/19.png' ></td>";
            //            echo "<td><img id= 'img_fraction' style='width:10vw;' src='images/our/cards/1/20.png' ></td>";
            //            echo "</tr>";

            ?>
    </table>
    <div style="width:20%; display:flex; flex-direction:column; border:2px solid black">
            <div style="height:90%; ">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th>نام</th>
                        <th>پيام</th> 
                    </tr>
                <?php
                    $mysql = pdodb::getInstance();
                    $query = "select * from sadaf.chat where roomID < " . $_SESSION["id"];
                    $res = $mysql->Execute($query);
                    while($rec = $res->fetch()){
                        $query2 = "select UserID from sadaf.accountspecs where PersonID = " . $rec["userID"];
                        $res2 = $mysql->Execute($query2);
                        while($rec2 = $res2->fetch()){
                            $writer =  $rec2["UserID"];
                        }
                        echo  "<tr><td>" . $writer . "</td>";
                        echo  "<td>" . $rec["msg"] . "</td></tr>";
                    }
                ?>
                </table>
            </div>
            <textarea id="message" name="message" placeholder="Type Your Message">
            </textarea>
            <input type="submit" class="btn btn-success btn-sm">
        </div>
    </div>
</form>
