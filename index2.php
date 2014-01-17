
<?php

    session_destroy();
    session_start();

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
            border-radius: 10px;
            height: 22px;
            line-height: 22px;
            padding-left: 18px;
        }
        .roundbutton {
            border-radius: 20px;
            height: 30px;
            color: steelblue;
            background: whitesmoke;
            width: 80px;
            font-weight: bold; 
        }
      
        
</style>     
    
<center>
<fieldset>
    
         <legend align ="center"><p class="title">Login User</p></legend>   
         <form action="http://localhost:8888/PhpProject2/index2.php" method="post"/>
            <p class="title">Username</p> <br/> 
            <input type="text" name="loginusername" placeholder="Enter Username" required="required" class="roundrect"/> <br/>
            <p class="title">Password</p> <br/>
            <input type="password" name="loginpassword" placeholder="Enter Password" required="required" class="roundrect"/> <br/>
            <br/>
            <br/>
            <input type="submit"  name="submit" value="submit" class="roundbutton">
         </form> 
</fieldset> 
</center>
</html>


<?php

    if($_POST['submit'])
    {
        session_start();
        $_SESSION['username'] = $_POST['loginusername'];
        $_SESSION['password'] = $_POST['loginpassword'];
        $_SESSION['userid'];
        $_SESSION['usertaste'];
        $url = 'http://localhost:8888/PhpProject2/index4.php';
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
    }

?>