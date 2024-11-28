<?php

session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
  header ('location: account.php');
  exit;
}

include 'server/connection.php';

if(isset($_POST['signup'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
   
  if($password != $confirmPassword){
    header ('location: signup.php?error=Passwords do not match');
  }

  else if(strlen($password) < 6){
    header ('location: signup.php?error=Password must be at least 8 characters');
  }

  else{
  $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
  $stmt1->bind_param('s', $email);
  $stmt1->execute();
  $stmt1->bind_result($num_rows);
  $stmt1->store_result();
  $stmt1->fetch();

  if($num_rows != 0){
    header ('location: signup.php?error=Email already exists');
  }

  else{
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $name, $email,md5($password));
    
    if($stmt->execute()){
      $user_id = $stmt->insert_id;
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $name;
      $_SESSION['user_email'] = $email;
      $_SESSION['user_password'] = $password;
      $_SESSION['logged_in'] = true;

      header ('location: account.php?register=You have been registered successfully');
    }
    else{
      header ('location: signup.php?error=Something went wrong');
    }
  }



  
  }


}




?>



<?php include('assets/layouts/header.php') ?>


    <!--signup-->
    <section class="my-5 py-5 login">
        <div class="container text-center mt-5">
            <h2>Sign Up</h2>
            <hr class="mx-auto">
            
            <div class="row mt-5">
                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center w-100">
                    <form class="signup-form" method="POST" action="signup.php">
                      <h5 class="text-danger"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></h5>
                      <br>  
                      <div class="form-group user-group mb-5">
                            <i class="bi bi-person"></i>
                              <input type="text" class="" id="username" placeholder="Username" name="name">
                          </div>

                        <div class="form-group email-group mb-5">
                          <i class="bi bi-envelope"></i>
                            <input type="email" class="" id="email" placeholder="Email" name="email">
                        </div>

                        <div class="form-group pass-group">
                          <i class="bi bi-lock"></i>
                            <input type="password" class="" id="password" placeholder="Password" name="password">
                        </div>

                        <div class="form-group pass-group">
                          <i class="bi bi-lock"></i>
                            <input type="password" class="" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword">
                        </div>

                        <button type="submit" class=" mt-3 login-btn" name="signup">Sign Up</button>
                    </form>
                </div>
            </div>

            <p class="mt-3">Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </section>





    <!--Footer-->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto mt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <img src="assets/imgs/logo-white.png" />
          <p class="pt-3">We provide the best products for the best prices</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Featured</h5>
          <ul class="text-uppercase">
            <li><a href="">men</a></li>
            <li><a href="">women</a></li>
            <li><a href="">boys</a></li>
            <li><a href="">girls</a></li>
            <li><a href="">new arrivals</a></li>
            <li><a href="">cloths</a></li>
          </ul>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Contact Us</h5>
          <div>
            <h6 class="text-uppeercase">Address</h6>
            <p>
              <a
                href=""
                target="_blank"
                title="Visit Us"
                >Liu, Saida</a
              >
            </p>
          </div>
          <div>
            <h6 class="text-uppeercase">Phone</h6>
            <p><a href="tel:70123456" title="Call Us">03082342</a></p>
          </div>
          <div>
            <h6 class="text-uppeercase email">Email</h6>
            <p>
              <a href="mailto:business@walidayoub.online" title="Send Us An Email"
                >business@walidayoub.online</a
              >
            </p>
          </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Instagram</h5>
          <div class="row insta">
            <img
              src="assets/imgs/featured1.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assets/imgs/featured2.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assets/imgs/featured3.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assets/imgs/featured4.png"
              class="img-fluid w-25 h-100 m-2"
            />
          </div>
        </div>
      </div>
      <div class="copyright mt-5">
        <div class="row container mx-auto">
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 payments">
            <img src="assets/imgs/payments1.png" />
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-2">
            <p>CSCI426 © 2024</p>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <a><i class="bi bi-facebook"></i></a>
            <a><i class="bi bi-linkedin"></i></a>
            <a><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>