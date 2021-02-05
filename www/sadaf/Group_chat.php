<?php
include "header.inc.php";


HTMLBegin();
if (isset($_POST['submit'])){

    $mysql = pdodb::getInstance();

    $un= $_SESSION["PersonID"];
    $m = mysqli_real_escape_string(
        $mysql, $_REQUEST['msg']);
    date_default_timezone_set('Asia/Tehran');
    $ts=date('y-m-d h:ia');

    $sql = "INSERT INTO sadf.chat (userID, msg, dt) 
        VALUES ('$un', '$m', '$ts')";
    if(mysqli_query($mysql, $sql)){
        ;
    } else{
        echo "ERROR: Message not sent!!!";
    }

    mysqli_close($mysql);
}
?>
<html>
<head>
    <style>
        *{
            box-sizing:border-box;
        }
        #container{
            width:250px;
            height:350px;
            background:white;
            margin:0 auto;
            font-size:0;
            border-radius:2px;
            overflow:hidden;
        }
        main{
            width:250px;
            height:350px;
            display:inline-block;
            font-size:7px;
            vertical-align:top;
        }
        main header{
            height:50px;
            padding:15px 10px 15px 20px;
            background-color:#622569;
        }
        main header > *{
            display:inline-block;
            vertical-align:top;
        }
        main header img:first-child{
            width:12px;
            margin-top:4px;
        }
        main header img:last-child{
            width:12px;
            margin-top:4px;
        }
        main header div{
            margin-left:45px;
            margin-right:45px;
        }
        main header h2{
            font-size:12px;
            margin-top:2px;
            text-align:center;
            color:#FFFFFF;
        }
        main .inner_div{
            padding-left:0;
            margin:0;
            list-style-type:none;
            position:relative;
            overflow:auto;
            height:250px;
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            position: relative;
            border-top:1px solid #fff;
            border-bottom:1px solid #fff;
        }
        main .triangle{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 4px 4px 4px;
            border-color: transparent transparent
            #58b666 transparent;
            margin-left:10px;
            clear:both;
        }
        main .message{
            padding:5px;
            color:#000;
            margin-left:7px;
            background-color:#58b666;
            line-height:10px;
            max-width:45%;
            display:inline-block;
            text-align:left;
            border-radius:2px;
            clear:both;
        }
        main .triangle1{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 4px 4px 4px;
            border-color: transparent
            transparent #6fbced transparent;
            margin-right:10px;
            float:right;
            clear:both;
        }
        main .message1{
            padding:5px;
            color:#000;
            margin-right:7px;
            background-color:#6fbced;
            line-height:10px;
            max-width:45%;
            display:inline-block;
            text-align:left;
            border-radius:2px;
            float:right;
            clear:both;
        }

        main footer{
            height:75px;
            padding:10px 15px 5px 10px;
            background-color:#622569;
        }
        main footer .input1{
            resize:none;
            border:50%;
            display:block;
            width:60%;
            height:27px;
            border-radius:1px;
            padding:10px;
            font-size:5px;
            margin-bottom:6px;
        }
        main footer textarea{
            resize:none;
            border:50%;
            display:block;
            width:70%;
            height:27px;
            border-radius:1px;
            padding:10px;
            font-size:6px;
            margin-bottom:6px;
            margin-left:10px;
        }
        main footer .input2{
            resize:none;
            border:50%;
            display:block;
            width:20%;
            height:27px;
            border-radius:1px;
            padding:10px;
            font-size:5px;
            margin-bottom:6px;
            margin-left:50px;
            color:white;
            text-align:center;
            background-color:black;
            border: 2px solid white;
        }
        }
        main footer textarea::placeholder{
            color:#ddd;
        }

    </style>
<body onload="show_func()">
<div id="container">
    <main>

        <header>
            <img src="www/sadaf/images/ico_star.png" alt="">
            <div>
                <h2>GROUP CHAT</h2>
            </div>
            <img src="www/sadaf/images/ico_star.png" alt="">
        </header>

        <script>
            function show_func(){

                var element = document.getElementById("chathist");
                element.scrollTop = element.scrollHeight;

            }
        </script>

        <form id="myform" action="Group_chat.php" method="POST" >
            <div class="inner_div" id="chathist">
                <?php
                $mysql = pdodb::getInstance();

                $query = "SELECT * FROM chat";
                $run = $mysql->query($query);
                $i=0;

                while($row = $run->fetch_array()) :
                    if($i==0){
                        $i=5;
                        $first=$row;
                        ?>
                        <div id="triangle1" class="triangle1"></div>
                        <div id="message1" class="message1">
 <span style="color:white;float:right;">
 <?php echo $row['msg']; ?></span> <br/>
                            <div>
   <span style="color:black;float:left;
   font-size:5px;clear:both;">
    <?php echo $row['userID']; ?>,
        <?php echo $row['dt']; ?>
   </span>
                            </div>
                        </div>
                        <br/><br/>
                        <?php
                    }
                    else
                    {
                        if($row['userID']!=$first['userID'])
                        {
                            ?>
                            <div id="triangle" class="triangle"></div>
                            <div id="message" class="message">
 <span style="color:white;float:left;">
   <?php echo $row['msg']; ?>
 </span> <br/>
                                <div>
  <span style="color:black;float:right;
          font-size:5px;clear:both;">
  <?php echo $row['userID']; ?>,
        <?php echo $row['dt']; ?>
 </span>
                                </div>
                            </div>
                            <br/><br/>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div id="triangle1" class="triangle1"></div>
                            <div id="message1" class="message1">
 <span style="color:white;float:right;">
  <?php echo $row['msg']; ?>
 </span> <br/>
                                <div>
 <span style="color:black;float:left;
         font-size:5px;clear:both;">
 <?php echo $row['userID']; ?>,
      <?php echo $row['dt']; ?>
 </span>
                                </div>
                            </div>
                            <br/><br/>
                            <?php
                        }
                    }
                endwhile;
                ?>
            </div>
            <footer>
                <table>
                    <tr>
                        <td>
                            <input  class="input1" type="text"
                                    id="uname" name="uname"
                                    placeholder="From">
                            <?php
echo "I am here :D";
?>
                        </td>
                        <td>
            <textarea id="msg" name="msg"
                      rows='3' cols='50'
                      placeholder="Type your message">
            </textarea></td>
                        <td>
                            <input class="input2" type="submit"
                                   id="submit" name="submit" value="send">
                        </td>
                    </tr>
                </table>
            </footer>
        </form>
    </main>
</div>

</body>
</html>