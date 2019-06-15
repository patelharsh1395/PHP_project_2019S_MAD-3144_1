<?php

if(!isset($_SESSION['admin_id']))
{
    header("Location: adminLogin.php");
}
if(isset($_GET['logout']))
{
    unset($_SESSION['admin_id']);
    header("Location: adminLogin.php");
}
if(isset($_POST['delete_exam']))
{
    deleteExam($_POST['delete_exam']);
}
function deleteExam($eid)
{
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // sql to delete a record
    $sql = "DELETE FROM exam WHERE eid=".$eid.";";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
function display_data($data)
{
    
    $counter = 0 ;
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = $data;
    
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        
        echo "<table style='border-spacing:20px;'> <tr>";
        while($row = mysqli_fetch_assoc($result)) {
            if($counter < 2)
            {
                $counter+=1;
                echo "<td class='card' >".$row['ename']."<form  action='editExam.php'><button class='button' type='submit' name='eid' value=".$row["eid"].">open</button></form>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='delete_exam' value=".$row['eid'].">";
                echo "<input type='submit' class='button' name='Delete'  value='Delete'>";
                echo "</form>";
                echo "</td>";
            }
            else
            {
                $counter=1;
                echo "</tr><tr>";
                echo "<td class='card' >".$row['ename']."<form  action='editExam.php'><button class='button' type='submit' name='eid' value=".$row["eid"].">open</button></form>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='delete_exam' value=".$row['eid'].">";
                echo "<input type='submit' class='button' name='Delete'  value='Delete'>";
                echo "</form>";
                echo "</td>";
            }
        }
        echo "</tr></table>";
        
    } else {
        echo "no of rows is 0";
        
    }
    mysqli_close($conn);
    
}


?>
<html>
<head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 10%;
  padding : 60px;
  border-radius: 20px;
   
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.button {
  background-color: #4CAF50;
  border-radius: 10px;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
input[type=text] {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}


</style>
<script>
function onclick_card(message)
{
	
	
	
	//window.location.href = "editExam.php";
}

</script>
</head>
<body>
<form method='get'>
   
   <input type='submit' name='logout' value='logout' />
  </form>
<?php 
display_data("select * from exam");


// if(isset($_POST["exam_description"]))
// {
//     $_SESSION["exam_desc"] = $_POST["exam_description"];
//     header("Location: exam_desc_insert.php"); 
// }



?>
<form method="post" action="exam_desc_insert.php">
Exam description : <input type="text" name="exam_description">
<input type="submit" class="button" value="submit">
</form>
</body>
</html>

