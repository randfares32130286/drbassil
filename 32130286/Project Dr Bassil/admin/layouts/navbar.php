<?php
 if (isset($_GET['logout'])) {
  unset($_SESSION['logged_in']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_name']);
  header('Location: index.php');
  exit;
} 
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4">
    <a class="navbar-brand" href="dashboard.php">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto" style="padding-left: 60vw;">
            <li class="nav-item me-4">
                <a class="nav-link" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>