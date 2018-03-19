<?php
if (isset($_POST['button1']))
{
  $var_name= $_POST["Name"];
  $var_Id= $_POST['ID'];
  $var_Email= $_POST['Email'];
  $var_username= $_POST["Username"];
  $var_password= $_POST["Password"];
  $hassed_pass= password_hash($var_password, PASSWORD_DEFAULT);
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";

  $pass_len=strlen($var_password);
  $reg_alpha=preg_match("/[a-zA-Z]+/",$var_password);
  $reg_num=preg_match("/[0-9]+/",$var_password);
  $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
  $reg_special=preg_match($pattern, $var_password);

if($var_username !='' && $var_password !='' && $var_Id !='' && $var_Email !='' && $var_name !='' )
{
  if($pass_len>8 && $reg_alpha && $reg_num && $reg_special)
  {
  $conn = mysqli_connect($dbhost,$dbuser,$dbpass);
  if(!$conn)
    die('not connected');

    $createDB ="CREATE DATABASE LoginData;";
    $result = mysqli_query( $conn , $createDB);

    mysqli_select_db($conn,'LoginData');

    $createTable= "CREATE TABLE userDetails( ".
            "Name char(40) NOT NULL,".
            "ID VARCHAR(20),".
            "Email VARCHAR(30),".
            "Username VARCHAR(40) NOT NULL, ".
            "Password VARCHAR(100) NOT NULL, ".
            "PRIMARY KEY ( Username )); ";

            mysqli_query( $conn , $createTable );
            
      $sql_insert="INSERT INTO userDetails ".
      "VALUES('$var_name','$var_Id','$var_Email','$var_username', '$hassed_pass');";
      mysqli_query($conn,$sql_insert);
      mysqli_close($conn);
        echo "<script type='text/javascript'>alert('Account Created');</script>";
  }
  else
  echo "<script type='text/javascript'>alert('Password should more than 8 character including a alphabet, a number and a special character');</script>";
}

else
echo "<script type='text/javascript'>alert('fill all the fields') </script>";

}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up Portal</title>
    <link rel="stylesheet" href="stylesheet/signUp.css">
  </head>
  <body>
    <div class="box">
      <h1>SIGN UP </h1>
      <p>Fill all the fields to create your new SWD account</p>
      <form method="post">
        <label class="namelabel">Name:</label>
        <input type="text" name="Name" ></input><br><br>
        <label class="idlabel"> Id:</label>
        <input type="text" name="ID" ></input><br><br>
        <label class="emaillabel">E-mail :</label>
        <input type="email" name="Email" ></input><br><br>
        <label class="usernamelabel">Username:</label>
        <input type="text" name="Username" ></input><br><br>
        <label class="passwordlabel">Password:</label>
        <input type="password" name="Password" ></input><br><br>
        <input type="submit" value="SIGN UP" name='button1' class="button"></input>
      </form>
        <a href="./main.php">BACK TO LOGIN</a>
    </div>
  </body>
</html>
