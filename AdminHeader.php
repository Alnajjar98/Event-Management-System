<?php
session_start();
if($_SESSION["role"] != 1)
    header("Location: LoginPage.php");
?>

<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>


<body>
    <div class="layer">
    
    <ul >
        <li><a  href="AdminHome.php"> Dashboard</a></li>
        <li><a  href="index.php"> Main Site</a></li>
        
  
        <li style="float:right"><a href="logout.php"> Logout</a></li>
  
</ul>
</div>
</body>
</html>
