<?php
session_start();
?>
<a href="index4.php"><button class="roundbutton2">Menu</button></a>
<br/>
<?php

if($_POST['submitsearch'])
{ 
echo "<div id='content'>";
mysql_connect("localhost","root","root");
mysql_select_db("my_db");
$searchfriend  = $_POST['search'];
$friendfind = mysql_query("SELECT * FROM users");
$flag = 0;
while($uploadfriendprofile = mysql_fetch_assoc($friendfind))
{
if($uploadfriendprofile['username'] == $searchfriend)
{
echo "<center>";
echo "<p class=title>".$uploadfriendprofile['username']. "</p>"; 
echo "<br/>";
echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($uploadfriendprofile['image']) . '"/ height=150 width=150>';
echo "</center>";
$friendid = $uploadfriendprofile['id'];
session_start();
$_SESSION['friendid'] = $friendid;
echo "<center>";
echo "<button onclick='addfriendjava()'>addme</button>";
echo "</center>";
$flag = 1;
break;
}
echo "</div>";
}

if($flag == 0)
{
    echo "<center>";
    echo "<p class='title2'>Friend not found!</p>";
    echo "</center>";
    echo "<br/>";
}

}
?>

<html>
    <br/>
   
    <style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .title2{
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: darkseagreen;
            
        }
        .roundrect {
            border-radius: 15px;
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
        
    </style>
    <center>
    <br/>
    <br/>   
    <p class="title"> Search: </p>
    <form action="" method="POST">
    <input type="search" name="search" placeholder="Find your friends"/>
    <input type="submit" name="submitsearch" value="Search"/>
    </form>   
    <p class="title"> Your current friends:</p>
    </center>
    
    <script>
    function addfriendjava()
    {
    alert("<?php addfriend(); ?>"); 
    }
    </script>
  
<br/>
<br/>
<br/>
</html>


<?php
session_start();
mysql_connect("localhost","root","root");
mysql_select_db("my_db");
$searchfriends = mysql_query("SELECT * FROM friendship WHERE user_id ='$_SESSION[userid]'");
while($displayfriends = mysql_fetch_assoc($searchfriends))
{
    echo "<center>";
    //echo $displayfriends['friend_id']. " ". $displayfriends['user_id'];
    echo "<br/>";
    mysql_select_db("my_db");
    $friendprofile = mysql_query("SELECT * FROM users WHERE id='$displayfriends[friend_id]'");
    $uploadfriendprofile = mysql_fetch_assoc($friendprofile);
    echo "<p class=title>";
    echo $uploadfriendprofile['username']. "<br/>";
    echo "</p>";
    echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($uploadfriendprofile['image']) . '"/ height=150 width=150>';
    echo "<br/>";
    echo "</center>";
}
?>

    
<?php
function addfriend()
{
    $count = 0;
    $checkf = 0;
    session_start();
    mysql_connect("localhost","root","root");
    mysql_select_db("my_db");
    
    $check = mysql_query("SELECT * FROM friendship");
    while($check1 = mysql_fetch_assoc($check))
    {
        if($check1['user_id'] == $_SESSION['userid'] && $check1['friend_id'] == $_SESSION['friendid'])
        {
        echo "You are already friends!";
        $checkf = 1;
        break;
        }
        
        if($_SESSION['userid'] == $_SESSION['friendid'])
        {
        echo "You can't add yourself!";
        $checkf = 1;
        break;
        }
      
    }
    
    if($checkf == 0)
    {
    session_start();
    $count++;
    echo $count;
    mysql_query("INSERT INTO friendship VALUES('$_SESSION[userid]','$_SESSION[friendid]','1','0','1')");
    mysql_query("INSERT INTO friendship VALUES('$_SESSION[friendid]','$_SESSION[userid]','1','0','1')");
    echo "Your friend has been added!";
    //mysql_close();
    }
}
    ?>




