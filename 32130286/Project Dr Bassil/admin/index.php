<?php
session_start();
include '../server/connection.php';

if(isset($_POST['submit'])){

  $name = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM admin_info WHERE user_name = ? AND user_password = ? LIMIT 1");
  $stmt->bind_param("ss", $name , $password);
  
  if($stmt->execute()){
    $stmt->bind_result($user_id, $user_name, $user_password);
    $stmt->store_result();
    if($stmt->num_rows == 1){
      $stmt->fetch();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_password'] = $user_password;
      $_SESSION['logged_in'] = true;
      
      header('location: dashboard.php?login=Logged in successfully');
      }
      else{
        header('location: index.php?error=Invalid email or password');
      }
  }
  else{
    header('location: index.php?error=Something went wrong');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Admin Panel</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
</head>
<body>

<div class="container mt-5">
    <form action="index.php" method="post">
        <h2 class="mb-3">Admin Login</h2>
        <h4 class="text-danger"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></h4>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>

</body>
</html>
