<?php
session_start();
include('connect.php');
$getid = $_GET['id'];
displaymessage($getid);
?>




<?php
function displaymessage($searchid) {
    $retrievemessages = mysql_query("SELECT * FROM message WHERE id='$searchid'");
    $processmessages = mysql_fetch_assoc($retrievemessages);
    $displayusername = findusername($processmessages['sender_id']);
    echo "<center>";
    echo "From: ".$displayusername."<br/>";
    echo "message: ".$processmessages['message']."<br/>";
    echo "</center>";
}

function findusername($searchid)
{
    $finduser = mysql_query("SELECT * FROM users WHERE id='$searchid'");
    $displayuser = mysql_fetch_assoc($finduser);
    return $displayuser['username'];
    
}


?>