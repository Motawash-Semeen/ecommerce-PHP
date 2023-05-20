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

<!-- Navbar End -->
<?php

if (isset($_GET['add'])) {
    if (isset($_SESSION['id'])) {

        $sql = "SELECT * FROM cart WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $sql_quan = "UPDATE cart SET quantity= quantity+1 WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
            $res_quan = $conn->query($sql_quan);
            header("Location: wish.php");
        } else {
            $sql_new = "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES ('$_SESSION[id]','$_GET[add]', 1)";
            $conn->query($sql_new);
            header("Location: wish.php");
        }
    } else {
        header("Location: login.php");
    }
}


if (isset($_GET['delete'])) {

    $sql_quan = "DELETE FROM `wishs`  WHERE product_id = '$_GET[delete]' and user_id = '$_SESSION[id]'";
    $conn->query($sql_quan);
    header("Location: wish.php");
}
?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Wish List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5 offset-2">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Unit Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <?php
                    if (isset($_SESSION['id'])) {
                        $sql = "SELECT *
                        FROM products
                        INNER JOIN wishs
                        ON products.product_id = wishs.product_id WHERE user_id = '$_SESSION[id]'";
                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_array()) {

                                    echo "<tr>
                                    <td class='text-left'><img src='img/product/{$row['product_img']}' alt='' style='width: 50px;'> {$row['product_title']} </td>
                                    <td class='align-middle'><span>$</span>{$row['product_price']}</td>
                                    
                                    <td class='align-middle'>
                                    <a class='btn btn-sm btn-info' href='wish.php?add={$row['product_id']}'><i class='fa fa-shopping-cart'></i></a>
                                        <a href='wish.php?delete={$row['product_id']}' class='btn btn-sm btn-danger'>
                                            <i class='fa fa-times'></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
        </div>
</div>
<!-- Cart End -->
<script>
    function count(val) {
        //var model = document.querySelector('#quantity').value;
        console.log(val);
    }
</script>


<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->