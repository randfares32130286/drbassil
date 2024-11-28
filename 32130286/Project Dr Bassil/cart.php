<?php
  session_start();

  if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
      $product_array_ids = array_column($_SESSION['cart'], 'product_id');
      if(!in_array($_POST['product_id'], $product_array_ids)){
        $product_array = array(
          'product_id' => $_POST['product_id'],
          'product_name' => $_POST['product_name'],
          'product_price' => $_POST['product_price'],
          'product_image' => $_POST['product_image'],
          'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
        
      }else{
        echo '<script>alert("Product is already added in the cart")</script>';        
      }
    }else{
        $product_array = array(
          'product_id' => $_POST['product_id'],
          'product_name' => $_POST['product_name'],
          'product_price' => $_POST['product_price'],
          'product_image' => $_POST['product_image'],
          'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
      
    }

    calculateTotalCart();
  } else if (isset($_POST['remove_product'])){
    unset($_SESSION['cart'][$_POST['product_id']]);
    calculateTotalCart();

  } else if (isset($_POST['update_quantity'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    $product_array = $_SESSION['cart'][$product_id];
    $product_array['product_quantity'] = $product_quantity;
    $_SESSION['cart'][$product_id] = $product_array;
    calculateTotalCart();
  }
 
  

  function calculateTotalCart(){
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){
      $product = $_SESSION['cart'][$key];
      $price = $product['product_price'];
      $quantity = $product['product_quantity'];
      $total = $total + ($price * $quantity);
    }
    $_SESSION['total'] = $total;
  }
 
?>


<?php include('assets/layouts/header.php') ?>
<style>
  body {
    overflow-x: hidden;
  }
</style>

    <!--Cart-->
    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr />
      </div>
      <h4><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></h4>
      <table class="mt-5 pt-5">
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>



        <?php foreach($_SESSION['cart'] as $key => $value) { ?>
          <tr>
    <td>
      <div class="product-info">
        <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="" />
        <div class="cart-desc">
          <small><p><?php echo $value['product_name'];?></p></small>
          <small><span>$</span><?php echo $value['product_price']; ?></small>
          <br />
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
            <input type="submit" name="remove_product" class="remove-btn" value="Remove">
          </form>
        </div>
      </div>
    </td>

    <td>
      <form action="cart.php" method="post">
      <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
      <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1" />
      <input type="submit" name="update_quantity" class="edit-btn" value="Update">
      </form>
    </td>

    <td>
      <span>$</span>
      <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
    </td>
  </tr>
        
        <?php } ?>
          
      </table>

      <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>$<?php echo $_SESSION['total']; ?></td>
            </tr>
        </table>
      </div>

      <div class="checkout-container">
        <form action="checkout.php" method="post">
          <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
        </form>
      </div>
    </section>

    <?php include('assets/layouts/footer.php') ?>
