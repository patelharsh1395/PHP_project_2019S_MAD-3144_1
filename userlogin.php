
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
<form method="get" action="">
Email id<input type="text" name="user_id">

Password <input type="password" name="pass">
<input type="submit" value="submit">
</form>


</html>