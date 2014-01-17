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
            border-radius: 70px;
            height: 50px;
            color: steelblue;
            background: whitesmoke;
            width: 80px;
            font-weight: bold; 
        }
         .roundbutton2 {
            border-radius: 10px;
            color: steelblue;
            height:50px;
            width: 100px;
            background: white;
            font-weight: bold;
            font-size: 15px;
        }

</style>     

<center>
<fieldset>
    <legend align="center"> <p class ="title"> New User </p></legend>       
        <form enctype="multipart/form-data" action="http://localhost:8888/PhpProject2/index3.php" method="post">
        <p class="title"> Username: </p> <input type="text" name="newusername" required="required" class = "roundrect"/>
        <br/>
        <p class="title"> Password: </p> <input type="password" name="newpassword" required="required" class = "roundrect"/>
        <br/>
       
        <p class="title">
        Most Favorite type of food: <br/>
        <input type="checkbox" name="newuserfavoritefood" value="american"/> american 
        <input type="checkbox" name="newuserfavoritefood" value="chinese"/> chinese
        <input type="checkbox" name="newuserfavoritefood" value="mexican"/> mexican
        <input type="checkbox" name="newuserfavoritefood" value="italian"/> italian
        <input type="checkbox" name="newuserfavoritefood" value="japanese"/> japanese
        <input type="checkbox" name="newuserfavoritefood" value="thai"/> thai
        others <input type="text" name="other" value="other"/>
        <br/>
        <br/>
        <br/>
        Profile Picture <input type="file" name="image" required="required"/> 
        <br/>
        <br/>
        <input type="submit" value="Create!" class="roundbutton2">
        </p>
        <br/> 
    </form>
        
        
        </form>
</fieldset>
</center>

<br/>
<a href="http://localhost:8888/PhpProject2/index2.php"> <button type="button" class="roundbutton2">Login</button></a>


<?php
    $con = mysql_connect("localhost","root","root");
    
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("my_db", $con);

    $sql="INSERT INTO Persons (FirstName, LastName, Age)
    VALUES('$_POST[firstname]','$_POST[lastname]','$_POST[age]')";

    if (!mysql_query($sql,$con))
    { 
        die('Error: ' . mysql_error());
    }
 
    mysql_close($con);

?>  

<?php

    $con3 = mysql_connect("localhost","root","root");
    mysql_select_db("my_db", $con3);
    $username = $_POST['newusername'];
    echo $username;
    $findusername = mysql_query("SELECT * FROM users WHERE username ='$username'");
    $flag = 0;
    
    while($row = mysql_fetch_assoc($findusername))
    {
        if($row['username'] == $username)
        {
            $flag = 1;
        }

    }
    if($flag == 1)
    {    
        $url = 'index3.php';
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
        echo "<script type=\"text/javascript\">alert(':( Sorry the username you want is already taken');</script>";
    }
    //This section is for adding new users to Table UserDataBase
    $newusername = $_POST['newusername'];
    $newuserpassword = $_POST['newpassword'];
    $newuserfavoritefood1 = $_POST['newuserfavoritefood1'];
    $newuserfavoritefood2 = $_POST['newuserfavoritefood2'];

    echo $file = @$_FILES['image']['tmp_name'];

    if(!isset($_FILES['image']['tmp_name']))
    {
        //echo "Please select a file";   
    }
    else
    {
       //echo "image is in!";
       $image = addslashes(file_get_contents(@$_FILES['image']['tmp_name'])); //addslashes prevent unwanted sql
       //$imagename = addslashes(@$_FILES['image']['name']);
       $imagesize = getimagesize(@$_FILES['image']['tmp_name']); // checks if this is an image


       if($imagesize == FALSE)
       {
           //echo "That is not an image <br>";
       }

       else
       {
           //echo "That is an image <br>";


           if(!$insert = mysql_query("INSERT INTO users VALUES('','$_POST[newusername]','$_POST[newpassword]','$image','$_POST[newfavoritefood1]','$_POST[newfavoritefood2]')"))
           {
              // echo "Problem uploading image! <br>";

           }
           else
           {

           $lastid = mysql_insert_id();
           //echo "image uploaded. <p> your image <br>";
           //echo "<img src= 'get.php?id=$lastid' width='300' height='300'>";

           }

       }
    }

    if (!mysql_query($sql,$con3))
      { 
      die('Error: ' . mysql_error());
      }
    mysql_close($con3);

?>  