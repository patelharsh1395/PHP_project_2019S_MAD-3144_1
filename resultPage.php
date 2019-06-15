<?php


session_start();

echo "result is : ".$_SESSION['score'];
$score = $_SESSION['score'];
$percentage = ($score/4)*100;
$conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "insert into scores(uid,eid,score,percentage,attempt_date) values('".$_SESSION['user_id']."',".$_SESSION['eid'].",".$score.",".$percentage.",curdate())";

if (mysqli_query($conn, $sql)) 
{
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



?>
<html>
<form action="usersHome.php" method='post'>
<input type='submit' value="Back to Home"> 
</form>
</html>