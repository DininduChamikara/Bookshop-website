<?php
include "config.php";

if (isset($_POST['submit'])) {

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $nameIns = $_POST['nameWithInitials'];
  $birthdate = $_POST['birthdate'];
  $nic = $_POST['nic'];
  $gender = $_POST['gender'];
  $contactNumber = $_POST['contactNumber'];
  $address = $_POST['permanentAddress'];
  $email = $_POST['email'];
  $post = $_POST['post'];

  $sql = "INSERT INTO staff(nic, firstName, lastName, initialName, dob, gender, contact, address, email, post) 
    VALUES ('$nic','$firstName','$lastName','$nameIns','$birthdate','$gender','$contactNumber','$address','$email','$post')";

  $result = $conn->query($sql);

  if ($result == TRUE) {
    echo "New record created successfully";
    header("location: View Staff.php");
  } else {
    echo "Error:" . $sql . "<br>" . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="./Case Study.css">

  <!-- <script>
    function validateForm() {
      var firstname = document.forms["form1"]["firstName"].value;
      var lastname = document.forms["form1"]["lastName"].value;
      var initname = document.forms["form1"]["nameWithInitials"].value;
      var dob = document.forms["form1"]["birthdate"].value;
      var nic = document.forms["form1"]["nic"].value;
      var gender = document.forms["form1"]["gender"].value;
      var contact = document.forms["form1"]["contactNumber"].value;
      var address = document.forms["form1"]["permanentAddress"].value;
      var email = document.forms["form1"]["email"].value;
      var post = document.forms["form1"]["post"].value;

      if (firstname == "") {
        alert("First Name is required! ");
        return false;
      } else if (!isNaN(firstname)) {
        alert(" A valid Name is required! ");
        return false;
      }

      if (lastname == "") {
        alert("Last Name is required! ");
        return false;
      } else if (!isNaN(lastname)) {
        alert(" A valid Name is required! ");
        return false;
      }

      if (initname == "") {
        alert("Name with Initial is required! ");
        return false;
      } else if (!isNaN(initname)) {
        alert(" A valid Name is required! ");
        return false;
      }

      if (dob == "") {
        alert("Birth Date is Required! ");
        return false;
      }

      if (nic == "") {
        alert(" NIC is required! ");
        return false;
      } else if (!(nic == "")) {
        if (nic.length <= 10) {
          alert("Invalid Nic Number! ");
          return false;
        } else if (nic.length > 12) {
          alert("Invalid Nic Number! NIC should not exeed 12 ");
          return false;
        }
      }

      if (gender == "") {
        alert("Choose your Gender! ");
        return false;
      }

      if (contact == "") {
        alert("Contact Number is required!");
        return false;
      } else {
        if (contact.length < 10) {
          alert(" A valid Contact Number is required !! ");
          return false;
        }
        if (contact.length > 10) {
          alert("A valid Contact Number is required.Maximum length should be 10 !!");
          return false;
        }
      }

      if (address.length > 200) {
        alert("Maximum character limit is 200 !! ");
        return false;
      }

      if (email == "") {
        alert("Email Address is required !! ");
        return false;
      } else {
        var regEmail = /^([a-zA-Z0-9\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$/;
        if (!regEmail.text(email)) {
          alert("A valid Email Address is required !! ");
          return false;
        }
      }

      if (post == "") {
        alert("Choose the Post ! ");
        return false;
      }
    }
  </script> -->
</head>

<body>
  <!-- <div class="header">
    <header class="headerSet">
      <h3>SAMADHI CHILDREN HOME</h3>
    </header>
  </div>

  <div class="sideBar">
    <a href="./Overview.php">
      <i class="fa fa-tachometer" aria-hidden="true"></i>
      <span style="padding-left: 8px">OverView</span>
    </a>
    <button class="dropdownBtn">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span style="padding-left: 4px">Donations</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdownList">
      <a href="./Add Donation.php">Add Donations</a>
      <a href="./View Donation.php">View Donations</a>
    </div>
    <button class="dropdownBtn">
      <i class="fa fa-users" aria-hidden="true"></i>
      <span style="padding-left: 4px">Staff</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdownList">
      <a href="./Add Staff.php">Add Staff</a>
      <a href="./View Staff.php">View Staff</a>
    </div>
    <button class="dropdownBtn">
      <i class="fa fa-child" aria-hidden="true"></i>
      <span style="padding-left: 10px">Child</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdownList">
      <a href="./Add Child.php">Add Child</a>
      <a href="./View Child.php">View Child</a>
    </div>
    <button class="dropdownBtn">
      <i class="fa fa-male" aria-hidden="true"></i>
      <span style="padding-left: 13px">Labours</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdownList">
      <a href="./Add Labor.php">Add Labours</a>
      <a href="./View Labor.php">View Labours</a>
    </div>
    <a href="#contact">
      <i class="fa fa-power-off" aria-hidden="true"></i>
      <span style="padding-left: 9px">Log Out</span>
    </a>
  </div> -->

  <div id="section1" class="section1">
    <form name="form1" class="form1" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="formtitle">Add Staff</div>
      <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName">
      </div>
      <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="lastName">
      </div>
      <div class="form-group">
        <label>Name with Initials:</label>
        <input type="text" name="nameWithInitials">
      </div>
      <div class="form-group">
        <label>Birthdate:</label>
        <input type="date" name="birthdate">
      </div>
      <div class="form-group">
        <label>NIC:</label>
        <input type="text" name="nic">
      </div>
      <div class="form-group">
        <label>Gender:</label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="gender" value="male">Male
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="gender" value="female">Female
      </div>
      <div class="form-group">
        <label>Contact Number:</label>
        <input type="text" name="contactNumber">
      </div>
      <div class="form-group">
        <label>Permanent Address:</label>
        <textarea name="permanentAddress"></textarea>
      </div>
      <div class="form-group">
        <label>Email Address:</label>
        <input type="email" name="email">
      </div>
      <div class="form-group">
        <label>Post:</label>
        <select name="post" id="post">
          <option value="Admin">Admin</option>
          <option value="Principal">Principal</option>
          <option value="Matron">Matron</option>
        </select>
      </div>
      <div class="form-group">
        <label>Employee Image:</label>
        <input type="file" name="employeeImage">
      </div><br>
      <input type="submit" name="submit" value="submit">
    </form>
  </div>
  <!-- <script src="script.js"></script> -->
</body>

</html>