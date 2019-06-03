<!DOCTYPE html>
<?php    
// session_start();
// if(isset($_SESSION["admin"]))
// {
        
// }
// else {
//     header("Location: adminLogin.php"); 
// }



 ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
body
{
border : 2px solid black;
}
</style>
</head>
<body>



<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Users')">Users</button>
  <button class="tablinks" onclick="openTab(event, 'Exams')">Exams</button>
</div>

<div id="Users" class="tabcontent">
  <h3>Users</h3>
  <p><?php include 'Users.php';?></p>
</div>

<div id="Exams" class="tabcontent">
  <h3>Exam Page</h3>
  <p><?php include 'Exams.php';?></p> 
</div>



<script>

function openTab(evt, tab) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
  
}
</script>
   
</body>
</html> 
