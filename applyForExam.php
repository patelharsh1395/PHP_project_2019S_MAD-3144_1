<?php 

session_start();
if(!isset($_SESSION['user_id']) & !isset($_SESSION['name']))
{
    header("Location: userlogin.php");
}
$eid=0;


if(!isset($_SESSION['eid']))
{
   $_SESSION['eid'] = $_GET['eid'];
   $eid = $_SESSION['eid'];
}
else {
    $eid = $_SESSION['eid'];
}

if(!isset($_SESSION['question_queue']))
{
    $_SESSION['question_queue'] = generate_random_question_id($eid);
    
}

if(!isset($_SESSION['question_counter']))
{
    $_SESSION['question_counter']=0;
}

if(!isset($_SESSION['score']))
{
    $_SESSION['score']=0;
}

function generate_random_question_id($eid)
{
    
    $question_order =[];
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select qid from questions where eid=".$eid." order by rand();";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            array_push($question_order, $row['qid']); 
        }
    } 
    else {
        echo "0 results";
    }
    
    mysqli_close($conn);
    return  $question_order;
    
}




function generate_question($qid) {
    
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "select question from questions where qid = ".$qid.";";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) 
    {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        echo "Question ".($_SESSION['question_counter']+1)." ".$row['question']."<br>";
            $sql_option = "select opt_id , option from options where qid = ".$qid.";";
            $result_option = mysqli_query($conn, $sql_option);
            
            if(mysqli_num_rows($result_option) > 0) {
                // output data of each row
                echo "<form action='afterSubmit.php' method='get'>";
                while($row_option = mysqli_fetch_assoc($result_option))
                {
                    echo "<br><input type='radio' name='quiz' value=".$row_option['opt_id']."> ".$row_option['option']." ".$row_option['opt_id'];
                    
                }
                echo "<div id='correct_ans'></div>";
                echo "<input type='submit' value='submit' id='submit'>";
                echo "</form>";
                
            }
        
    }
    else {
        echo "0 results";
    }
    
}




?>

<html>
<head>
<script type="text/javascript">
function set_message(div_id, message)
{
	document.getElementById(div_id).innerHTML = message;
	
	
}

</script>
</head>
<body>
<?php
$queue = $_SESSION['question_queue'];
echo "array count ".count($queue)."<br>";
$counter = $_SESSION['question_counter'];
echo "qid before submit : ".$queue[$counter]."<br>";
echo "score :".$_SESSION['score']."<br>";
echo "counter : ".$_SESSION['question_counter'];



generate_question($queue[$counter]);

?>
</body>
</html>