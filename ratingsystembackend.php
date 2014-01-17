<?php
ob_start();
session_start();
$reviewer = $_SESSION['username'];
//echo "your session is saved". $_SESSION['username'];
mysql_connect("localhost","root","root");
//check if the user has already rated this item
$id = $_GET['id'];
$_SESSION['foodidstorage'] = $id; 
?>

<?php
//process submission

if($_POST['submit'])//if the form has been submitted
{
    session_start();
    
    //echo $id_post = $_POST['idfood'];
    $id_post = $_POST['id']; 
    $rating_post = $_POST['rating'];
    mysql_connect("localhost","root","root");
    mysql_select_db("ratingsystem");
    if(rating_post <= 5)
    {
    $get = mysql_query("SELECT * FROM food WHERE id=$id_post");
    $get = mysql_fetch_assoc($get);
    $get = $get['rating'];
    
    if($get == 0)
        $newrating = $get + $rating_post;   
    else
        $newrating = ($get + $rating_post)/2;

    $update = mysql_query("UPDATE food SET rating='$newrating' WHERE id = '$id_post'");
    header("Location:index4.php");
    }
    else
    {
        echo "Don't fuck with our code! <br/>";
    }
}
// add another column into review table.
if($_POST['submit'])
{
    session_start();  
    $assign_id = $_POST['id'];
    $reviewer = $_SESSION['username'];
    $reviewretrieve = $_POST['content'];
    $review = $reviewretrieve; 
    //$review = $_POST['content'];
    if($review == "")
    {
    //echo "<script type=\"text/javascript\">alert(':( Sorry your review is blank!')</script>";
    }
    else
    {
    echo $review. "<br/>";
    mysql_select_db("my_db");
    mysql_query("INSERT INTO reviews VALUES ('','$reviewer','$review','$assign_id')");
    header("Location:index4.php"); 
    }
}

if($_POST['submittag'])
{
   $assign_tag_id = $_GET['id'];
   $tag = $_POST['tag'];
   if(!($tag ==""))
   {
   mysql_select_db("my_db");
   mysql_query("INSERT INTO tags VALUES('','$tag','$assign_tag_id')");
   }
}

?>

<?php

$idfood = $_GET['id']; 
session_start();
$userid = $_SESSION['userid'];
$checkflag = 0;
mysql_connect("localhost","root","root");
mysql_select_db("my_db");
$row1 = mysql_query("SELECT * FROM checkrate");
while($checkrate = mysql_fetch_assoc($row1))
{
    if($checkrate['user_id'] === $userid && $checkrate['food_id'] === $idfood)
    {
    $checkflag = 1;
    $url = 'http://localhost:8888/PhpProject2/index4.php';
    echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
    echo "<script type=\"text/javascript\">alert('You already rated this delicacy');</script>";
    break;
    }
}
if($checkflag == 0)
{
mysql_query("INSERT INTO checkrate VALUES('$userid','$idfood','')");
//record that the user has rated
}
//mysql_connect("localhost","root","root");
mysql_select_db("ratingsystem");

$row = mysql_query("SELECT * FROM food");
while($display = mysql_fetch_assoc($row))
{
    if($display['id'] == $idfood)
    {
    echo "<center>";
    echo '<img class="roundrect" src="data:image/png;base64,' . base64_encode($display['image']) . '"/ height=300 width=300>';
    echo "<p class= title>";
    echo $display['foodname']. "<br/>";
    echo "</p>";
    echo "<p class= title2>";
    echo $display['description']. "<br/>";
    echo $display['rating']. "<br/>";
    echo "</p>";
    echo "</center>";
    }
}
?>

<center>    
<style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .title2 {
            font-family: "Helvetica";
            font_size: 18px;
            font-weight: bold;
            color: cadetblue;
            
        }
        .roundrect {
            border-radius: 15px;
        }
</style>   
    
<form action="ratingsystembackend.php" method="POST">
<p class="title">Choosing ratings:</p>
<br/>
<select name ="rating">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
</select>    




<form action="ratingsystembackend.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<p class="title"> What do you think of this delicacy? </p>
<textarea class="inputcat" type="text" cols="40" rows="5" name="content"></textarea>
<br>
<input type="submit" name="submit" value="Rate!"/>
</form>

<form action="" method="POST">
<p class="title"> Tag this delicacy! </p>
<input type="text" type="text" name="tag" placeholder="#tag it"/>
<input type="submit" name="submittag" value="Tag it!"/>    
</form>
</center>
<?php
    echo "<center>";
    echo "<h3>Tags</h3> <br/>";
    $getid = $_GET['id'];
    mysql_select_db("my_db");
    $retrievetags = mysql_query("SELECT * FROM tags");
    while($tags = mysql_fetch_assoc($retrievetags))
    {
        if($tags['assigned_to'] == $getid)
        {
            echo $tags['tag'] ." "; 
        }
        else
        {
            echo "no tags attached to this delicacy. <br/>";
        }
    }
    echo "<br/>";
?>

<?php
    echo "<h1>";
    echo "<center>";
    echo "<p class='title'> Reviews </p>";
    echo "</center>";
    $getid = $_GET['id'];
    echo "</h1>";
    $flagforreview = 0;
    mysql_select_db("my_db");
    $extractreviews = mysql_query("SELECT *FROM reviews");
    while($reviews = mysql_fetch_assoc($extractreviews))
    {
        if($reviews['assigned_to'] == $getid)
        {
            $flagforreview = 1;
            echo "<center>";
            $displayreviewers = $reviews['reviewer']. " wrote: ";
            echo "<p class = 'title'> $displayreviewers </p>";
            echo $displayreviews = $reviews['review'];
            echo "<button onclick=f1()>reply</button>";
            echo "<br/>";
            echo "</center>";
        }
        
    }
    if($flagforreview == 0)
    {
        echo "<center>";
        echo "<p class='title'> There are currently no reviews for this delicacy. </p> <br/>";
        echo "</center>";
    }
?>
<html>
    <script>
    function f1(){
        alert("<?php reply() ?>");
    }     
    </script>
    <?php
    function reply()
    {
        echo "Hey man";
        echo '<form action="" method="POST">  <input type="text" type="text" name="tag" placeholder="#tag it"/>
        <input type="submit" name="submittag" value="Tag it!"/>    
        </form>';
    }
    ?>
</html>





