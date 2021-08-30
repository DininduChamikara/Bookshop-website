<?php
include "config.php";


if(isset($_GET['id'])){

$delete_id = $_GET['id'];

$delete_pro = "delete from book where id='$delete_id'";

$run_delete = mysqli_query($conn,$delete_pro);

if($run_delete){

echo "<script>alert('One Product Has been deleted')</script>";

header("location: view-products.php");

}

}

?>


