<?php
include("./includes/header.php");
?>

<!-- Topbar Start -->
<?php
include("./includes/topbar.php");
?>

<!-- Topbar End -->


<!-- Navbar Start -->

<?php
include("./includes/navbar.php");
?>

<?php
if (isset($_SESSION['id']))
 {
    if (isset($_POST['place'])) {
        $order_amount = mysqli_real_escape_string($conn, $_POST['total']);
        $user_id = mysqli_real_escape_string($conn, $_POST['uid']);
        $order_quantity = mysqli_real_escape_string($conn, $_POST['pro_quan']);
        $product_id = mysqli_real_escape_string($conn, $_POST['pro_id']);
        $order_email = mysqli_real_escape_string($conn, $_POST['email']);
        $order_phone = mysqli_real_escape_string($conn, $_POST['mobile']);
        $order_address = mysqli_real_escape_string($conn, $_POST['address1']);
        $order_country = mysqli_real_escape_string($conn, $_POST['country']);
        $order_city = mysqli_real_escape_string($conn, $_POST['city']);
        $order_zip = mysqli_real_escape_string($conn, $_POST['zip']);
        $date = date('Y-m-d');

        $full_address = $order_address . ', ' . $order_country . ', ' . $order_city . ', ' . $order_zip;

        $sql = "INSERT INTO `orders`(`user_id`, `order_amount`, `product_id`, `order_quantity`, `order_email`, `order_phone`, `order_address`, `order_date`) VALUES ('$user_id','$order_amount','$product_id','$order_quantity','$order_email','$order_phone','$full_address', '$date')";
        $conn->query($sql);

        $quan_array = explode(",",$order_quantity);
        $id_array = explode(",", $product_id);
        //print_r($quan_array);
        //print_r($id_array);
        for($i=0;$i< sizeof($quan_array);$i++){
            $sql_up = "UPDATE `products` SET `product_quantity`= product_quantity-$quan_array[$i] WHERE product_id = '$id_array[$i]'";
            $conn->query($sql_up);
        }

        $car_dlt = "DELETE FROM `cart` WHERE user_id = '$user_id'";
        $conn->query($car_dlt);

        // foreach ($_SESSION as $name => $value) {
        //     if (substr($name, 0, 8) == "product_") {
                //$id = trim($name, "product_");

                // $sql_up = "UPDATE `products` SET `product_quantity`= product_quantity-$value WHERE product_id = '$id'";
                // $conn->query($sql_up);

                // unset($_SESSION["product_".$id]);
        //     }
        // }
        // unset($_SESSION["sub_tottal"]);
        // unset($_SESSION["quantity"]);
    }

    
}
header('Refresh: 2; URL=index.php');
?>
<!-- Navbar End -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <h2 class='text-center' style=" margin:auto">Thank you</h2>
    </div>
</div>
<!-- Checkout End -->



<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->