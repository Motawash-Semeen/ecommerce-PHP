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
// $item_name = 1;
// $item_number = 1;
// $amount = 1;
// $quantity = 1;
// $access = false;
$total = 0;
$sub_total = 0;
$pro_id_array = array();
$pro_quantity_array = array();
?>
<?php
// if(isset($_SESSION['id']) and isset($_SESSION['sub_tottal'])){
//     $access = true;
// }
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
    <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->
    <form action="<?php echo  isset($_SESSION['id']) ? 'thank.php' : 'login.php' ?>" method="post">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <!-- <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="business" value="tuhinz@gmail.com">
                    <input type="hidden" name="currency_code" value="USD"> -->


                    <div class="row">

                        <?php
                        if (isset($_SESSION['id'])) {
                            $id = $_SESSION['id'];

                            $sql_user = "SELECT * FROM users WHERE user_id = '$id'";
                            $res_user = $conn->query($sql_user);
                            $v = $res_user->fetch_array();


                        ?>

                            <div class="col-md-6 form-group">
                                <input type="hidden" name="uid" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John" value="<?php echo $v['user_fname'] ?>" name='first_name' required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe" name='last_name' value="<?php echo $v['user_lname'] ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com" name='email' value="<?php echo $v['user_email'] ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789" name='mobile' value="<?php echo $v['user_phone'] ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street" name='address1' value="<?php echo $v['user_address'] ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2 (optional)</label>
                                <input class="form-control" type="text" placeholder="123 Street" name='address2'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select" name='country' required>
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York" name='city' required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York" name='state'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123" name='zip' required>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto" name='alt'>
                                    <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                                </div>
                            </div>
                        <?php
                        } else {
                            echo "<div class='col-md-12 form-group'><h2 style='text-align:center; margin:auto'>Please Login<br>OR</h2></div>
                        <div class='col-md-4 form-group mt-3 rounded offset-md-4'>
                            <div class='custom-control custom-checkbox '>
                                <a href='register.php' type='button' class='btn btn-block btn-primary font-weight-bold py-3 rounded'>Create an account
                                </a>
                            </div>
                        </div>";
                        }
                        ?>


                    </div>


                </div>
                <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php
                        if (isset($_SESSION['id'])) {
                            $sql_cart = "SELECT *
                            FROM products
                            INNER JOIN cart
                            ON products.product_id = cart.product_id WHERE user_id = '$_SESSION[id]'";
                            $res = $conn->query($sql_cart);
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_array()) {
                                    $total = $row['quantity'] * $row['product_price'];
                                    $sub_total += $total;
                                    array_push($pro_id_array, $row['product_id']);
                                    array_push($pro_quantity_array, $row['quantity']);
                                }
                            } else {
                                $total = 0;
                                $sub_total = 0;
                            }
                        } else {
                            $total = 0;
                            $sub_total = 0;
                        }
                        //print_r($pro_id_array);
                        $pro_id =  join(",", $pro_id_array);
                        
                        //print_r($pro_quantity_array);
                        $pro_quantity = join(",", $pro_quantity_array);

                        //     foreach ($_SESSION as $name => $value) {
                        //         if (substr($name, 0, 8) == "product_") {
                        //             $id = trim($name, "product_");

                        //             $sql_find = "SELECT * FROM products WHERE product_id = '$id'";
                        //             $res_find = $conn->query($sql_find);
                        //             if ($res_find->num_rows > 0) {
                        //                 while ($row = $res_find->fetch_array()) {
                        //                     $total = $row['product_price'] * $value;
                        //                     echo "<div class='d-flex justify-content-between'>
                        //                 <p>{$row['product_title']}</p>
                        //                 <p>$total</p>
                        //             </div>

                        //             <input type='hidden' name='item_name_{$item_name}' value='{$row['product_title']}'>
                        // <input type='hidden' name='item_number_{$item_number}' value='{$row['product_id']}'>
                        // <input type='hidden' name='amount_{$amount}' value='{$total}'>
                        // <input type='hidden' name='quantity_{$quantity}' value='{$value}'>

                        //             ";
                        //                     $item_name++;
                        //                     $item_number++;
                        //                     $amount++;
                        //                     $quantity++;
                        //                 }
                        //             }
                        //         }
                        //     }
                        ?>

                        <!-- <div class="d-flex justify-content-between">
                        <p>Product Name 3</p>
                        <p>$150</p>
                    </div> -->
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><span>$</span><?php
                                                //echo isset($_SESSION['sub_tottal']) ? $_SESSION['sub_tottal'] : '0' 
                                                echo $sub_total;
                                                ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><span>$</span><?php
                                                //echo isset($_SESSION['sub_tottal']) ? $_SESSION['sub_tottal'] + 10 : '10'
                                                echo $sub_total + 10;
                                                ?></h5>
                        </div>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $sub_total + 10?>">
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" value='cod' checked>
                                <label class="custom-control-label" for="directcheck">Cash on Delivary</label>
                            </div>
                        </div>
                        <input type="hidden" name="pro_id" value="<?php echo $pro_id?>">
                        <input type="hidden" name="pro_quan" value="<?php echo $pro_quantity?>">

                        <button type='submit' name='place' class="btn btn-block btn-primary font-weight-bold py-3" <?php 
                        //echo  isset($_SESSION['sub_tottal']) ? $_SESSION['sub_tottal'] : 'disabled'
                        echo $sub_total > 0?  '':'disabled'
                                                                                                                    ?>>Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->



<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->