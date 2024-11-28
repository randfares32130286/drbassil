  <?php
  session_start();
  include('server/connection.php');


  if (isset($_POST['pay'])) {
      $user_id = $_SESSION['user_id'];
      $card_number = $_POST['card_number'];
      $holder_name = $_POST['holder_name'];
      $expiry = $_POST['expiry'];
      $cvc = $_POST['cvc'];

      $stmt = $conn->prepare("INSERT INTO payments (user_id, card_number, holder_name, expiry, cvc) VALUES (?, ?, ?, ?, ?);");

      $stmt->bind_param("isssi", $user_id, $card_number, $holder_name, $expiry, $cvc);
      $stmt->execute();

      $payment_id = $stmt->insert_id;

      header('location: done.php?order_status=Payment Successful');
      
      
  }
  ?>



  <?php include('assets/layouts/header.php') ?>

      <section class="container my-5 py-5">
        <div class="row">
          <div class="container mt-5 ms-auto">
            <h3>Payment</h3>
            <h4>Debit Card Or Credit Card</h4>
            <hr />
          </div>
            <form action="payment.php" method="post">
              <div class="row container">
                  <div class="col1 col-lg-6 col-md-6 col-sm-12">
                      <div class="card">
                      <div class="front">
                          <div class="type">
                          <img class="bankid"/>
                          </div>
                          <span class="chip"></span>
                          <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
                          <div class="date"><span class="date_value">MM / YYYY</span></div>
                          <span class="fullname">FULL NAME</span>
                      </div>
                      <div class="back">
                          <div class="magnetic"></div>
                          <div class="bar"></div>
                          <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
                          <span class="chip"></span>
                      </div>
                      </div>
                  </div>
                  <div class="col2 col-lg-6 col-md-6 col-sm-12">
                      
                      <input class="number mb-3" placeholder="Card Number" type="text" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="card_number" required/>
                      <input class="inputname mb-3" type="text" placeholder="Cardholder name" name="holder_name" required/>
                      <input class="expire mb-3" type="text" placeholder="MM / YYYY" name="expiry" required/>
                      <input class="ccv mb-3" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="cvc" required/>
                      <input style="height: 55px; width: 30%;" type="submit" name="pay" value="Submit Payment" class="checkout-btn"  required>
                  </div>
              </div>
            </form>
        </div>
      </section>
      
      <script src="./assets/js/payment.js"></script>
      <?php include('assets/layouts/footer.php') ?>