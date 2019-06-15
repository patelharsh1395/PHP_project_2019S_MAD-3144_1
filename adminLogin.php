
<?php 
session_start();



function print_error()
{
    echo "ERROR : Invalid user name and password.";
}
?>
<html>
<head>
<style type="text/css">
input[type=text], input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div.form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  height : auto;
  width : 80%;
  margin : auto;
  margin-top : 10%;
  
}
</style>
</head>
<body>

<div class='form'>
<h1>Admin Login</h1>
<form method="post" action="validateAdmin.php">
<label>Email id</label><input type="text" name="admin_id">

<label>Password</label><input type="password" name="pass">
<input type="submit" value="login">
<div id='error_message'>
<?php 
if(isset($_SESSION['error_message']))
{
    echo $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>
</div>
</form>
</div>
</body>

</html>