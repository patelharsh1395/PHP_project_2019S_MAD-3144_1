<?php 
include 'encrypt_dec.php';

if(isset($_GET["user_id"]) & isset($_GET["pass"]))
 {
        $user_id = $_GET["user_id"];
        $pass =  encrypt_decrypt('encrypt', $_GET["pass"]);
        echo $pass;
      
       
    
    
        $conn = mysqli_connect('localhost:3306', 'root', '','questioneers');
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        $sql = "select * from users where uid='".$user_id."' and password='".$pass."';";
        $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['name'] = $row;
                
                header("Location: usersHome.php");
                
                
            }
            else
            {
                echo "login insucessful ***";
            }
            

       mysqli_close($conn);

        
        
}

?>
<html>
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
<body>

<div class='form'>
<h1>User Login</h1>
<form method="get" action="">
Email id<input type="text" name="user_id">

Password <input type="password" name="pass">
<input type="submit" value="login">
</form>
<form method="get" action="signUp.php">
<input type="submit" value="signup">
</form>
</div>
</body>
</html>