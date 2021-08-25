<?php
require './config.php';

$status = $statusMsg = '';
if (isset($_POST["submit"])) {
  $status = 'error';
  if (!empty($_FILES["image"]["name"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
      $image = $_FILES['image']['tmp_name'];
      $imgContent = addslashes((file_get_contents($image)));

      $sql = "INSERT INTO book(image) VALUES ('$imgContent')";

      $result = $conn->query($sql);

      if ($result == TRUE) {
        echo "New record created successfully";
        header("location: edit-products.php");
      } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
      }
    } else {
      $statusMsg = 'Sorry , only JPG, JPEG, PNG, & GIF files are allowed to upload.';
    }
  } else {
    $statusMsg = 'Please select an image file to upload.';
  }
}