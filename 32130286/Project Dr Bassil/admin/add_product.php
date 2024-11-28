<?php
session_start();
include('../server/connection.php');


if (isset($_POST['submit'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productDescription = $_POST['product_description'];
    $productCategory = $_POST['product_category'];
    $productColor = $_POST['product_color'];

    $targetDir = "../assets/imgs/";
    

    $imagePaths = [];

    for ($i = 1; $i <= 4; $i++) {
        $inputName = "product_image" . $i;

        if (isset($_FILES[$inputName]) && $_FILES[$inputName]["error"] == 0) {
            $targetFile = $targetDir . basename($_FILES[$inputName]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedExtensions = ["png"];
            if ($_FILES[$inputName]["size"] > 500000 || !in_array($imageFileType, $allowedExtensions)) {
                echo "Sorry, there was an issue with one of your files.";
                exit();
            }

            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
                $imagePaths[] = $targetFile;

            } else {
                echo "Sorry, there was an error uploading one of your files.";
                exit();
            }
        }
    }

    $stmt = $conn->prepare("INSERT INTO products (product_name, product_price, product_description, product_category, product_color, product_image, product_image2, product_image3, product_image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error: " . $conn->error);
}


if (count($imagePaths) === 4) {
    $imageNames = array_map('basename', $imagePaths);

    $stmt->bind_param("sssssssss", $productName, $productPrice, $productDescription, $productCategory, $productColor, $imageNames[0], $imageNames[1], $imageNames[2], $imageNames[3]);
}

if ($stmt->execute()) {
    header("Location: dashboard.php?message=Product added successfully");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
</head>
<?php include 'layouts/navbar.php'; ?>
<body>


<div class="container mt-5">
    <h2>Add Product</h2>
    <h3><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></h3>

    
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control mb-3" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="number" step="0.01" class="form-control mb-3" id="product_price" name="product_price" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control mb-3" id="product_description" name="product_description" required></textarea>
        </div>
        <div class="form-group">
            <label for="product_category">Product Category:</label>
            <input type="text" class="form-control mb-3" id="product_category" name="product_category" required>
        </div>
        <div class="form-group">
            <label for="product_color">Product Color:</label>
            <input type="text" class="form-control mb-3" id="product_color" name="product_color" required>
        </div>
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" class="form-control-file mb-3" id="image1" name="product_image1" required>
        </div>
        <div class="form-group">
            <label for="image2">Image 2:</label>
            <input type="file" class="form-control-file mb-3" id="image2" name="product_image2" required>
        </div>
        <div class="form-group">
            <label for="image3">Image 3:</label>
            <input type="file" class="form-control-file mb-3" id="image3" name="product_image3" required>
        </div>
        <div class="form-group">
            <label for="image4">Image 4:</label>
            <input type="file" class="form-control-file mb-3" id="image4" name="product_image4" required>
        </div>
        <button type="submit" class="btn btn-primary mb-5 mt-3" name="submit">Add Product</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>

</body>
</html>
