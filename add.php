<html>
<fieldset>
    <legend>Add Animal</legend>       
        <form action="add.php" method="POST">
        Name: <input type="text" name="newanimal">
        <br/>
        <input type="submit" name="submit" value="submit">
        <br/>
        </form>
</fieldset>

<?php
if($_POST['submit'])
{
    mysql_connect("localhost","root","root");
    mysql_select_db("ratingsystem");
    
    echo $newanimal = $_POST['newanimal'];
    if(mysql_query("INSERT INTO animals VALUES ('','$newanimal','')"))
    {
        echo "successful";
        echo "<script type=\"text/javascript\">alert('Your animal has been submitted!');</script>";
        header("Location:index4.php");
    }
    else
    {
        echo "not";
    }
    
    //mysql_close();
    
    
    
}






?>
