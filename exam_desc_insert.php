<?php
session_start();
if(isset($_SESSION["exam_desc"]))
{
    create_new_exam($_POST["exam_description"]);
    
    header("Location: adminHome.php");
   
    
   //echo "<script>window.history.back();</script>";
}

function create_new_exam($desc)
{
    
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "insert into Exam(ename) values('".$desc."');";
    
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        die('Could not enter data: ' . mysqli_error());
        
    }
    mysqli_close($conn);
    
    
}




?>