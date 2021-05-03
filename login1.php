<?php
date_default_timezone_set("Asia/Manila");
// Initialize the session
session_start();


// Include config file

include_once "config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST['uname']))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST['uname']);
  }

  // Check if password is empty
  if (empty(trim($_POST['psw']))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST['psw']);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            
            if (password_verify($password, $hashed_password)) {
              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION['authenticated'] = false;
              $user_id = $_SESSION['id'];
              $code = rand(100000, 999999);
              $dateTime = new DateTime();
              $dateTimeFormat = 'Y-m-d H:i:s';
              $time = $dateTime->format($dateTimeFormat);
              $dateTime->add(new DateInterval('PT5M'));
              $expiration = $dateTime->format($dateTimeFormat);

              /*$sql = "INSERT INTO date_auth (user_id, code, time_added, expiration) VALUES ('$user_id', '$code', '$time', '$expiration')";*/

              $stmt1 = $link->prepare("INSERT INTO date_auth (user_id, code, time_added, expiration) VALUES (?, ?, ?, ?)");
              $stmt1->bind_param("ssss", $param_id, $param_code,$param_time, $param_expiration);

              // set parameters and execute
              $param_id = $user_id;
              $param_code = $code;
              $param_time = $time;
              $param_expiration = $expiration;
              
              $stmt1->execute();

               $stmt1 = $link->prepare("INSERT INTO activity_log (activity, username) VALUES (?, ?)");
               $stmt1->bind_param("ss", $activity, $username);

              // // set parameters and execute
               $activity = "Attempted Log in";
               $username = $username;
              
               $stmt1->execute();
               $stmt1->close();

              // Redirect user to authentication page
              header("location: authentication.php");
            } else {
              // Display an error message if password is not valid
              $password_err = "The password you entered was not valid.";
            }
          }
        } else {
          // Display an error message if username doesn't exist
          $username_err = "No account have this username.";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
<title>LOGIN FORM</title>
</head>

<body>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<h2>LOGIN</h2>
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="uname">Username</label>
        <input type="text" name="uname" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="psw">Password</label>
        <input type="password" name="psw">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <br>

      <button type="submit" name="submit">Login</button>
      <br>
      <br>
      

    <span class="psw" style="font-size: 16px">Don't have an account?<a href="register1.php"> Sign Up</a></span>

    <span class="forgotPass" style="margin-left: 250px; font-size: 16px;"><a href="forgotpass.php">Forgot Password?</a></span>

  </form>
</body>

</html>