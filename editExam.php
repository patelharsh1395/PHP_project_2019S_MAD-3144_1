<?php


session_start();
// if()
// {
    
// }




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

function validateForm()
{
    var a=document.getElementByName("answer_a").value;
    var b=document.getElementByName("answer_b").value;
    var c=document.getElementByName("answer_c").value;
    var d=document.getElementByName("answer_d").value;
    var e=document.getElementByName("answer_e").value;
    if (a== null || a== "",b == null || b == "",c == null || c == "",d==null || d == "", e == null || e=="")
    {
        alert("Please Fill All Required Field");
        return false;
    }
}
</script>
</head>
<body>

<?php 



?>
update
<br>
<form method="post"   action="">
Question : <input type="text" name="answer_e">
<br>
option 1 : <input type="text" name="answer_a">
<br>
option 2 : <input type="text" name="answer_b">
<br>
option 3 : <input type="text" name="answer_c">
<br>
option 4 : <input type="text" name="answer_d">
<br>
<input type="submit" class="button" onclick="validateForm()" value="submit">
</form>
<hr>

new 

<form method="post" action="">
Question : <input type="text" name="exam_description">
<br>
option 1 : <input type="text" name="exam_description">
<br>
option 2 : <input type="text" name="exam_description">
<br>
option 3 : <input type="text" name="exam_description">
<br>
option 4 : <input type="text" name="exam_description">
<br>
<input type="submit" class="button" value="submit">


</body>
</html>