<?php
session_start();
?>


<style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .title2 {
            font-family: "Helvetica";
            font-size: 20px;
            font-weight: bold;
            color:cadetblue;
        }
        .title3 {
            font-family: "Helvetica";
            font-size: 20px;
            
        }
        .roundrect {
            border-radius: 15px;
            width: 150px;
            height: 100px;
        }
        .roundbutton {
            border-radius: 10px;
            color: steelblue;
            height:150px;
            width: 150px;
            background: white;
            font-weight: bold;
            font-size: 40px;
        }
        .roundbutton2 {
            border-radius: 10px;
            color: steelblue;
            height:50px;
            width: 100px;
            background: white;
            font-weight: bold;
            font-size: 15px;
        }
        .backgroundimage {
            height: 300px;
            width: 200px;
        }
        .position1 {
		position:absolute;
		top: 11px;
		left: 11px;
	}
        
</style>

<?php
if($_POST['updatetastebutton'])
{
    session_start();
    $_SESSION['usertaste'] = $_POST['updatetaste'];
    $updateusertaste = $_SESSION['usertaste'];
    $finduserid = $_SESSION['userid'];
    mysql_connect("localhost","root","root");
    mysql_select_db("my_db");
    mysql_query("UPDATE users SET ff1='$updateusertaste' WHERE id='$finduserid'");
    //echo "update successful"; 
}


?>



<a href="index4.php"><button class="roundbutton2">Menu</button></a>
<br/>
<div class="TEdit" id="Edit12" style="position: absolute; left: 11px; top:50px;">
<form action="" method="POST" >
<p class ="title"> Update Taste: </p>
<input type="search" name="updatetaste" placeholder=" update your new taste"/>
<input type="submit" name="updatetastebutton" value="Update"/>
</form>
</div>

<?php
session_start();
mysql_connect("localhost","root","root");
mysql_select_db("ratingsystem");
$findfood = mysql_query("SELECT * FROM food");

echo"<center>";
echo "<br/>";
echo "<br/>";
echo "<p class='title2'>";
echo "Recommendations for your matching taste: ".$_SESSION['usertaste'];
echo "</p>";
echo "<br/>";
echo"</center>";
while($result = mysql_fetch_assoc($findfood))
{
    if($result['type'] == $_SESSION['usertaste'])
    {
    echo "<br/>";
    echo "<br/>";
    echo "<center>";
    echo '<img class="roundbutton" src="data:image/png;base64,' . base64_encode($result['image']) . '"/>';
    echo "<br/>";
    echo "<p class='title'>";
    echo $result['foodname'];
    echo "</p>";
    echo "<br/>";
    echo "<p class='title2'>";
    echo $result['description'];
    echo "<br/>";
    echo $result['rating'];
    echo "</p>";
    echo "<br/>";
    $idf = $result['id'];
    echo "<a href='ratingsystembackend.php?id=$idf'><button>Vote This</button></a>";
    echo "</br>";
    echo "</br>";
    echo "</center>";
    }
}
?>
