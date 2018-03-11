<?php
session_start();

 ?>
<html>
<head>
<link rel="stylesheet" href="stylesheet/welcome.css">
</head>
<body>
  <div class="box">
    <h1>Welcome<br><?php echo $_SESSION["Name"];?></h3>
    <p>ID: <?php echo $_SESSION["ID"];?></p>
    <p>E-mail: <?php echo $_SESSION["Email"];?></p>
    <p>Username: <?php echo $_SESSION["Username"];?></p>
</div>
</body>
</html>
