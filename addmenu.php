
<html>
<fieldset>
    <legend>Add to Menu</legend>       
        <form action="addmenu.php" method="POST">
        Name: <input type="text" name="foodname">
        <br/>
        Description: <input type="text" name="description">
        <br/>
        Nationality: <input type="text" name="nationality">
        <br/>
        Key Characteristics 1: <input type="text" name="key1">
        <br/>
        Key Characteristics 2: <input type="text" name="key2">
        <br/>
        Key Characteristics 3: <input type="text" name="key3">
        <br/>
        Key Characteristics 4: <input type="text" name="key4">
        <br/>
        Key Characteristics 5: <input type="text" name="key5">
        <br/>
        <input type="submit" value="submit">
        <br/>
        </form>
</fieldset>

<center>
    <form enctype="multipart/form-data" action="addmenu.php" method="POST" >
    File:  
    <input type="file" name="image"> <input type="submit" value="Upload">
    </form> 
    
</center>




</html>



<?php


$con4 = mysql_connect("localhost","root","root");
mysql_select_db("my_db", $con4);

//This section is for adding new food to MenuDataBase
$newfoodname = $_POST['foodname'];
$newfooddescription = $_POST['description'];
$newfoodnationality = $_POST['nationality'];
$newfoodkey1 = $_POST['key1'];
$newfoodkey2 = $_POST['key2'];
$newfoodkey3 = $_POST['key3'];
$newfoodkey4 = $_POST['key4'];
$newfoodkey5 = $_POST['key5'];

$sql="INSERT INTO MenuDataBase (Foodname, Fooddescription, Nationality, Key1, Key2, Key3, Key4, Key5)
VALUES('$_POST[foodname]','$_POST[description]','$_POST[nationality]', '$_POST[key1]', '$_POST[key2]', '$_POST[key3]', '$_POST[key4]', '$_POST[key5]')";


if (!mysql_query($sql,$con4))
{ 
    die('Error: ' . mysql_error());
}


  
echo $file = @$_FILES['image']['tmp_name'];

if(!isset($_FILES['image']['tmp_name']))
{
    echo "Please select a file";   
}
else
{
   echo "image is in!";
   $image = addslashes(file_get_contents(@$_FILES['image']['tmp_name'])); //addslashes prevent unwanted sql
   $imagename = addslashes(@$_FILES['image']['name']);
   $imagesize = getimagesize(@$_FILES['image']['tmp_name']); // checks if this is an image
   
   
   if($imagesize == FALSE)
   {
       echo "That is not an image <br>";
   }
  
   else
   {
       echo "That is an image <br>";
       if(!$insert = mysql_query("INSERT INTO Image3 VALUES('','$imagename','$image')"))
       {
           echo "Problem uploading image! <br>";
           
       }
       else
       {
       $lastid = mysql_insert_id();
       echo "image uploaded. <p> your image <br>";
       echo "<img src= 'get.php?id=$lastid' width='300' height='300'>";
       
       }
       
   }
   
}
  

  
  
mysql_close($con4);
echo "one food added!";







?>


<?php
$con5 = mysql_connect("localhost","root","root");
mysql_select_db("my_db", $con5);

$resultformenu = mysql_query("SELECT * FROM MenuDataBase");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>Description</th>
<th>Nationality</th>
<th>Likes</th>
<th>Dislikes</th>
<th>Key1</th>
<th>Key2</th>
<th>Key3</th>
<th>Key4</th>
<th>Key5</th>
</tr>";

while($row = mysql_fetch_array($resultformenu))
  {
  echo "<tr>";
  echo "<th>" . $row['Foodname'] . "</th>";
  echo "<th>" . $row['Fooddescription'] . "</th>";
  echo "<th>" . $row['Nationality'] . "</th>";
  echo "<th>" . $row['Likes'] . "</th>";
  echo "<th>" . $row['Dislikes'] . "</th>";
  echo "<th>" . $row['Key1'] . "</th>";
  echo "<th>" . $row['Key2'] . "</th>";
  echo "<th>" . $row['Key3'] . "</th>";
  echo "<th>" . $row['Key4'] . "</th>";
  echo "<th>" . $row['Key5'] . "</th>";
  echo "</tr>";
  }
echo "</table>";
mysql_close($con5);

?>
