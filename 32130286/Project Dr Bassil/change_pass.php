<?php
session_start();
include 'server/connection.php';

if (!isset($_SESSION['logged_in'])) {
  header('Location: login.php');
  exit;
}

if (isset($_POST['change_pass_btn'])) {
  $old_pass = md5($_POST['old_pass']);
  $new_pass = $_POST['new_pass'];
  $confirm_pass = $_POST['confirm_pass'];
  $user_email = $_SESSION['user_email'];
  $user_password = $_SESSION['user_password'];
  if ($old_pass != $user_password) {
      header('location: change_pass.php?error=Old password is incorrect');
      exit;
  } else if ($new_pass !== $confirm_pass) {
      header('location: change_pass.php?error=Passwords do not match');
      exit;
  } else if (strlen($new_pass) < 6) {
      header('location: change_pass.php?error=Password must be at least 6 characters');
      exit;
  } else {
      $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
      $stmt->bind_param("ss", md5($new_pass), $user_email);
      if ($stmt->execute()) {
          header('location: account.php?message=Password changed successfully');
      } else {
          header('location: change_pass.php?error=Something went wrong');
      }
  }
}

?>

<?php include('assets/layouts/header.php') ?>

    <section class="my-5 py-5">
        <div>
          <div class="container-fluid mt-5 py-5 account-info text-center">
            <form action="change_pass.php" method="post">
              <h3 class="mb-5">Change Password</h3>
              <h5 style="color:red" class="mb-5"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></h5>
              <h5></h5>
              <div class="form-group pass-group">
                <input type="password" name="old_pass" placeholder="Old Password" required>
                <hr class="mx-auto">
                <input type="password" name="new_pass" placeholder="New Password" required>
                <br>
                <br>
                <input type="password" name="confirm_pass" placeholder="Confirm Password" required>
              </div>
              <button type="submit" name="change_pass_btn" class="checkout-btn">Reset</button>
            </form>
          </div>
        </div>
    </section>










    <?php include('assets/layouts/footer.php') ?>