<?php
require './config.php';

$id = 0;
$quantity = 1;


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM book WHERE id = '$id'";

  $result = $conn->query($sql);

  // $related_sql = "SELECT * FROM book WHERE id = '$id' AND category = '' ";

}
?>



<?php

if (isset($_GET['type'])) {

  $related_type = $_GET['type'];
  
  $related_sql = "SELECT * FROM book WHERE category = '$related_type'";
  $related_result = $conn->query($related_sql);
  }else{
  // $related_sql = "SELECT * FROM book ORDER BY book_name";
  // $related_result = $conn->query($related_sql);
  }
?>


<?php
$customername = 'Guest';
$customer_id = 0;

//include "config.php";

if(isset($_GET['customer_id'])){

$customer_id = $_GET['customer_id'];

$get_pro = "select * from customer where id='$customer_id'";

$run_pro = mysqli_query($conn,$get_pro);


$row_pro = mysqli_fetch_array($run_pro);

  if($row_pro){
    $customername = $row_pro['firstName'];
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/download.png">

  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Glidejs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css" />
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Book Details</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="nav">
    <div class="navigation container">
      <div class="logo">
        <h1>Damayanthi Book Shop</h1>
        <h3>Welcome, <?php echo $customername ?>!</h3>
      </div>

      <div class="menu">
        <div class="top-nav">
          <div class="logo">
            <h1>Damayanthi Book Shop</h1>
          </div>
          <div class="close">
            <i class="bx bx-x"></i>
          </div>
        </div>

        <ul class="nav-list">
        <li class="nav-item">
            <a href="./index.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="./product.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">Products</a>
          </li>
          <!-- <li class="nav-item">
            <a href="#footer" class="nav-link scroll-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#footer" class="nav-link scroll-link">Contact</a>
          </li> -->
         
          <li class="nav-item">
            <a href="./user-login.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">Account</a>
          </li>
          <li class="nav-item">
              <a href="./cart.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">My Cart</a>
          </li>
        </ul>
      </div>

      <!-- <a href="cart.html" class="cart-icon">
        <i class="bx bx-shopping-bag"></i>
      </a> -->

      <div class="hamburger">
        <i class="bx bx-menu"></i>
      </div>
    </div>
  </nav>

  <!-- Product Details -->
  <section class="section product-detail">

    <?php if ($result->num_rows > 0) { ?>
      <?php while ($row = $result->fetch_assoc()) { ?>

        <div class="details container-md">
          <div class="left">
            <div class="main">
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image_url']); ?>" alt="">
            </div>
            <!-- <div class="thumbnails">
          <div class="thumbnail">
            <img src="./images/closed-old-book-in-brown-cover-vector-9187785-removebg-preview.png" alt="">
          </div>
          <div class="thumbnail">
            <img src="./images/closed-old-book-in-brown-cover-vector-9187785-removebg-preview.png" alt="">
          </div>
          <div class="thumbnail">
            <img src="./images/closed-old-book-in-brown-cover-vector-9187785-removebg-preview.png" alt="">
          </div>
          <div class="thumbnail">
            <img src="./images/closed-old-book-in-brown-cover-vector-9187785-removebg-preview.png" alt="">
          </div>
        </div> -->
          </div>

          <div class="right">
            <span><?php echo $row['category'] ?></span>
            <h1><?php echo $row['book_name'] ?> By <?php echo $row['author'] ?></h1>
            <div class="price">Rs. <?php echo $row['book_price'] ?></div>
            


            <form action="cart.php" method="GET" class="form" >
              <input name="id" type="hidden" value="<?php echo $row['id']; ?>">
              <input name="customer_id" type="hidden" value="<?php echo $customer_id; ?>" >
              <input name="quantity" type="number" value="1" placeholder="1" min="1" style="width: 50px;">
              <input style="width: 150px;" type="submit" name="add_to_cart" class="addCart" value="Add to Cart" >
              

            </form>

            <h3>Book Detail</h3>
            <p><?php echo $row['description'] ?></p>
          </div>
        </div>

      <?php } ?>
    <?php } ?>

  <?php
    if(isset($_POST['add_to_cart'])){
      $quantity = $_POST['quantity'];

      echo "<script> alert('Book Added successfully ')</script>";
      echo "<script> window.open('cart.php','_self')</script>";
    }
  ?>

  </section>

  <!-- Related -->
  <section class="section featured">
    <div class="top container">
      <h1>Related Books</h1>
       <!-- <a href="#" class="view-more">View more</a> -->
    </div>

    <div class="product-center container">

    <?php if ($related_result->num_rows > 0) { ?>
          <?php while ($row_related = $related_result->fetch_assoc()) { ?>

            <div class="product">
            <a href="product-details.php?id=<?php echo $row_related['id']; ?>&customer_id=<?php echo $customer_id; ?>&type=<?php echo $row_related['category']; ?>">
              <div class="product-header">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row_related['image_url']); ?>" alt="">
                <!-- <ul class="icons">
                  <span><i class="bx bx-heart"></i></span>
                  <a href="cart.php"> <span><i class="bx bx-shopping-bag"></i></span>
                  </a>
                  <span><i class="bx bx-search"></i></span>
                </ul> -->
              </div>
              <div class="product-footer">
                <a href="product-details.php">
                  <h3><?php echo $row_related['book_name'] ?></h3>
                </a>
                <!-- <div class="rating">
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bx-star"></i>
                </div> -->
                <br>
                <h4 class="price">Rs. <?php echo $row_related['book_price'] ?></h4>
              </div>
            </div>

          <?php } ?>
        <?php } ?>

    </div>
  </section>


  <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>EXTRAS</h3>
          <a href="#">Brands</a>
          <a href="#">Gift Certificates</a>
          <a href="#">Affiliate</a>
          <a href="#">Specials</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a hre History></a>
            <a href="#">Wish List</a>
            <a href="#">Newsletter</a>
            <a href="#">Returns</a>
        </div>
        <div class="footer-center">
          <h3>CONTACT US</h3>
          <div>
            <span>
              <i class="fas fa-map-marker-alt"></i>
            </span>
            Address
          </div>
          <div>
            <span>
              <i class="far fa-envelope"></i>
            </span>
            damayanthibookshop@gmail.com
          </div>
          <div>
            <span>
              <i class="fas fa-phone"></i>
            </span>
            Tel No
          </div>
          <div>
            <span>
              <i class="far fa-paper-plane"></i>
            </span>
            City, SL
          </div>
        </div>
      </div>
    </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
  <!-- Custom Script -->
  <script src="./js/index.js"></script>
</body>

</html>