
<?php
ob_start();

mysql_connect("localhost","root","root");
mysql_select_db("ratingsystem");

echo "this is the id of the animal ";
global $id;
echo $id = $_GET['id'];

//process submission

if($_POST['submit'])//if the form has been submitted
{
    echo "This is the id of the animal after the form is submitted ";
    echo $id_post = $_POST['id'];
    $rating_post = $_POST['rating'];
    
    if(rating_post <= 5)
    {
    $get = mysql_query("SELECT * FROM animals WHERE id=$id_post");
    $get = mysql_fetch_assoc($get);
    $get = $get['rating'];
    
    if($get == 0)
        $newrating = $get + $rating_post;   
    else
        $newrating = ($get + $rating_post)/2;

    $update = mysql_query("UPDATE animals SET rating='$newrating' WHERE id = '$id_post'");
    //header("Location:index4.php");
    
    
    }
    else
    {
        echo "Don't fuck with our code! <br/>";
    }
}

if($_POST['submit_review'])
{
    echo "id of animal after review is submitted! ";
    echo $assign_id = $_POST['id'];
    $review = $_POST['content'];
    echo $review. "<br/>";
    mysql_select_db("my_db");
    mysql_query("INSERT INTO reviews VALUES ('','$review','$assign_id')");
    header("Location:index4.php"); 
}

?>

<center>
<form action="rate.php" method="POST">
Choosing ratings:<br/>
<select name ="rating">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
</select>    

<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<p/>

<input type="submit" name="submit" value="Rate!"/>

<form action="rate.php" method="POST">
<p> What do you think of this animal? </p>
<textarea class="inputcat" type="text" cols="40" rows="5" name="content"></textarea>
    <input type="submit" name="submit_review" value="upload text">
</form>

    
</form>
</center>
<?php
    echo "<h1>";
    echo "Reviews";
    echo "</h1>";
    mysql_select_db("my_db");
    $extractreviews = mysql_query("SELECT *FROM reviews WHERE assigned_to ='$id'");
    $count = 1;
    while($reviews = mysql_fetch_assoc($extractreviews) && $count < 10)
    {
        echo "<center>";
        echo $count;
        echo $displayreviews = $reviews['review'];
        echo "<br/>";
        echo "</center>";
        $count++;
    }
?>
