<?php 


?>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST" action="">
	Name: <input type="text" name="name"> <br>
	<div> <?php 
	if(isset($_POST['password']))
	{
	    $name = validate($_POST['name']);
	    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
	        $nameError = 'Name can only contain letters, numbers and white spaces';
	        echo $nameError;
	}
	
    
	?>
	</div>
	Email: <input type="text" name="email"> <br>
	<div><?php 
	if(isset($_POST['email']))
	{
	    $email = validate($_POST['email']);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        $emailError = 'Invalid Email';
	        echo $emailError;
	    }
	    
	}
		echo $emailError;
	?></div>
	Password: <input type="password" name="password"> <br>
	<div>
	<?php 
	if(isset($_POST['password']))
	{
    	$password = validate($_POST['password']);
    	if (strlen($password) < 6) {
    	    $passwordError = 'Please enter a long password';
    	    echo $passwordError;
    	}
	}
	?></div>
	Re-enter password: <input type="password" name="reenter"> <br>
	<div><?php
	if(isset($_POST['password']) && isset($_POST['reenter']))
	{
    	if($_POST['password'] != $_POST['reenter'])
    	{
    	       echo "Password does not match"; 
    	}
	}
	
	?></div>
	
	Address : <textarea name="Address"></textarea> <br>
	<div><?php 
	if(isset($_POST['Address']))
	{
	    if(empty($_POST['Address']))
    	   {
    	       echo "address cannot be empty";
    	   }
	}
	?></div>
	Gender: Male<input type="radio" name="gender" value="male"> Female<input type="radio" name="gender" value="female"><br>
	<div><?php
	
	if(isset($_POST['gender']))
	{
	    if(empty($_POST['gender']))
	    {
	        echo "radio button should be selected";
	    }
	}
	?></div>
	
</form>
</body>
</html>