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
        body{
            background-color:#abd9e9;
            font-family:Arial;
        }
        #container{
            width:500px;
            height:700px;
            background:white;
            margin:0 auto;
            font-size:0;
            border-radius:4px;
            overflow:hidden;
        }
        main{
            width:500px;
            height:700px;
            display:inline-block;
            font-size:15px;
            vertical-align:top;
        }
        main header{
            height:100px;
            padding:30px 20px 30px 40px;
            background-color:#622569;
        }
        main header > *{
            display:inline-block;
            vertical-align:top;
        }
        main header img:first-child{
            width:24px;
            margin-top:8px;
        }
        main header img:last-child{
            width:24px;
            margin-top:8px;
        }
        main header div{
            margin-left:90px;
            margin-right:90px;
        }
        main header h2{
            font-size:24px;
            margin-top:4px;
            text-align:center;
            color:#ffff55;
        }
        main .inner_div{
            padding-left:0;
            margin:0;
            list-style-type:none;
            position:relative;
            overflow:auto;
            height:500px;
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            position: relative;
            border-top:2px solid #ffff55;
            border-bottom:2px solid #2F353B;
        }
        main .triangle{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 4px 8px 8px;
            border-color: transparent transparent
            #58b666 transparent;
            margin-left:20px;
            clear:both;
        }
        main .message{
            padding:10px;
            color:#000;
            margin-left:14px;
            background-color:#58b666;
            line-height:20px;
            max-width:45%;
            display:inline-block;
            text-align:left;
            border-radius:4px;
            clear:both;
        }
        main .triangle1{
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 8px 8px 8px;
            border-color: transparent
            transparent #6fbced transparent;
            margin-right:20px;
            float:right;
            clear:both;
        }
        main .message1{
            padding:10px;
            color:#000;
            margin-right:14px;
            background-color:#6fbced;
            line-height:20px;
            max-width:45%;
            display:inline-block;
            text-align:left;
            border-radius:4px;
            float:right;
            clear:both;
        }

        main footer{
            height:150px;
            padding:20px 30px 10px 20px;
            background-color:#622569;
        }
        main footer .input1{
            resize:none;
            border:50%;
            display:block;
            width:60%;
            height:55px;
            border-radius:2px;
            padding:20px;
            font-size:10px;
            margin-bottom:12px;
        }
        main footer textarea{
            resize:none;
            border:50%;
            display:block;
            width:70%;
            height:55px;
            border-radius:2px;
            padding:20px;
            font-size:12px;
            margin-bottom:12px;
            margin-left:20px;
        }
        main footer .input2{
            resize:none;
            border:50%;
            display:block;
            width:20%;
            height:55px;
            border-radius:2px;
            padding:20px;
            font-size:10px;
            margin-bottom:12px;
            margin-left:100px;

            text-align:center;
            background-color:black;
            border: 4px solid white;
        }
        }
        main footer textarea::placeholder{
            color:#f1b0b7;
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

                $query = "SELECT * FROM sadaf.chat";
                $run = $mysql->query($query);
                $i=0;

                while($row = $run->fetch_array()) :
                    if($i==0){
                        $i=5;
                        $first=$row;
                        ?>
                        <div id="triangle1" class="triangle1"></div>;
                        <div id="message1" class="message1">
                            <span style="color:white;float:right;">
                            <?php echo $row['msg']; ?></span> <br/>
                            <div>
                            <span style="color:black;float:left;
                            font-size:10px;clear:both;">
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

                            echo "<div id=\"triangle\" class=\"triangle\"></div>";
                            echo "<div id=\"message\" class=\"message\">";
                            echo " <span style=\"color:white;float:left;\">";
                            echo $row['msg'];
                            echo "</span> <br/>";
                            echo "<div>";
                            echo "<span style=\"color:black;float:right; font-size:5px;clear:both;\">";
                            echo $row['userID'];
                            echo $row['dt'];
                            echo "</span>";
                            echo" </div>";
                            echo"</div>";
                            echo"<br/><br/>";

                        }
                        else
                        {

                            echo "<div id=\"triangle1\" class=\"triangle1\"></div>";
                            echo "<div id=\"message1\" class=\"message1\">";
                            echo"<span style=\"color:white;float:right;\">";
                            echo $row['msg'];
                            echo"</span> <br/>";
                            echo"<div>";
                            echo "<span style=\"color:black;float:left;font-size:5px;clear:both;\">";
                            echo $row['userID'];
                            echo $row['dt'];
                            echo "</span>";
                            echo"    </div>";
                            echo" </div>";
                            echo" <br/><br/>";


                        }
                    }
                endwhile;
                ?>
            </div>

            <table>
                <tr>
                    <td>
                        <input type="submit"
                               id="submit" name="submit" value="send">
                    </td>
                    <td>
                        <input  class="input1" type="text"
                                id="uname" name="uname"
                                placeholder="From">

                    </td>
                    <td>
            <textarea id="msg" name="msg"
                      rows='3' cols='50'
                      placeholder="Type your message">
            </textarea></td>
                </tr>
            </table>

        </form>
    </main>
</div>

</body>
</html>