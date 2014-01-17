<?php
mysql_connect("localhost","root","root");
mysql_select_db("ratingsystem");
$search = $_POST['search'];

$findfood = mysql_query("SELECT * FROM food");
while($result = mysql_fetch_assoc($findfood))
{
    if($result['foodname'] == $search)
    {
    echo "<center>";
    echo "<h1>";
    echo "Search found! <br/>";
    echo '<img src="data:image/png;base64,' . base64_encode($result['image']) . '"/ height=300 width=300>';
    echo "<br/>";
    echo $result['foodname']." ". $result['description']. " ". $result['rating'];
    echo "</h1>";
    echo "</center>";
    }
}

mysql_select_db("my_db");
$findtag = mysql_query("SELECT * FROM tags");
while($result = mysql_fetch_assoc($findtag))
{
    if($result['tag'] == $search)
    {
        $tag_assigned_to = $result['assigned_to'];
        mysql_select_db("ratingsystem");
        $foodfound = mysql_query("SELECT * FROM food WHERE id='$tag_assigned_to'");  
        $display = mysql_fetch_assoc($foodfound);
        echo "<center>";
        echo "<h1>";
        echo "Search found! <br/>";
        echo "#tagged as ". $search. "<br/>";
        echo $display['foodname']. "<br/>";        
        echo '<img src="data:image/png;base64,' . base64_encode($display['image']) . '"/ height=300 width=300>';
        echo "<br/>";
        echo $display['description']. " ". $display['rating'];
        echo "<br/>";
        echo "</h1>";
        echo "</center>";
    }
}



$finduser = mysql_query("SELECT * FROM users");
while($result2 = mysql_fetch_assoc($finduser))
{
    if($result2['username'] == $search)
    {
        echo "<h2>";
        echo $result2['username']. "<br/>";
        $image = $result2['image'];
        echo '<img src="data:image/png;base64,' . base64_encode($image) . '"/ height=300 width=300>';
        echo "<br/>";
        echo "</h2>";
    }
}


?>

<html>
    <br/>
    <a href="index4.php"> <button>return to main</button></a>     
    
    
</html>
