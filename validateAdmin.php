<?php
session_start();
include 'encrypt_dec.php';
if(isset($_POST["admin_id"]) & isset($_POST["pass"]))
{
    
    
    
    $admin_id = $_POST["admin_id"];
    $pass =  encrypt_decrypt('encrypt', $_POST["pass"]);
    
    
    
    if($admin_id == "admin" && $pass == "U1l0SzNCMHN5SmEraXMvY3NTMkZVUT09")
    {
        $_SESSION['admin_id']= $_POST['admin_id'];
        header("Location: adminHome.php");
        
    }
    else
    {
        $_SESSION['error_message'] = "ERROR : Invalid user name and password.";
        header("Location: adminLogin.php");
    }
    
}

?>