
<?php
session_start();
?>


<html> 
<table width=100% height=100%><tr><td width=5%>   


<p class="position1">
<a href="match.php"> <button class="roundbutton2"type="button">match</button></a><br/>
<a href="friends.php"> <button class="roundbutton2"type="button">people</button></a><br/>

</p>
<a href="message.php"> <button class="roundbutton2"type="button">message</button></a>
<div class="TEdit" id="Edit1" style="position: absolute; left: 11px; top:126.5px;">
<form action="index2.php" method="POST">
<input class="roundbutton2" type="submit" name="logout" value="logout">
</form>
</div>


<div class="TEdit" id="Edit1" style="position: absolute; left: 11px; top:180px;">
<form action="searchresults.php" method="POST" >
<p class ="title"> Search: </p>
<input type="search" name="search" placeholder="Enter keyword"/>
<input type="submit" name="submitsearch" value="Search"/>
</form>
</div>


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
            border: 2px;
            border-radius: 15px;
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

</td>

<td width=90%>
<?php

    // put the username into session variable in index2.php
    if($_POST['logout'])
    {
    echo "<script type=\"text/javascript\">alert(':( Session destroyed');</script>";
    session_destroy();    
    }

    $con3 = mysql_connect("localhost","root","root");
    mysql_select_db("my_db", $con3);

    $username = $newusername;
    $password = $newuserpassword;

    //This section is for verifying the login information of the user in the Table UserDataBase
    session_start();
    if($_SESSION['username'] != "")
    {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
    }
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];



    $findusername = mysql_query("SELECT * FROM users
    WHERE username = '$username'");

    $findpassword = mysql_query("SELECT * FROM users
    WHERE password = '$password'");

    $flag = 0; 
    while($row = mysql_fetch_array($findusername))
    {

      echo "<br>";
      if($row['username'] == $username && $row['password'] == $password)
      {
      session_start();
      $_SESSION['username'] = $row['username'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['userid'] = $row['id'];
      $_SESSION['usertaste'] = $row['ff1'];
      echo "<br>";
      echo "<br>";
      echo "<center>";
      echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($row['image']) . '"/ height=150 width=150>';
      echo "<p class = 'title'>";
      echo "welcome!";
      echo " ";
      echo $row['username']; 
      echo "</p>";
      echo "</center>";
      echo "<br/>";
      echo "<br/>";
      echo "<br/>";
      $flag = 1;
      break;

      }

    }

    if($flag == 0)
    {
        //echo "member not found!";
        $url = 'http://localhost:8888/PhpProject2/loginfail.php';
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
        echo "<script type=\"text/javascript\">alert(':( Sorry you did not put in the right username and password');</script>";
    }

    mysql_select_db("ratingsystem");
    $new = mysql_query("SELECT * FROM food ORDER BY id DESC"); //DESC for descending
    while($row = mysql_fetch_assoc($new))
    {
        echo "<center>";
        $idfood = $row['id'];
        $foodname = $row['foodname'];
        $description = $row['description'];
        $ratingfood = $row['rating'];
        echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($row['image']) . '"/ height=300 width=300>';
        echo "<br/>";
        echo "<p class='title'>";
        echo "$foodname";
        echo "</p>";
        echo "<br/>";
        echo "<p class=title2>";
        echo $description."<br/>";
        printf("%0.1f",$ratingfood);
        echo "</p>";
        echo "<br/>";
        echo "<a href='ratingsystembackend.php?id=$idfood'><button>rate this</button></a> <br/>";
        echo "<center>";
        echo "<p class=title>Tags</p> <br/>";
        $flagfortags = 0;
        mysql_select_db("my_db");
        $retrievetags = mysql_query("SELECT * FROM tags");
        while($tags = mysql_fetch_assoc($retrievetags))
        {
            if($tags['assigned_to'] == $idfood)
            {
                echo $tags['tag'] ." ";
                $flagfortags = 1; 
            }

        }

        if($flagfortags == 0)
        {
            echo "<p class='title'>no tags attached to this delicacy. </p><br/>";
        }
        
        echo "<br/>";
        echo "<p class=title>  reviews </p>";
        echo "<br/>"; 

        $flagforreview = 0;
        mysql_select_db("my_db");
        $extractreviews = mysql_query("SELECT *FROM reviews");
        $count = 0;
        
        while($reviews = mysql_fetch_assoc($extractreviews))
        {
            if($reviews['assigned_to'] == $idfood)
            {
                $flagforreview = 1;
                echo "<center>";
                echo $displayreviewers = $reviews['reviewer']. " wrote: "; 
                echo $displayreviews = $reviews['review'];
                echo "<br/>";
                echo "</center>";
                $count++;
                if($count == 4)
                break;
            }

        }
        
        if($flagforreview == 0)
        {
            echo "<p class=title> There are currently no reviews for this delicacy. </p><br/>";
        }
        //friend taste compare starts here
        mysql_connect("localhost","root","root");
        mysql_select_db("my_db");
        echo "<p class='title2'>";
        echo "Friends";
        echo "</p>";
        echo "<br/>"; 
        $storefriendid = array();
        session_start();
        $friendsarray = mysql_query("SELECT * FROM friendship");
        
        while($friendsfound = mysql_fetch_assoc($friendsarray))//get all the friend ids 
        {
            session_start();
            if($friendsfound['user_id'] == $_SESSION['userid'])
            {
            array_push($storefriendid,$friendsfound['friend_id']);
            //echo $friendsfound['friend_id']. " ";
            }
        }

            $ratesarray = mysql_query("SELECT * FROM checkrate");
            
            while($ratefound = mysql_fetch_assoc($ratesarray))
            {
                for($a = 0; $a < sizeof($storefriendid); $a++)
                {
                if($storefriendid[$a] == $ratefound['user_id'] && $ratefound['food_id'] == $idfood)
                {

                $friendid = $storefriendid[$a];
                $r = mysql_query("SELECT * FROM users WHERE id ='$friendid'");
                $a = mysql_fetch_assoc($r);
                echo $a['username']. " ";
                }
                }
            }

        echo "</center>";
        echo "<br/>";
        echo "<br/>";

    }

?>

</td>

<td width=5%>
<div class="TEdit" id="Edit2" style="position: absolute; right: 10px; top:180px;">
<form action="searchtaste.php" method="POST" >
<p class ="title">   Update Your Taste </p>
<input type="search" name="search" placeholder="Enter your taste"/>
<input type="submit" name="submitsearch" value="Search"/>
</form>   
</div>
    
</td>
      
</tr></table>    
    
</html>