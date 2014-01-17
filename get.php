<?php
$con = mysql_connect("localhost","root","root");
mysql_select_db("my_db", $con);

$id = addslashes($_REQUEST['id']);

$image = mysql_query("SELECT * FROM users WHERE id=$id" );
$image = mysql_fetch_assoc($image);
$image = $image['image'];


header("Content-type: image/jpeg"); // changes the whole content of this file into image
//renders into an image





echo $image;


mysql_close($con);
?>
