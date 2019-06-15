<?php 
if(!isset($_SESSION['user_id']) & !isset($_SESSION['name']))
{
    header("Location: userlogin.php");
}

session_start();
if(isset($_GET['quiz']))
{   
    $queue = $_SESSION['question_queue'];
    $counter = $_SESSION['question_counter'];
    if((count($queue)-1) > $counter)
    {
        check_correct_or_not($_GET['quiz'],$queue[$counter] );
    }
    else 
    {
        $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "select opt_id from answers where qid = ".$queue[$counter] .";";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
            if($row['opt_id'] == $_GET['quiz'])
            {
                echo "inside if";
                $_SESSION['score']= $_SESSION['score']+1;
                mysqli_close($conn);
                
            }
        }
        header("Location: resultPage.php");
    }

}

function check_correct_or_not($opt_id, $qid)
{
    
    
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select opt_id from answers where qid = ".$qid.";";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      
       $row = mysqli_fetch_assoc($result);
        
           
            echo " answer :".$row['opt_id'];
            //$queue = $_SESSION['question_queue'];
            $counter = $_SESSION['question_counter'];
            if($row['opt_id'] == $opt_id)
            {
                echo "inside if";
                $_SESSION['score']= $_SESSION['score']+1;
                mysqli_close($conn);
             
            }
            
                $_SESSION['question_counter'] = $counter+1;
                
                
            
            
            
            header("Location: applyForExam.php");
    } 
    else 
    {
        echo "0 results";
    }
    
   
    
    
}

?>