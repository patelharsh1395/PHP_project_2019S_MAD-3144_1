<?php


session_start();
if(isset($_GET["eid"]))
{
    $eid = $_GET["eid"];
}





function insert_question_options($eid, $question , $option1, $option2, $option3, $option4 , $ans)
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
        if($ans == 1)
        {
            $sql = "insert into answers(opt_id, qid) values((select max(opt_id) from options),(select max(qid) from questions))";
            $result = mysqli_query($conn, $sql);
        }
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option2."');";
        $result = mysqli_query($conn, $sql);
        if($ans == 2)
        {  
        $sql = "insert into answers(opt_id, qid) values((select max(opt_id) from options),(select max(qid) from questions))";
            $result = mysqli_query($conn, $sql);
        }
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option3."');";
        $result = mysqli_query($conn, $sql);
        if($ans == 3)
        {
            $sql = "insert into answers(opt_id, qid) values((select max(opt_id) from options),(select max(qid) from questions))";
            $result = mysqli_query($conn, $sql);
        }
        $sql = "insert into options(qid, option) values((select max(qid) from questions),'".$option4."');";
        $result = mysqli_query($conn, $sql);
        if($ans == 4)
        {
            $sql = "insert into answers(opt_id, qid) values((select max(opt_id) from options),(select max(qid) from questions))";
            $result = mysqli_query($conn, $sql);
        }
       
       
    }
    
    mysqli_close($conn);
}

function generate_update_data($eid)
{
   
    
    // Create connection
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select qid, question from questions where eid=".$eid." ; ";
    $result = mysqli_query($conn, $sql);
    $count_question = 0;
   
    if (mysqli_num_rows($result) > 0) {
      
        
        while($row = mysqli_fetch_assoc($result)) {
            echo "<form method='post'   action=''> ";
            $answer_arr=[];
            $count_question+=1;
            echo "<br>Question ".$count_question." : <input type='text' name='quest_option' required value='".$row["question"]."'>";
            $sql_options = "select  opt_id , option from options where qid = ".$row["qid"].";";
            $result_options = mysqli_query($conn, $sql_options);
            $sql_ans = "select * from answers where qid =".$row['qid']." ;";
            $result_ans = mysqli_query($conn, $sql_ans);
            $row_ans = mysqli_fetch_assoc($result_ans);
           
            
            $counter = 0;
            
            
            if(mysqli_num_rows($result_options) > 0)
            {
                $count_options = 0;
                
                while ($row_options = mysqli_fetch_assoc($result_options) ) {
                    $count_options+=1;
                    if(mysqli_num_rows($result_ans) > 0)
                    {
                       
                        
                        
                        if($row_ans['opt_id'] == $row_options['opt_id'])
                            {
                                
                               
                                $counter = $count_options;
                            }

                        
                    }
                    array_push($answer_arr, $row_options['opt_id']);
                    echo "<br>option ".$count_options." : <input type='text' id=".$count_options." name='".$count_options."_option' value='".$row_options['option']."' required>";
                }
           
                $sql_options = "select  opt_id , option from options where qid = ".$row["qid"].";";
                $result_options = mysqli_query($conn, $sql_options);

                echo "<br><select name='ans_option'>";
                //option 1
                if($counter == '1')
                {
                    
                    echo "<option value='".$answer_arr[0]."' selected>option 1</option>";
                }
                else 
                {
                    echo "<option value='".$answer_arr[0]."' >option 1</option>";
                }
                
                // option 2
                if($counter == '2')
                {
                    
                    echo "<option value='".$answer_arr[1]."' selected>option 2</option>";
                }
                else
                {
                    echo "<option value='".$answer_arr[1]."' >option 2</option>";
                }
                // option 3
                if($counter == '3')
                {
                    echo "<option value='".$answer_arr[2]."' selected>option 3</option>";
                }
                else
                {
                    echo "<option value='".$answer_arr[2]."' >option 3</option>"; 
                }
                // option 4
                if($counter == '4')
                {
                    echo "<option value='".$answer_arr[3]."' selected>option 4</option>";
                }
                else
                {
                    echo "<option value='".$answer_arr[3]."' >option 4</option>";
                }
                  

                echo "</select>";
                echo "<input type='hidden' name='question_id' value=".$row['qid'].">";
                echo "<br><input type='submit' value='update'>";
                    
            }
            echo "</form>";
        }
        
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);
}
function update_value()
{
//     echo $_POST['quest_option']."<br>";
//     echo $_POST['1_option']."<br>";
//     echo $_POST['2_option']."<br>";
//     echo $_POST['3_option']."<br>";
//     echo $_POST['4_option']."<br>";
//     echo $_POST['ans_option']."<br>";
    
    
    
    
    // Create connection
    $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "update questions set question = '".$_POST['quest_option']."' where qid = ".$_POST['question_id']."";
    
   
    if (mysqli_query($conn, $sql)) 
    {
           $sql = "select opt_id from options where qid =".$_POST['question_id']." order by opt_id asc;";
           $result =  mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0)
           {
               
               $arr = [];
               while ($row = mysqli_fetch_assoc($result) ) 
               {
                   echo $row['opt_id']."--";
                   array_push($arr, $row['opt_id']);
               }
               
               echo $_POST['3_option'];
               $sql = "update options set option = '".$_POST['1_option']."' where opt_id = ".$arr[0]."; ";
               mysqli_query($conn, $sql);
               $sql = "update options set option = '".$_POST['2_option']."' where opt_id = ".$arr[1]."; ";
               mysqli_query($conn, $sql);
               $sql = "update options set option = '".$_POST['3_option']."' where opt_id = ".$arr[2]."; ";
               mysqli_query($conn, $sql);
               $sql = "update options set option = '".$_POST['4_option']."' where opt_id = ".$arr[3]."; ";
               mysqli_query($conn, $sql);
               
               $sql = "update answers set  opt_id = ".$_POST['ans_option']." where  qid =".$_POST['question_id'].";";
               mysqli_query($conn, $sql);
           }
       
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}


if(isset($_POST["quest"]) & isset($_POST["answer_a"]) & isset($_POST["answer_b"]) & isset($_POST["answer_c"]) & isset($_POST["answer_d"]) & isset($_POST["ans"]) )
{
    
    insert_question_options($eid,$_POST["quest"], $_POST["answer_a"], $_POST["answer_b"], $_POST["answer_c"], $_POST["answer_d"] , $_POST["ans"] );
}

if(isset($_POST["quest_option"]) & isset($_POST["1_option"]) & isset($_POST["2_option"]) & isset($_POST["3_option"]) & isset($_POST["4_option"]))
{
    echo "inside if stat****";
    update_value();
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
        var f=document.Form.ans.value;
            if (a.trim()==null || a.trim()== "" || b.trim() == null || b.trim()== "" || c.trim() == null || c.trim()== "" || d.trim()==null || d.trim() == "" || e.trim()== null || e.trim()=="" )
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
 <br>
 <select name='ans'>
  <option value="1">option 1</option>
  <option value="2">option 2</option>
 <option value="3">option 3</option>
  <option value="4">option 4</option>
</select>
<button type="button" class="button" onclick="validateForm('Form')">Submit</button>
</form>
<hr>

 
 
 <?php

 
 
 generate_update_data($eid);
 
 
 
 
 ?>



</body>
</html>