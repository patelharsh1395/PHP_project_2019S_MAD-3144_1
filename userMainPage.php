<html><head>
</head>

<style>
table {
  border-collapse: collapse;
  width: 100%;
  font-size: 20px;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
aside 
{
    float: right;
}
body{
background-image: linear-gradient(to bottom, grey , white);
}

</style>
<script> 



</script> 
<body>
<header> 
<div>
<p style="float: right"><img src="Square.jpg" width="150px" height="150px"  style="margin-top: 0%; padding-top:0%; "></p>
<p>
<table style="width: auto">
<tr>
<th><lable> Name : Harsh Patel </lable></th>
</tr>
<tr>
<th><label> Program : Mobile application development</label></th>
</tr>
<tr>
<th><label> Id no. : C0748579</label></th>
</tr>
<tr>
<th><label> Email : patelharsh1395@gmail.com</label></th>
</tr>
</table>

</p>
</div>
<form> 

<input type="submit" name="but" class="button" value="logout" onclick="logout()">

</form> 
</header>
<main>
<br>
<br>
<table>

  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Savings</th>
  </tr>
  <tr>
    <td>Peter</td>
    <td>Griffin</td>
    <td>$100</td>
  </tr>
  <tr>
    <td>Lois</td>
    <td>Griffin</td>
    <td>$150</td>
  </tr>
  <tr>
    <td>Joe</td>
    <td>Swanson</td>
    <td>$300</td>
  </tr>
  <tr style="background-color: red; color: white; border:2px solid black">
    <td>Cleveland</td>
    <td>Brown</td>
    <td>$250</td>
</tr>
</table>

</main>

<?php 

if(isset($_GET['but']))
{
    header("Location: userlogin.php");
}





?>

</body>

</html>