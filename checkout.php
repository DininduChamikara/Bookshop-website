<?php
require './config.php';

$id = 0;


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM book WHERE id = '$id'";

  $result = $conn->query($sql);

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


<?php

 session_start();

// $row_temp = $result->fetch_assoc();

if(isset($_GET["id"]) && isset($_GET["customer_id"])){

  ///
  $row_temp = $result->fetch_assoc();
  ///

  if(isset($_SESSION["shopping_cart"])){

    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");

    if(!in_array($id, $item_array_id)){
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'   => $id,
        'item_name' => $row_temp['book_name'],
        'item_price'=> $row_temp['book_price'],
        'item_quantity' => $quantity

      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    }else{
      echo '<script>alert("Item Already Added")</script>';
      // echo '<script>window.location="index.php"</script>'
    }

  }else{
    $item_array = array(
      'item_id'   => $id,
      'item_name' => $row_temp['book_name'],
      'item_price'=> $row_temp['book_price'],
      // 'item_quantity' => $_POST['quantity']
      'item_quantity' => $quantity
      // 'item_quantity' => $_GET['quantity']
    );
    $_SESSION["shopping_cart"][0] = $item_array;
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

  <!--css stylesheet-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">


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

    <br>
    <h1 style="text-align: center; font-weight: bold;">Cart Details</h1>
    <br>
    <br>

    <div>
      <center>
        <table style="width: 90%;" >
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"])){
            $total = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values){
        ?>
        <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td><?php echo $values["item_price"]; ?></td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2) ; ?></td>
            
        </tr>

        <?php
              $total = $total + ($values["item_quantity"] * $values["item_price"]);             
            }
        ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">Rs. <?php echo number_format($total, 2); ?></td>
        </tr>

        <?php
        }
        ?>

        </table>
      </center>

    </div>

    <center>
      <div>
        <a class = "btn" href="./index.php?customer_id=<?php echo $customer_id; ?>">Continue Shopping</a>
        <br><br><br>
      </div>

    </center>

    <div style="width: 90%; margin: auto">
      <form action="order.html" method="post" id="checkout-order-form">
            
		 	<br>
		 
		 </form>

     


     <!-- Login Start -->
     <div class="login" style="padding: 10px">

        <center>
          <h1><b>Your Details</b></h1>
          <br>
        </center>
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6" style="background-color: #FEF5E7; border: 1px solid; flex: 0 0 100%; max-width: 100%">    
                        <div class="register-form">
                          <br>

                            <!-- Added a code here (1) -->
                            <?php
                                    include "config.php";

                                    if(isset($_POST['checkout-submit'])){

                                        $firstName = $_POST['firstname'];
                                        $lastName = $_POST['lastname'];
                                        $email = $_POST['email'];
                                        $mobile = $_POST['mobile'];
                                        $address = $_POST['address'];
                                        

                                        // SQL QUERY
                                        // $sql = "INSERT INTO customer(firstName, lastName, email, mobileNum, password) VALUES
                                        // ('$firstName', '$lastName', '$email', '$mobile','$password')";

                                        // Execute the query
                                     //   $result = $conn->query($sql);
                                        // $result = mysqli_query($conn, $sql);

                                        // if($result){
                                        //     echo "<script> alert('Book Added successfully ')</script>";
                                        //     echo "<script> window.open('user-login.php ','_self')</script>";
                                        // }else{
                                        //     echo "Error:".$sql."<br>".$conn->error;
                                        // }
                                    }
                                ?>

                            <form class="row" action="payment.php" method="POST">
                                                               
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="First Name" name="firstname" value="<?php echo $row_pro['firstName']?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Last Name" name="lastname" value="<?php echo $row_pro['lastName']?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="E-mail" name="email" value="<?php echo $row_pro['email']?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Mobile No" name="mobile" value="<?php echo $row_pro['mobileNum']?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Delivery Address</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Enter the delivery address here" name="address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="ZIP Code" name="repassword" required>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button class="btn" name="checkout-submit" style="font-size: 1.5rem;" value="SUBMIT">Submit</button>
                                    </div>
                                    

                            </form>
                            <br>
                            <!-- End of added code-->
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Login End -->

     
    </div>
    

    

</body>