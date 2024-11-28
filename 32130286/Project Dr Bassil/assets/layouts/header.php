<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>One Shop - Home</title>
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
    <script src="dropdown.js"></script>
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