<?php
session_start();
?>



<?php include('assets/layouts/header.php') ?>


    <section class="container my-5 py-5">
      <div class="row">
        <div class="container mt-5 ms-auto">
          <h3>Payment</h3>
          <hr />
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <p><?php echo $_GET['order_status'];?></p>
        </div>
      </div>
    </section>






  <?php include('assets/layouts/footer.php') ?>