<?php
session_start();

if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){
  
} else{
  header ('location: cart.php?error=Your bag is empty');
}
?>

<?php include('assets/layouts/header.php') ?>

    <section class="container my-5 py-5">
      <div class="row">
        <div class="container mt-5 ms-auto">
          <h3>Checkout</h3>
          <hr />
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <form action="server/place_order.php" method="post">
            <div class="row checkout-form">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <br />
                <input type="text" id="name" placeholder="Name" name="name" required/>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <br />
                <input type="email" id="email" placeholder="Email" name="email" required/>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                <br />
                <input type="text" id="phone" name="phone" placeholder="Phone Number"  required/>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <br />
                <input type="text" id="address" name="address" placeholder="Address"  required/>
              </div>
            </div>
          </div>
            <h4>Total Amount: $<?php echo $_SESSION['total'];?></h4>
            <input type="submit" name="place_order" value="Place Order" class="checkout-btn">
          </form>
        </div>
      </div>
    </section>

    <?php include('assets/layouts/footer.php') ?>