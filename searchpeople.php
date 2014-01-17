<?php
//session_start();
?>
<html>
<style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .roundrect {
            border-radius: 15px;
        }
</style>
<form action="friends.php" method="POST">
<input type="submit" name="addfriend" value="addme"/>
</form>
</html>

<?php
/*
mysql_connect("localhost","root","root");
mysql_select_db("my_db");
$searchfriend  = $_POST['search'];
$friendfound = mysql_query("SELECT * FROM users WHERE username='$searchfriend'");
$uploadfriendprofile = mysql_fetch_assoc($friendfound);
echo "<center>";
echo "<p class=title>".$uploadfriendprofile['username']. "</p>"; 
echo "<br/>";
echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($uploadfriendprofile['image']) . '"/ height=150 width=150>';
echo "</center>";
echo $friendid = $uploadfriendprofile['id'];
*/
?>
