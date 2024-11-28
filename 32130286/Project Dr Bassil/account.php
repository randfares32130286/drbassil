<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
  header('Location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  unset($_SESSION['logged_in']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_name']);
  header('Location: login.php');
  exit;
}
 
?>

<?php include('assets/layouts/header.php') ?>

    <!--Account-->
    <section class="my-5 py-5">
        <div>
          <div class="container-fluid mt-5 py-5 account-info text-center">
            <h3>Account Info</h3>
            <h5><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></h5>
            <hr class="mx-auto" />
            <h4>Name</h4>
            <h5><?php echo $_SESSION['user_name']; ?></h5>
            <h4>Email</h4>
            <h5><?php echo $_SESSION['user_email']; ?></h5>
            <h4>Password</h4>
            <h5>**********</h5>
            <hr class="mx-auto" />
            <h4><a href="change_pass.php">Change Password</a></h4>
            <br>
            <h4><a href="account.php?logout">Logout</a></h4>
            <hr class="mx-auto" />
          </div>
        </div>
    </section>
    
    <?php include('assets/layouts/footer.php') ?>
