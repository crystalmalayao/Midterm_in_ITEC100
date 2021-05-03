<?php
include_once 'config.php';

session_start();
//Logout log
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
  mysqli_query($link,"INSERT INTO activity_log (activity,username) VALUES('Logged out','$username')");
    

    
  header('location: login1.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="welcome.css">

</head>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<body>
  <div class="topleft">

  </div>
  <div class="middle">
    <strong><h1>Hi! Welcome, <?php echo $username ?> </h1></strong>

    <p>Thank you for logging in</p>
   <button type="submit" name="submit" id="submit" class="btn btn-danger">Logout</button>
  </div>
</form>
</body>
</html>
