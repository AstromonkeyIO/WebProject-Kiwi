<?php

mysql_select_db("my_db");

$image = mysql_query("SELECT * FROM users");
while($row = mysql_fetch_assoc($image))
{
    //render and displays array of images. 
    echo "<center>";
    echo '<img src="data:image/png;base64,' . base64_encode($row['image']) . '"/ height=300 width=300>';
    echo "<br/>";
    echo "</center>";
}

?>
