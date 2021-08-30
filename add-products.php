<?php
include "config.php";

if (isset($_POST['add'])) {

  $title = $_POST['title'];
  $category = $_POST['category'];
  $author = $_POST['author'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];
  $fileName = basename($_FILES["image"]["name"]);
  $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes((file_get_contents($image)));

  $sql = "INSERT INTO book(title, category, author, price, quantity, description, image) 
    VALUES ('$title','$category','$author','$price','$quantity', '$description', '$imgContent')";

  $result = $conn->query($sql);

  if ($result == TRUE) {
    echo "New record created successfully";
    header("location: edit-products.php");
  } else {
    echo "Error:" . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/download.png">

  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Glidejs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css" />
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Admin View</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="nav">
    <div class="navigation container">
      <div class="logo">
        <h1>Damayanthi Book Shop</h1>
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
            <a href="./index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="./product.php" class="nav-link">Products</a>
          </li>
          <li class="nav-item">
            <a href="#footer" class="nav-link scroll-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#footer" class="nav-link scroll-link">Contact</a>
          </li>
          <li class="nav-item">
            <a href="./signin.php" class="nav-link">Account</a>
          </li>
          <!-- <li class="nav-item">
            <a href="./cart.php" class="nav-link icon"><i class="bx bx-shopping-bag"></i></a>
          </li> -->
        </ul>
      </div>

      <!-- <a href="cart.php" class="cart-icon">
        <i class="bx bx-shopping-bag"></i>
      </a> -->

      <div class="hamburger">
        <i class="bx bx-menu"></i>
      </div>
    </div>
  </nav>

  <div class="search" style="margin-left: 15%;">
    <input type="search" placeholder="Search for Edit" style="width: 70%; padding: 0.8rem; color: rgb(110, 110, 110);  border: 1px solid #ccc;">&nbsp;
    <input type="submit" value="Search" style="background-image: url(./images/search.png);">
  </div>

  <!-- Product Details -->
  <section class="section product-detail">
    <form class="editForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="details container-md">
        <div class="left">
          <div class="main">
            <br>
            Book Image:
            <br><br>
            <input type="file" name="image" onchange="readURL(this)">
            <!-- <img src="./images/closed-old-book-in-brown-cover-vector-9187785-removebg-preview.png" alt=""> -->
            <!--Dinindu Test 1-->
            <br><br>
            <img id="previewImage" alt="book image" />
          </div>
        </div>
        <!--////////////////-->
        
        <!--////////////////-->
        <div class="right">
          <!-- <form class="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> -->
          <input type="text" name="title" id="title" placeholder="Title">
          <input type="text" name="author" id="author" placeholder="Author"><br>
          <input type="text" name="price" id="price" placeholder="Price"><br>
          <input type="number" name="quantity" id="quantity" placeholder="Quantity">
          <div>
            <select class="category" name="category">
              <option value="Select" selected disabled>Category</option>
              <option value="Classic">Classic</option>
              <option value="Comic">Comic</option>
              <option value="Sci-Fi">Sci-Fi</option>
              <option value="Sort Story">Sort Story</option>
              <option value="Biographies">Biographies</option>
              <option value="Historical">Historical</option>
              <textarea name="description" placeholder="Book Description"></textarea>
            </select>
            <input type="submit" name="add" value="Add">
            <!-- <span><i class='bx bx-chevron-down'></i></span> -->
          </div>
        </div>
      </div>
    </form>
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

  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  
  <!-- Custom Script -->
  <script src="./js/index.js"></script>
  <script src="./js/dinindu.js"></script>
</body>

</html>