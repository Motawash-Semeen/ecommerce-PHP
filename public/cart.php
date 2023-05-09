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
$sub_tottal = 0;
$total_qun = 0;
if (isset($_GET['add'])) {
    $sql = "SELECT * FROM products WHERE product_id = '$_GET[add]'";
    $res = $conn->query($sql);
    while ($v = $res->fetch_array()) {

        if ($v['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']] += 1;
            $_SESSION['quantity_msg'] = null;
        } else {
            $_SESSION['quantity_msg'] = "Only {$v['product_quantity']}  Left";
        }
        header("Location: cart.php");
    }
}

if (isset($_GET['remove'])) {

    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        header("Location: cart.php");
    } else {
        $_SESSION['product_' . $_GET['remove']] -= 1;
        header("Location: cart.php");
    }
    $_SESSION['quantity_msg'] = null;
}

if (isset($_GET['delete'])) {

    $_SESSION['product_' . $_GET['delete']] = null;
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
                    foreach ($_SESSION as $name => $value) {
                        if (substr($name, 0, 8) == "product_") {
                            $id = trim($name, "product_");

                            $sql_find = "SELECT * FROM products WHERE product_id = '$id'";
                            $res_find = $conn->query($sql_find);
                            if ($res_find->num_rows > 0) {
                                while ($row = $res_find->fetch_array()) {
                                    if ($value > 0) {
                                        $total = $row['product_price']*$value;
                                        $sub_tottal += $total; 
                                        $_SESSION['sub_tottal'] =  $sub_tottal;
                                        $total_qun +=  $value;
                                        $_SESSION['quantity'] =  $total_qun;
                                        if($row['product_quantity'] == $_SESSION['product_' . $row['product_id']]){
                                            $info = "Only {$row['product_quantity']}  Left";
                                        }
                                        else{
                                            $info = '';
                                        }
                                        echo "<tr>
                                        <td class='align-middle'><img src='img/product-1.jpg' alt='' style='width: 50px;'> {$row['product_title']} </td>
                                        <td class='align-middle'><span>$</span>{$row['product_price']}</td>
                                        <td class='align-middle'>
                                        <p class=' position-relative text-uppercase' style='color:red; margin-bottom: 0px;'>{$info}</p>
                                            <div class='input-group quantity mx-auto' style='width: 100px;'>
                                                <div class='input-group-btn'>
                                                    <a href='cart.php?remove={$row['product_id']}' class='btn btn-sm btn-primary btn-minus'>
                                                        <i class='fa fa-minus'></i>
                                                    </a>
                                                </div>
                                                <input type='text' class='form-control form-control-sm bg-secondary border-0 text-center' value='{$value}' id='quantity' onchange='count(this.value)'>
                                                <div class='input-group-btn'>
                                                    <a href='cart.php?add={$row['product_id']}' class='btn btn-sm btn-primary btn-plus'>
                                                        <i class='fa fa-plus'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='align-middle'><span>$</span>$total</td>
                                        <td class='align-middle'>
                                            <a href='cart.php?delete=1' class='btn btn-sm btn-danger'>
                                                <i class='fa fa-times'></i>
                                            </a>
                                        </td>
                                    </tr>";
                                    }
                                }
                            } else {
                                echo "<h2 style='text-align: center'>No record found</h2>";
                            }
                        }
                         
                    }
                    ?>

                    <!-- <tr>
                        <td class="align-middle"><img src="img/product-2.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                    <tr>
                        <td class="align-middle"><img src="img/product-3.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                    <tr>
                        <td class="align-middle"><img src="img/product-4.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                    <tr>
                        <td class="align-middle"><img src="img/product-5.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">$150</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                     -->
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
                        <h6><span>$</span><?php echo isset($_SESSION['sub_tottal'])? $_SESSION['sub_tottal'] : 0 ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><span>$</span><?php echo isset($_SESSION['sub_tottal'])? $_SESSION['sub_tottal']+10 : 0 ?></h5>
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