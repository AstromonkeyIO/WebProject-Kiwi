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
            width: 120px;
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
    
    <legend align="center"> <p class="title"> Please try again </p></legend> 
    
    <center>
        <form action="http://localhost:8888/PhpProject2/index4.php" method="post">
            <p class="title"> 
            <br/>
            Username 
            <br/>
            <br/>
            <input type="text" placeholder="Enter Username" name="loginusername" required="required" class="roundrect"/> <br/>
            <br/>
            <br/>
            Password 
            <br/>
            <br/>
            <input type="password"placeholder="Enter Password" name="loginpassword" required="required" class="roundrect"/><br/>
            </p>
            <br/>
            <br/>
            <input type="submit"  value="submit" class="roundbutton2">
         </form>
       <br/>

      <p class="title">Don't have an account yet</p> <br>
      <br>
    <a href="http://localhost:8888/PhpProject2/index3.php"> <button type="button" class="roundbutton2">New User</button></a>
   
</fieldset> 
 </center>