<?php


session_start();
$eid = $_GET["eid"];


function validate()
{
    
}
function insert_question_options($eid, $question , $option1, $option2, $option3, $option4 )
{
   
  
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
  
    // Check connection
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql = "insert into questions(eid,question) values(".$eid.",'".$question."');";
    
    
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Could not enter data: ' . mysqli_error($conn));
        
    }
     else 
    {   
       
    
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option1."');";
        $result = mysqli_query($conn, $sql);
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option2."');";
        $result = mysqli_query($conn, $sql);
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option3."');";
        $result = mysqli_query($conn, $sql);
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option4."');";
        $result = mysqli_query($conn, $sql);
        
    }
    
    mysqli_close($conn);
}
function update_data($eid)
{
   
    
    // Create connection
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select qid, question from questions where eid=".$eid."; ";
    $result = mysqli_query($conn, $sql);
    $count_question = 0;
    if (mysqli_num_rows($result) > 0) {
        
        echo "<form method='post' name='Form2'  action=''> ";
        while($row = mysqli_fetch_assoc($result)) {
            $count_question+=1;
            echo "<br>Question ".$count_question." : <input type='text' name='quest_options' required value='".$row["question"]."'>";
            $sql_options = "select  opt_id , option from options where qid = ".$row["qid"].";";
            $result_options = mysqli_query($conn, $sql_options);
            if(mysqli_num_rows($result_options) > 0)
            {
                $count_options = 0;
                
                while ($row_options = mysqli_fetch_assoc($result_options) ) {
                    $count_options+=1;
                    echo "<br>option ".$count_options." : <input type='text' name=".$row_options['opt_id']." value='".$row_options['option']."' required>";
                }
                echo "<br><button type='button' class='button' onclick=''>update</button>";
            }
           
        }
        echo "</form>";
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);
}

if(isset($_POST["quest"]) & isset($_POST["answer_a"]) & isset($_POST["answer_b"]) & isset($_POST["answer_c"]) & isset($_POST["answer_d"]) )
{
    echo "inside if";
    insert_question_options($eid,$_POST["quest"], $_POST["answer_a"], $_POST["answer_b"], $_POST["answer_c"], $_POST["answer_d"]);
}
else {
    echo "Hello world";
}

?>
<html><head>
<style type="text/css">
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
body
{
border : 2x solid black;
}
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
} 
</style>
<script type="text/javascript">

function validateForm($form)
{

// 	    var a=document.Form.answer_a.value;
// 	    var b=document.forms["Form"]["answer_b"].value;
// 	    var c=document.forms["Form"]["answer_c"].value;
// 	    var d=document.forms["Form"]["answer_d"].value;
// 	    var e=document.forms["Form"]["answer_e"].value;
	if($form=="Form")
	{
        var a=document.Form.answer_a.value;
        var b=document.Form.answer_b.value;
        var c=document.Form.answer_c.value;
        var d=document.Form.answer_d.value;
        var e=document.Form.quest.value;
            if (a.trim()==null || a.trim()== "" || b.trim() == null || b.trim()== "" || c.trim() == null || c.trim()== "" || d.trim()==null || d.trim() == "" || e.trim()== null || e.trim()=="")
            {
                alert("Please Fill All Required Field");
                return false;
            }
            else
            {
               
            	  document.forms["Form"].submit();
            }
	}
	else
	{
		var a=document.Form.answer_a.value;
        var b=document.Form.answer_b.value;
        var c=document.Form.answer_c.value;
        var d=document.Form.answer_d.value;
        var e=document.Form.quest.value;
		if (a.trim()==null || a.trim()== "" || b.trim() == null || b.trim()== "" || c.trim() == null || c.trim()== "" || d.trim()==null || d.trim() == "" || e.trim()== null || e.trim()=="")
        {
            alert("Please Fill All Required Field");
            return false;
        }
        else
        {
           
        	  document.forms["Form"].submit();
        }
		
	}
}
</script>
</head>
<body>


new
<br>
<form method="post" name="Form"  action="">
Question : <input type="text" name="quest" required>
<br>
option 1 : <input type="text" name="answer_a" required>
<br>
option 2 : <input type="text" name="answer_b" required>
<br>
option 3 : <input type="text" name="answer_c" required>
<br>
option 4 : <input type="text" name="answer_d" required>
<br>
<button type="button" class="button" onclick="validateForm('Form')">Submit</button>
</form>
<hr>
 </form>
 
 
 <?php 
 
 update_data($eid);
 
 ?>



</body>
</html>