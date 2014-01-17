<style type ="text/css">
        .title {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color: steelblue;
        }
        .title2 {
            font-family: "Helvetica";
            font-size: 20px;
            font-weight: bold;
            color:cadetblue;
        }
        .title3 {
            font-family: "Helvetica";
            font-size: 20px;
            
        }
        .title4 {
            font-family: "Helvetica";
            font-size: 18px;
            font-weight: bold;
            color:darkred;
        }
        .roundrect {
            border: 2px;
            border-radius: 15px;
        }
        .roundbutton {
            border-radius: 10px;
            color: steelblue;
            height:150px;
            width: 150px;
            background: white;
            font-weight: bold;
            font-size: 40px;
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
        .backgroundimage {
            height: 300px;
            width: 200px;
        }
        .position1 {
		position:absolute;
		top: 11px;
		left: 11px;
	}       
</style>   




<?php
mysql_connect("localhost","root","root");
mysql_select_db("ratingsystem");
//echo '<div class="TEdit" id="Edit3" style="position: absolute; top:50px;">';

$search = $_POST['search'];
$parsefoodname = array();
$parsefoodname = explode(" ", $search);
$sizeofparse = sizeof($parsefoodname);

$findfood = mysql_query("SELECT * FROM food");
while($result = mysql_fetch_assoc($findfood))
{
    if($result['foodname'] == $search)
    {
    echo "<br/>";
    echo "<br/>";
    echo "<center>";
    echo "<p class='title'>";
    echo "Search found! <br/>";
    echo "</p>";
    echo '<img class="roundbutton" src="data:image/png;base64,' . base64_encode($result['image']) . '"/>';
    echo "<br/>";
    echo "<p class='title'>";
    echo $result['foodname'];
    echo "</p>";
    echo "<br/>";
    echo "<p class='title2'>";
    echo $result['description'];
    echo "<br/>";
    echo $result['rating'];
    echo "</p>";
    echo "<br/>";
    $idf = $result['id'];
    echo "<a href='ratingsystembackend.php?id=$idf'><button>Vote This</button></a>";
    echo "</br>";
    echo "</br>";
    echo "</center>";
    break;
    }
}

foreach ($result['id'] as $key => $value) {
  print($value); // user id
  print($result['foodname'][$key]);
  print($result['description'][$key]);
}




$findfood2 = mysql_query("SELECT * FROM food");
while($result = mysql_fetch_assoc($findfood2))
{

    for($i = 0; $i < $sizeofparse; $i++)
    {
        if($result['type'] == $parsefoodname[$i])
        {
            echo "<center>";
            echo "<p class='title2'>";
            echo "Search Result For ";
            echo "</p>";
            echo "<p class='title'>";
            echo "Keyword: ";
            echo "</p>";
            echo "<p class='title4'>";
            echo $result['type'];
            echo "</p>";
            echo "<br/>";
            echo '<img class="roundbutton" src="data:image/png;base64,' . base64_encode($result['image']) . '"/>';
            echo "<br/>";
            echo "<p class='title'>";
            echo $result['foodname'];
            echo "</p>";
            echo "<br/>";
            echo "<p class='title2'>";
            echo $result['description'];
            echo "<br/>";
            echo $result['rating'];
            echo "</p>";
            echo "<br/>";
            $idf = $result['id'];
            echo "<a href='ratingsystembackend.php?id=$idf'><button>Vote This</button></a>";
            echo "<br/>";
            echo "<br/>";
            echo "</center>";
        }
        mysql_select_db("my_db");
        $findtag = mysql_query("SELECT * FROM tags");
        while($findtagprocess = mysql_fetch_assoc($findtag))
        {
            $processedtag = substr($findtagprocess['tag'], 1);
            if($processedtag == $parsefoodname[$i])
            {
                $assignedidtag = $findtagprocess['assigned_to'];
                mysql_select_db("ratingsystem");
                $findfoodbasedontag0 = mysql_query("SELECT * FROM food WHERE id ='$assignedidtag'");
                $findfoodbasedontag = mysql_fetch_assoc($findfoodbasedontag0);
                echo "<center>";
                echo "<p class='title2'>";
                echo "Search Result For ";
                echo "</p>";
                echo "<p class='title'>";
                echo "Tag: ";
                echo "</p>";
                echo "<p class='title4'>";
                echo "#".$processedtag;
                echo "</p>";
                echo "<br/>";
                echo '<img class="roundbutton" src="data:image/png;base64,' . base64_encode($findfoodbasedontag['image']) . '"/>';
                echo "<br/>";
                echo "<p class='title'>";
                echo $findfoodbasedontag['foodname'];
                echo "</p>";
                echo "<br/>";
                echo "<p class='title2'>";
                echo $findfoodbasedontag['description'];
                echo "<br/>";
                echo $findfoodbasedontag['rating'];
                echo "</p>";
                echo "<br/>";
                $idf = $findfoodbasedontag['id'];
                echo "<a href='ratingsystembackend.php?id=$idf'><button>Vote This</button></a>";
                echo "<br/>";
                echo "<br/>";
                echo "</center>";  
            }
            
        }
        
    }       
}





//echo '</div>';
?>