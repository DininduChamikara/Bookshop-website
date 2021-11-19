
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

  <!-- CSS Libraries -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="lib/slick/slick.css" rel="stylesheet">
  <link href="lib/slick/slick-theme.css" rel="stylesheet">


  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/download.png">
  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Damayanthi Book Shop</title>

  
</head>

<body>
<?php
                                   
        include "config.php";  
        
        $customerFName = 'Guest';
        // $customerId = 0;

        if(isset($_POST['login-submit'])){

            $email = $_POST['loginEmail'];
            $password = $_POST['loginPassword'];
            
            $get_user = "select * from customer where email='$email' AND password='$password'";
            
            $run_user = mysqli_query($conn,$get_user);
            
            $count = mysqli_num_rows($run_user);

            if($count==1){

              $row_pro = mysqli_fetch_array($run_user);
              $customerFName = $row_pro['firstName'];
              $customer_id = $row_pro['id'];
            

            //  echo "<script>alert('Successfully logged!')</script>";
              
            }
            else {
              
              echo "<script>alert('Username or Password is Wrong')</script>";
              
            }

            
        }

        if(isset($_GET['customer_id'])){

          $customer_id = $_GET['customer_id'];
          
          $get_pro = "select * from customer where id='$customer_id'";
          
          $run_pro = mysqli_query($conn,$get_pro);
          
          
          $row_pro = mysqli_fetch_array($run_pro);
          
            if($row_pro){
              $customerFName = $row_pro['firstName'];
            }
          
          }

?>

<?php

// $customerFname = 'Guest';


//include "config.php";



?>


  <!-- Header -->
  <header id="home" class="header" style="background-image: url('./images/14_09_2020_12_19_07_0316568.jpeg');">
    <!-- Navigation -->
    <nav class="nav">
      <div class="navigation container">
        <div class="logo">
          <h1>Damayanthi Book Shop</h1>
          <h3>Welcome, <?php echo $customerFName ?>!</h3>
        </div>

        <div class="menu">
          <div class="top-nav">
            <div class="logo">
              <h1>Dmayanthi Book Shop</h1>
            </div>
            <div class="close">
              <i class="bx bx-x"></i>
            </div>
          </div>

          <ul class="nav-list">
            <li class="nav-item">
              <a href="./index.php?customer_id=<?php echo $customer_id; ?>" class="nav-link scroll-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="./product.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">Products</a>
            </li>
            <li class="nav-item">
              <a href="#footer" class="nav-link scroll-link">About</a>
            </li>
            <li class="nav-item">
              <a href="#footer" class="nav-link scroll-link">Contact</a>
            </li>
        
            <li class="nav-item">
              <a href="./user-login.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">Account</a>
            </li>
            <li class="nav-item">
              <a href="./cart.php?customer_id=<?php echo $customer_id; ?>" class="nav-link">My Cart</a>
            </li>
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
    <div class="hero-content">
      <h2><span class="discount">25% </span> SALE OFF</h2>
      <h1>
        <span>Online</span>
        <span>Sale</span>
      </h1>
      <a class="btn" style="font-size: 1.5rem;" href="./product.php">shop now</a>
    </div>
  </header>

  <br>
        
        <!-- Login Start -->
        <div class="login" style="padding: 10px">
            <div class="container-fluid">
            
                <div class="row">
                    <div class="col-lg-6" style="background-color: #FEF5E7; border: 1px solid;">  
                    <center>
                      <h1 style="font-size:30px; padding-top:20px">Register</h1>
                    </center>
                   
                    
                        <div class="register-form">
                          <br>

                            <!-- Added a code here (1) -->
                            <?php
                                    include "config.php";

                                    if(isset($_POST['register-submit'])){

                                        $firstName = $_POST['firstname'];
                                        $lastName = $_POST['lastname'];
                                        $email = $_POST['email'];
                                        $mobile = $_POST['mobile'];
                                        $password = $_POST['password'];
                                        

                                        // SQL QUERY
                                        $sql = "INSERT INTO customer(firstName, lastName, email, mobileNum, password) VALUES
                                        ('$firstName', '$lastName', '$email', '$mobile','$password')";

                                        // Execute the query
                                     //   $result = $conn->query($sql);
                                        $result = mysqli_query($conn, $sql);

                                        if($result){
                                            echo "<script> alert('Book Added successfully ')</script>";
                                            echo "<script> window.open('user-login.php ','_self')</script>";
                                        }else{
                                            echo "Error:".$sql."<br>".$conn->error;
                                        }
                                    }
                                ?>

                            <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                                   
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="First Name" name="firstname">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Last Name" name="lastname">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="E-mail" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Mobile No" name="mobile">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Retype Password</label>
                                        <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Password" name="repassword">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button class="btn" name="register-submit" style="font-size: 1.5rem;" value="SUBMIT">Submit</button>
                                    </div>
                                    

                            </form>
                            <br>
                            <!-- End of added code-->
                        </div>
                    </div>
                    <div class="col-lg-6" style="background-color: #FEF5E7; border: 1px solid;">
                        <div class="login-form">
                          <center>
                            <h1 style="font-size:30px; padding-top:20px">Login</h1>
                          </center>
                        <br>
                          <div class="row" style="margin-left: 0px"> 

                          <!--Changed here by Dinindu-->
                          
                          
                            

                          
                            <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                              <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="E-mail" name="loginEmail">
                              </div>

                              <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" style="font-size: 1.5rem" type="text" placeholder="Password" name="loginPassword">
                              </div>
                              <div class="col-md-12">
                              <button class="btn" name="login-submit" style="font-size: 1.5rem;" value="SUBMIT">Submit</button>
                              </div>

                            </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        <br>

  </body