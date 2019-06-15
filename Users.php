<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
    header("Location: adminLogin.php");
}
if(isset($_GET['logout']))
{
    unset($_SESSION['admin_id']);
    header("Location: adminLogin.php");
}
function generateTable($sql_query)
{
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = $sql_query;
    $str="'";
    $result = mysqli_query($conn, $sql);
    $str= $str."<table>";
    $str= $str."<tr>";
    $str= $str."<th>Exam</th>";
    $str= $str."<th>User_id</th>";
    $str= $str."<th>Score</th>";
    $str= $str."<th>Percentage</th>";
    $str= $str."<th>Attempt_Date</th>";
    $str= $str."<th>Result</th>";
    $str= $str."</tr>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $str= $str."<tr>";
            $str= $str."<td>".$row['ename']."</td>";
            $str= $str."<td>".$row['uid']."</td>";
            $str= $str."<td>".$row['score']."</td>";
            $str= $str."<td>".$row['percentage']."</td>";
            $str= $str."<td>".$row['attempt_date']."</td>";
            if($row['percentage'] >= 80)
            {
                $str= $str."<td>Pass</td>";
            }
            else 
            {
                $str= $str."<td>Fail</td>";
            }
            $str= $str."</tr>";
            
        }
        $str= $str."</table>'";
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);
    return  $str;
}




?>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<script type="text/javascript">
var all;
var lowest;
var highest;
function displayAllData()
{
	document.getElementById("table").innerHTML = all;
}

function displayLowest()
{
	document.getElementById("table").innerHTML = lowest;
}
function displayHighest()
{
	document.getElementById("table").innerHTML = highest;
}




</script>
</head>
<body>
 <form method='get'>
   
   <input type='submit' name='logout' value='logout' />
  </form>
<div id="table"> 

</div>

<?php 

$sql_query_all = "select e.ename as ename , s.uid as uid, s.score as score, s.percentage as percentage , s.attempt_date as attempt_date
from exam as e inner join scores as s on e.eid = s.eid;";
$sql_query_lowest = "select e.ename as ename , s.uid as uid, s.score as score , s.percentage as percentage , s.attempt_date as attempt_date 
from exam as e inner join scores as s on e.eid = s.eid  where s.score  = (select min(score) from scores);";

$sql_query_highest = "select e.ename as ename , s.uid as uid, s.score as score , s.percentage as percentage , s.attempt_date as attempt_date 
from exam as e inner join scores as s on e.eid = s.eid  where s.score  = (select max(score) from scores);";
echo "<script> all =".generateTable($sql_query_all)."</script>";
echo "<script> lowest =".generateTable($sql_query_lowest)."</script>";
echo "<script> highest =".generateTable($sql_query_highest)."</script>";
?>
<table>
<tr>
<td>
<button  onclick="displayAllData()">Display All</button>
</td>
<td>
<button  onclick="displayLowest()">Lowest</button>
</td>
<td>
<button  onclick="displayHighest()">Highest</button>
</td>
</table>

</body>
</html>




