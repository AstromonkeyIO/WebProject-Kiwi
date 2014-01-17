
<html>
 <style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .roundrect {
            border-radius: 10px;
            height: 22px;
            line-height: 22px;
            padding-left: 18px;
        }
        .roundbutton {
            border-radius: 10px;
            color: cadetblue;
            background: whitesmoke;
            height: 150px;
            width: 150px;
            font-weight: bold;
            font-size: 40px;
        }
</style>     

<body>
<?php

    $con = mysql_connect("localhost","root","root");
    if (!$con)
    {
      die('Could not connect: ' . mysql_error()); 
    }
    else
    {
       mysql_select_db("my_db", $con);
       $sql = "CREATE TABLE Persons
       (
       FirstName varchar(15),
       LastName varchar(15),
       Age int,
       )";
       mysql_close($con);

    }
    
?>

<?php
    $connection=mysqli_connect("localhost","root","root","my_db");
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    // Create table
    $sql="CREATE TABLE UserDataBase
    (
    Username varchar(15),
    Password varchar(15),
    Gender varchar(15),
    Age int,
    Favoritefood1 varchar(15),
    Favoritefood2 varchar(15),
    extra1 varchar(15),
    extra2 varchar(15)
    )";

    mysql_query('TRUNCATE TABLE UserDataBase;');

    $sql2 = "CREATE TABLE MenuDataBase
    (
    Foodname varchar(15),
    Fooddescription varchar(30),
    Nationality varchar(15),   
    Likes int,
    Dislikes int,
    Key1 varchar(15),
    Key2 varchar(15),
    Key3 varchar(15),
    Key4 varchar(15),
    Key5 varchar(15)
    )";

    $sql3 = "CREATE TABLE Image
    (
    imagename varchar(15),
    image BLOB)";

    $sql4 = "CREATE TABLE Image3
    (
    id INT NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY(id),
    imagename varchar(15),
    image LONGBLOB
    )";


    // Execute query
    if (mysqli_query($connection,$sql))
    {
        echo "Table UserDataBase created successfully";
    }
    else
    {
       //echo "Error creating table: " . mysqli_error($connection);
    }
    if (mysqli_query($connection,$sql2))
    {
        echo "Table UserDataBase created successfully";
    }
    else
    {
      //echo "Error creating table: " . mysqli_error($connection);
    }
    if (mysqli_query($connection,$sql4))
    {
        echo "Table image3 created";
    }
    else
    {
      //echo "Error creating table". mysqli_errror($connection);  
    }

    mysql_close($connection); 

    ?>

<center>

    <br>
    <br>
    <img src="kiwi.png" alt="app icon">
    <br>
    <br> 
    <a href="http://localhost:8888/PhpProject2/index2.php"> <button class="roundbutton" type="button">Login</button></a>
    <a href="http://localhost:8888/PhpProject2/index3.php"> <button class="roundbutton" type="button">New</button></a>
    <a href="http://localhost:8888/PhpProject2/addmenu.php"> <button class="roundbutton" type="button">Add</button></a>  
    <button onclick="callfunction2()" class="roundbutton" type="button">Add</button>
    <br>
    <br>

</center>

<script>
    
    function callfunction()
    {
        var request = new XMLHttpRequest();
        request.open('GET', 'service.php', false);
        request.send();
        if (request.status === 200) {
        alert(request.responseText);
        }
        //alert("<?php call(); ?>"); 
    }
    
</script>

</body>

</html>
        
        
      
     
    
      
      
      
        
        
        
        
        
        
        
        
        
 
        
        
        
        
        
        
        
        
