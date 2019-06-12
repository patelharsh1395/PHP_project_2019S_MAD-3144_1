<?php 

session_start();
if(!isset($_SESSION['user_id']) & !isset($_SESSION['name']))
{
    header("Location: userlogin.php");
}

$eid = $_GET['eid'];

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
function generate_options(){
    
}
if(!isset($_SESSION['question_queue']))
{
    $_SESSION['question_queue'] = generate_random_question_id($eid);
    
}

if(!isset($_SESSION['question_counter']))
{
    $_SESSION['question_counter']=0;
}

if(isset($_SESSION['score']))
{
    $_SESSION['score']=0;
}


function generate_question($qid) {
    
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select question from questions where qid = ".$qid.";";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        
            $sql_option = "select opt_id , option from options where qid = ".$row['qid'].";";
            $result_option = mysqli_query($conn, $sql);
            echo "Question ".($_SESSION['question_counter']+1)." ".$row['']."";
            if (mysqli_num_rows($result_option) > 0) {
                // output data of each row
                while($row_option = mysqli_fetch_assoc($result_option))
                {
                }
            }
        
    }
    else {
        echo "0 results";
    }
    
}




?>

<html>
<head></head>
<body>

</body>
</html>