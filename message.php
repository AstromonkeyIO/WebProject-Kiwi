<?php
session_start();
include('connect.php');

?>


<style type ="text/css">
    .edittable {
        border-radius: 10px;
        border-color: whitesmoke;
        
    }    
    .bubble {
  position: relative;
  background-color:#eee;
  margin: 0;
  padding:10px;
  text-align:center;
  width:300px;
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  -webkit-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
  box-shadow: 0px 0 3px rgba(0,0,0,0.25); 
   }
  .bubble:after {
  position: absolute;
  display: block;
  content: "";  
  border-color: #eee transparent transparent transparent;
  border-style: solid;
  border-width: 10px;
  height:0;
  width:0;
  position:absolute;
  bottom:-19px;
  left:1em;
   }

</style>





<br/>
<br/>
<form action="message.php" method="POST">
<p class ="title"> Search: </p>
<input type="search" name="search" placeholder="friendname"/>
<input type="submit" name="submitsearch" value="Search"/>
</form>
<?php
if($_POST['submitsearch'])
{
    session_start();
    echo "hey";
    findfriends($_SESSION['userid'], $_POST['search']);
}

?>


<html>
<div>
<p class="bubble">To: <?php session_start(); if($_POST['choosefriend']){ echo $_SESSION['messagingto'];} ?><br>
    From: <?php session_start();echo findusername($_SESSION['userid'])?><br>
    message: <br>
    <form action="message.php" method="POST">
    <textarea type="text" cols="20" rows="5" name="content"></textarea>
    <br>
    <button onclick="sendmessage()">send!</button>
    </form>
</p><br/>
<script>
function sendmessage(){
 alert("<?php echo "hey"; session_start(); sendmessagephp($_SESSION['messagingto']);?>");   
}
</script>
</div>
    
    


</html>

<?php
function sendmessagephp($findreceiverofmessage) {
    session_start();
    echo "I'm in the function";
    $receiverid = findid($findreceiverofmessage);
    mysql_query("INSERT INTO message VALUES('','$_SESSION[userid]','$_POST[content]','','$receiverid','0')");
}
?>

<?php
$retrievemessages = mysql_query("SELECT * FROM message WHERE receiver_id='$_SESSION[userid]'");
while($processmessages = mysql_fetch_assoc($retrievemessages))
{   
echo "<center>";
echo "<table cellspacing='5' cellpadding='5' border='5' width='500' class='edittable'>";
echo "<tr>"; 
echo "<td width='100'>";
$usernamefound = findusername($processmessages['sender_id']);
echo "<a href='messagebackend.php?id=$processmessages[id]'><button>$usernamefound</button></a> <br/>";
echo "</td>";
echo "<td width='300'>";
echo substr($processmessages['message'], 0, 20);
echo "</td>";
echo "<td width='100'>";
if($processmessages['read?'] == 0)
{
    echo "unread";
}
else
{
    echo "read";
} 
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</center>";
}
?>


<?php
function findusername($searchid)
{
    $finduser = mysql_query("SELECT * FROM users WHERE id='$searchid'");
    $displayuser = mysql_fetch_assoc($finduser);
    return $displayuser['username'];
    
}

function findid($searchusername)
{
    $finduserid = mysql_query("SELECT * FROM users WHERE username='$searchusername'");
    $displayuserid = mysql_fetch_assoc($finduserid);
    return $displayuserid['id'];  
}


function findfriends($currentuserid, $searchusername) {
    //This retrieves the id of the friend that the user is searching for
   $retrieveusers = mysql_query("SELECT * FROM users WHERE username ='$searchusername'");
   $processusers = mysql_fetch_assoc($retrieveusers);
   echo $foundfriendid = $processusers['id'];
    
   $retrievefriends = mysql_query("SELECT * FROM friendship");
   while($displayfriends = mysql_fetch_assoc($retrievefriends))
   {
    
    if($displayfriends['user_id'] == $currentuserid && $displayfriends['friend_id'] == $foundfriendid)
    {
    session_start();
    echo "<center>";
    echo "<br/>";
    //mysql_select_db("my_db");
    $friendprofile = mysql_query("SELECT * FROM users WHERE id='$displayfriends[friend_id]'");
    $uploadfriendprofile = mysql_fetch_assoc($friendprofile);
    echo "<p class=title>";
    echo $uploadfriendprofile['username']. "<br/>";
    $_SESSION['messagingto'] = $uploadfriendprofile['username'];
    echo "</p>";
    echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($uploadfriendprofile['image']) . '"/ height=150 width=150>';
    echo "<br/>";
    echo "<form action='' method='POST'>";
    echo "<input type='submit' name='choosefriend' value='choose'>";
    echo "</form>";
    echo "</center>";
    }
       
   }
    
}



?>