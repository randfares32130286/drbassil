<?php

session_start();
include 'server/connection.php';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
  header('location: account.php');
  exit;
}
if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
  $stmt->bind_param("ss", $email , $password);
  
  
  if($stmt->execute()){
    $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
    $stmt->store_result();
    if($stmt->num_rows == 1){
      $stmt->fetch();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['user_password'] = $user_password;
      $_SESSION['logged_in'] = true;
      
      header('location: account.php?login=Logged in successfully');
      }
      else{
        header('location: login.php?error=Invalid email or password');
      }
      
    
  }
  else{
    header('location: login.php?error=Something went wrong');
  }

  
  }





?>






<?php include('assets/layouts/header.php') ?>


    <!--Login-->
    <section class="my-5 py-5 login">
        <div class="container text-center mt-5">
            <h2>Login</h2>
            <hr class="mx-auto">
            
            <div class="row mt-5">
                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center w-100">
                    <form action="login.php" method="post">
                      <h5 class="text-danger"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></h5>
                      <br>  
                      <div class="form-group email-group mb-5">
                          <i class="bi bi-envelope"></i>
                            <input type="email" class="" id="email" placeholder="Email" name="email">
                        </div>

                        <div class="form-group pass-group">
                          <i class="bi bi-lock"></i>
                            <input type="password" class="" id="password" placeholder="Password" name="password">
                        </div>

                        <button type="submit" class=" mt-3 login-btn" name="login_btn">Login</button>
                    </form>
                </div>
            </div>

            <p class="mt-3">Don't have an account? <a href="signup.php">Create one</a></p>
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
              href="https://maps.app.goo.gl/CmFki7CPUof2DUos5"
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