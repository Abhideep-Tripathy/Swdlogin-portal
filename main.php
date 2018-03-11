
<?php
session_start();
if (isset($_POST['button1']))
{
  $var_username=$_POST["Username"];
  $var_password=$_POST["Password"];
  $_SESSION['Usern']=$var_username;
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "LoginData";
  $conn = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

  if(!$conn)
    die("Connection failure");
  if( $var_username  !='' && $var_password !='' )
  {
    $sql_extract="SELECT Username FROM userDetails where Username='$var_username'";
    $result = mysqli_query($conn , $sql_extract);
    $count = mysqli_num_rows($result);

    if($count===1)
    {
      $sql_pass_extract="SELECT * FROM userDetails where Username='$var_username'";
      $hassed_pass=mysqli_query($conn, $sql_pass_extract);
      $hassed_pass_object= mysqli_fetch_object($hassed_pass);
      $hassed_pass_string= $hassed_pass_object->Password;
      $count = mysqli_num_rows($hassed_pass);
      if($count===1)
      {

        if(password_verify($var_password,$hassed_pass_string))
        {
          $message = 'Successfully logged in';
          echo "<script type='text/javascript'>alert('$message');</script>";

          $_SESSION["Name"] = $hassed_pass_object->Name;
          $_SESSION["ID"] = $hassed_pass_object->ID;
          $_SESSION["Email"] = $hassed_pass_object->Email;
          $_SESSION["Username"] = $hassed_pass_object->Username;
          $_SESSION["Password"] = $hassed_pass_object->Password;

          header("Location: ./welcome.php");
        }
        else
        {
          $message= 'Incorrect Username or Password';
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
      }
      else
      {
        $message= 'Incorrect Username or Password';
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }
    else
    {
      $message= 'Invalid Username or Password';
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }

  else
  {
    $message ='Fill both the required fields';
    echo "<script type='text/javascript'>alert('$message');</script>";
  }

mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Portal</title>
    <link rel="stylesheet" href="stylesheet/main.css">
  </head>
  <body>
    <div class="box">
      <h1>WELCOME TO LOGIN PORTAL</h1>
      <img class="logo" src="BITS.png" alt="BITS LOGO">
      <form method="post">
        <label>Username:</label>
        <input type="text" name="Username" ></input><br><br>
        <label>Password :</label>
        <input type="password" name="Password" ></input><br><br>
        <a href="./signUp.php">New user? sign up</a><br>
        <input type="submit" value="SUBMIT" name='button1' class="button"></input>
      </form>
    </div>
  </body>
</html>
