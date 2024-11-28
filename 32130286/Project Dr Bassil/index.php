   <?php include('assets/layouts/header.php') ?> 
    
    <!--Home-->
    <section id="home" class="container-fluid">
      <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Best Prices</span> This Season</h1>
        <p>E-Cart offers the best products for the most affordable prices</p>
        <button onclick="window.location.href='shop.php';">Shop Now</button>
      </div>
    </section>

    <!--Brands-->
    <section id="brand" class="container">
      <div class="row">
        <img
          src="./assets/imgs/brand1.png"
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
        />
        <img
          src="./assets/imgs/brand2.png"
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
        />
        <img
          src="./assets/imgs/brand3.png"
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
        />
        <img
          src="./assets/imgs/brand4.png"
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
        />
      </div>
    </section>

    <!--New-->
    <section id="new" class="w-100">
      <div class="row p-0 m-0">
        <!--One-->
        <div class="one col-lg-4 col-md-12 col-12 p-0">
          <img src="assets/imgs/1.png" class="img-fluid new container-fluid" />
          <div class="details">
            <h2>Extremely Awesome Shoes</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
        <!--Two-->
        <div class="one col-lg-4 col-md-12 col-12 p-0">
          <img src="assets/imgs/2.png" class="img-fluid new container-fluid" />
          <div class="details">
            <h2>Awesome Jackets</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
        <!--Three-->
        <div class="one col-lg-4 col-md-12 col-12 p-0">
          <img src="assets/imgs/3.png" class="img-fluid new container-fluid" />
          <div class="details">
            <h2>50% OFF</h2>
            <button class="text-uppercase">Shop Now</button>
          </div>
        </div>
      </div>
    </section>

    <!--Featured-->
    <section  id="featured" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Our Featured</h3>
        <hr class="mx-auto" />
        <p>Here you can check out our featured products</p>
      </div>
      <div class="row mx-auto container-fluid">
        <?php include("server/featured_products.php"); ?>
        <?php while($row = $get->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid mb-3" />
          <div class="star">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
        <?php } ?>
      </div>
    </section>

    <!--Banner-->
    <section id="banner" class="my-5 py-5">
      <div class="container">
        <h4>MID SEASON'S SALE</h4>
        <h1>
          Autumn Collection <br />
          UP TO 20% OFF
        </h1>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </section>

    <!--Coats-->
    <section id="coats" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Coats</h3>
        <hr class="mx-auto" />
        <p>Here you can check out our coats</p>
      </div>
      <div class="row mx-auto container-fluid">
      <?php include("server/coats.php"); ?>
      <?php while ($row = $get->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" />
          <div class="star">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"> <button class="buy-btn">Buy Now</button> </a>
        </div>
        <?php } ?>
      </div>
    </section>

    <!--Shoes-->
    <section id="shoes" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3 class="pt-5">Shoes</h3>
        <hr class="mx-auto" />
        <p>Here you can check out our shoes</p>
      </div>
      <div class="row mx-auto container-fluid">
        <?php include("server/shoes.php"); ?>
        <?php while ($row = $get->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" />
          <div class="star">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
        <?php } ?>
      </div>
    </section>

    <!--Shirts-->
    <section id="shirts" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3 class="pt-5">Shirts</h3>
        <hr class="mx-auto" />
        <p>Here you can check out our shirts</p>
      </div>
      <div class="row mx-auto container-fluid">
      <?php include("server/shirts.php"); ?>
      <?php while ($row = $get->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-6 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid mb-3" />
          <div class="star">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button> </a>
        </div>
        <?php } ?>
        
      </div>
    </section>

    <?php include('assets/layouts/footer.php') ?>