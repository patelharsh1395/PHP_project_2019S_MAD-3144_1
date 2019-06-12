<?php 
session_start();
if(!isset($_SESSION['user_id']) & !isset($_SESSION['name']))
{
    header("Location: userlogin.php");
}


if(!isset($_SESSION['question_queue']))
{
    
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
                echo "<td class='card' >".$row['ename']."<form  action='applyForExam.php'><button class='button' type='submit' name='eid' value=".$row["eid"].">apply</form> </td>";
            }
            else
            {
                $counter=1;
                echo "</tr><tr>";
                echo "<td class='card' >".$row['ename']."<form  action='applyForExam.php'><button class='button' type='submit' name='eid' value=".$row["eid"].">apply</form> </td>";;
                
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

<?php 
display_data("select * from exam");


?>
</form>
</body>
</html>

