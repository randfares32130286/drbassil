<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link
      rel="shortcut icon"
      href="assets/imgs/one-shop.png"
      type="image/x-icon"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <script src="./assets/js/search.js"></script>
    <style>
      .product img {
        width: 100%;
        height: auto;
        box-sizing: border-box;
        object-fit: cover;
      }

      .pagination a {
        color: coral;
        transition: 0.4s ease;
        border: 1.5px solid #1d1d1d !important;
        border-radius: 0 !important;
      }

      .pagination li:hover a {
        color: #fff;
        background-color: coral;
        border: 1.5px solid #1d1d1d !important;
      }
    </style>
  </head>
  <body>
    <!-- navbar -->
    <nav
      class="navbar navbar-expand-lg bs-body-bg bg-body-tertiary navbar-light py-5 fixed-top">
      <div class="container">
        <a href="index.php">
          <img src="./assets/imgs/one-shop.png" style="width: 75px" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse nav-buttons"
          id="navbarSupportedContent"
        >
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./shop.php">Shop</a>
            </li>

            <li class="nav-item">
              <i
                onclick="window.location.href='cart.php';"
                class="bi bi-bag"
              ></i>
              <i
                onclick="window.location.href='login.php';"
                class="bi bi-person-circle"
              ></i>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Products-->
    <section id="featured" class="my-5 py-5">
      <div class="container mt-5 py-5 ms-auto">
        <h3>Our Products</h3>
        <hr />
        <p>Here you can check out our products</p>
      </div>

      <div class="search py-5 container">
        <input
          type="text"
          id="searchbar"
          placeholder="Search"
          onkeyup="search()"
        />
        <i class="bi bi-search"></i>
      </div>
      <div class="row mx-auto container">
      <?php include("server/shop.php"); ?>
      <?php while ($row = $get->fetch_assoc()) { ?>
        <div
          class="product text-center col-lg-3 col-md-6 col-sm-12"
        >
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
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"> <button class="buy-btn">Buy Now</button> </a>
        </div>

        <?php } ?>

        <nav aria-label="Page navigation example">
          <ul class="pagination mt-5">
            <li class="page-item">
              <a href="#" class="page-link">Previous</a>
            </li>
            <li class="page-item"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item"><a href="#" class="page-link">3</a></li>
            <li class="page-item"><a href="#" class="page-link">Next</a></li>
          </ul>
        </nav>
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