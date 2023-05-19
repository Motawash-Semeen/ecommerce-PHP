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
$sub_total  = 0;
$total_qun = 0;
$total = 0;
if (isset($_GET['add'])) {

    $sql_quan = "UPDATE cart SET quantity= quantity+1 WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
    $conn->query($sql_quan);
    header("Location: cart.php");
}

if (isset($_GET['remove'])) {

    $sql_quan = "UPDATE cart SET quantity= quantity-1 WHERE product_id = '$_GET[remove]' and user_id = '$_SESSION[id]' and quantity > 0";
    $conn->query($sql_quan);
    header("Location: cart.php");
}

if (isset($_GET['delete'])) {

    $sql_quan = "DELETE FROM `cart`  WHERE product_id = '$_GET[delete]' and user_id = '$_SESSION[id]'";
    $conn->query($sql_quan);
    header("Location: cart.php");
}
?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <?php
                    if (isset($_SESSION['id'])) {
                        $sql = "SELECT *
                        FROM products
                        INNER JOIN cart
                        ON products.product_id = cart.product_id WHERE user_id = '$_SESSION[id]'";
                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_array()) {

                                $sql_find = "SELECT * FROM cart WHERE product_id = '$row[product_id]' and user_id = '$_SESSION[id]'";
                                $res_find = $conn->query($sql_find);
                                if ($res_find->num_rows > 0) {
                                    $v = $res_find->fetch_array();
                                    if ($v['quantity'] >= $row['product_quantity']) {
                                        $info = "Only {$row['product_quantity']}  Left";
                                        $dsiable = "disabled";
                                    } else {
                                        $info = '';
                                        $dsiable = "";
                                    }
                                } else {
                                    $info = '';
                                    $dsiable = "";
                                }

                                $total = $row['quantity'] * $row['product_price'];
                                $sub_total += $total;
                                if ($row['quantity'] > 0) {
                                    echo "<tr>
                                    <td class='text-left'><img src='img/product/{$row['product_img']}' alt='' style='width: 50px;'> {$row['product_title']} </td>
                                    <td class='align-middle'><span>$</span>{$row['product_price']}</td>
                                    <td class='align-middle'>
                                    <p class=' position-relative text-uppercase' style='color:red; margin-bottom: 0px;'>{$info}</p>
                                        <div class='input-group quantity mx-auto' style='width: 100px;'>
                                            <div class='input-group-btn'>
                                                <a href='cart.php?remove={$row['product_id']}' class='btn btn-sm btn-primary btn-minus'>
                                                    <i class='fa fa-minus'></i>
                                                </a>
                                            </div>
                                            <input type='text' class='form-control form-control-sm bg-secondary border-0 text-center' value='{$row['quantity']}' id='quantity' onchange='count(this.value)'>
                                            <div class='input-group-btn'>
                                                <a href='cart.php?add={$row['product_id']}' class='btn btn-sm btn-primary btn-plus {$dsiable}'>
                                                    <i class='fa fa-plus'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='align-middle'><span>$</span>{$total}</td>
                                    <td class='align-middle'>
                                        <a href='cart.php?delete={$row['product_id']}' class='btn btn-sm btn-danger'>
                                            <i class='fa fa-times'></i>
                                        </a>
                                    </td>
                                </tr>";
                                } else {
                                    $sql_quan = "DELETE FROM `cart`  WHERE quantity = 0";
                                    $conn->query($sql_quan);
                                }
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><span>$</span><?php echo  $sub_total ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><span>$</span><?php echo  $sub_total + 10 ?></h5>
                    </div>
                    <a href='checkout.php' class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
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