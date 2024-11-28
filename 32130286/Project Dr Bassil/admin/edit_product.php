<?php
session_start();
include('../server/connection.php');


if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $stmtProduct = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmtProduct->bind_param("i", $productId);
    $stmtProduct->execute();
    $productResult = $stmtProduct->get_result();

    if ($productResult->num_rows > 0) {
        $product = $productResult->fetch_assoc();
    } else {
        header("Location: edit_products.php?message=Product not found");
        exit();
    }
} else {
    header("Location: edit_products.php?message=Product ID not provided");
    exit();
}

if (isset($_POST['submit'])) {
    $newProductName = $_POST['product_name'];
    $newProductPrice = $_POST['product_price'];
    $newProductDescription = isset($_POST['product_description']) ? $_POST['product_description'] : $product['product_description'];
    $newProductImages = [];

    $targetDir = "../assets/imgs/";


    for ($i = 1; $i <= 4; $i++) {
        $inputName = "product_image" . $i;

        if (isset($_FILES[$inputName]) && $_FILES[$inputName]["error"] == 0) {
            $imageName = basename($_FILES[$inputName]["name"]);
            $targetFile = $targetDir . $imageName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedExtensions = ["png"];
            if ($_FILES[$inputName]["size"] > 500000 || !in_array($imageFileType, $allowedExtensions)) {
                header ("Location: edit_product.php?id=$productId&message=Failed to upload image");
                exit();
            }

            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
                $newProductImages[] = $imageName;
            } else {
                header ("Location: edit_product.php?id=$productId&message=Failed to upload image");
                exit();
            }
        }
    }




    $stmtUpdateProduct = $conn->prepare("UPDATE products SET 
    product_name = ?, 
    product_price = ?, 
    product_description = ?,  
    product_image = ?, 
    product_image2 = ?, 
    product_image3 = ?, 
    product_image4 = ? 
    WHERE product_id = ?");


    
    $image1 = isset($newProductImages[0]) ? $newProductImages[0] : $product['product_image'];
    $image2 = isset($newProductImages[1]) ? $newProductImages[1] : $product['product_image2'];
    $image3 = isset($newProductImages[2]) ? $newProductImages[2] : $product['product_image3'];
    $image4 = isset($newProductImages[3]) ? $newProductImages[3] : $product['product_image4'];

    $stmtUpdateProduct->bind_param("sssssssi",
    $newProductName,
    $newProductPrice,
    $newProductDescription,
    $image1,
    $image2,
    $image3,
    $image4,
    $productId
    );

    if ($stmtUpdateProduct->execute()) {
        header("Location: dashboard.php?message=Product updated successfully");
        exit();
    } else {
        $errorMessage = "Error updating product: " . $stmtUpdateProduct->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Product - One Admin Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
</head>
<body>

<?php include 'layouts/navbar.php'; ?>

<div class="container mt-5">
    <h2>Edit Product</h2>

    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form action="edit_product.php?id=<?= $productId ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control mb-3" id="product_name" name="product_name" value="<?= $product['product_name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="number" class="form-control mb-3" id="product_price" name="product_price" value="<?= $product['product_price'] ?>" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <input type="text" class="form-control mb-3" id="product_description" name="product_description" required value="<?= $product['product_description'] ?>"></input>
        </div>
        <div class="form-group">
            <label for="product_description">Product Color:</label>
            <input type="text" class="form-control mb-3" id="product_description" name="product_description" required value="<?= $product['product_color'] ?>"></input>
        </div>
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" class="form-control-file mb-3" id="image1" name="product_image1">
        </div>
        <div class="form-group">
            <label for="image2">Image 2:</label>
            <input type="file" class="form-control-file mb-3" id="image2" name="product_image2">
        </div>
        <div class="form-group">
            <label for="image3">Image 3:</label>
            <input type="file" class="form-control-file mb-3" id="image3" name="product_image3">
        </div>
        <div class="form-group">
            <label for="image4">Image 4:</label>
            <input type="file" class="form-control-file mb-3" id="image4" name="product_image4">
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3" name="submit">Update Product</button>
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
