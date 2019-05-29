<html><head>


<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password], select {
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

input[type=submit]:hover  {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.validation
{
    margin-top : 0%;
    padding-top : 0%;
    color:red;
    font-style: italic;
}

#center
            {
                left: 50%;top: 50%;
                position: absolute;
                transform: translate(-50%, -50%);
            }
            
           
           
</style>
</head>



<body>
<h1 style="text-align:center;"> College Library </h1>
<div class="card" id="center">


<form action="post" >
<label for="uid">User ID</label>
<input type="text" id="uid" name="uid" placeholder="User id..">
<div id="uid_validation" class="validation">invalid username</div>

<label for="pass">Password</label>
<input type="password" id="pass" name="pass" placeholder="Password..">
<div id="pass_validation" class="validation">invalid password</div>
<br>
<input type="submit" value="submit">




</form>




</div>
</body>

</html>










