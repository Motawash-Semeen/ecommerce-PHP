<?php
if (isset($_GET['add'])) {
    if (isset($_SESSION['id'])) {


        $sql = "SELECT * FROM cart WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $sql_quan = "UPDATE cart SET quantity= quantity+1 WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
            $res_quan = $conn->query($sql_quan);
            header("Location: index.php");
        } else {
            $sql_new = "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES ('$_SESSION[id]','$_GET[add]', 1)";
            $conn->query($sql_new);
            header("Location: index.php");
        }


        // $sql = "SELECT * FROM products WHERE product_id = '$_GET[add]'";
        // $res = $conn->query($sql);
        // while ($v = $res->fetch_array()) {
        //     if (isset($_SESSION['product_' . $_GET['add']])) {


        //         if ($v['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
        //             $_SESSION['product_' . $_GET['add']] += 1;
        //             $_SESSION['quantity'] +=   $_SESSION['product_' . $_GET['add']];
        //             $_SESSION['quantity_msg'] = null;
        //             header("Location: index.php");
        //         } else {
        //             $_SESSION['quantity_msg'] = $_GET['add'] . "_Only {$v['product_quantity']}  Left";
        //         }
        //     } else {
        //         $_SESSION['product_' . $_GET['add']] = 1;

        //         header("Location: index.php");
        //     }
        // }
    } else {
        header("Location: login.php");
    }
}


?>
<div class="container-fluid pt-5 pb-3" id="recent">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
    <div class="row px-xl-5">
        <?php
        $sql_pro = "SELECT * FROM products";
        $res_pro = $conn->query($sql_pro);
        if ($res_pro->num_rows > 0) {
            while ($row = $res_pro->fetch_array()) {
                // $msg = isset($_SESSION['quantity_msg']) ?  trim($_SESSION['quantity_msg'], $row['product_id'] . '_') : '';

                // if (isset($_SESSION['product_' . $row['product_id']])) {
                //     if ($row['product_quantity'] == $_SESSION['product_' . $row['product_id']]) {
                //         $info = "Only {$row['product_quantity']}  Left";
                //     } else {
                //         $info = '';
                //     }
                // } else {
                //     $info = '';
                // }

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
                }
                else {
                    $info = '';
                    $dsiable = "";
                }




                echo "
                <div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
                <div class='product-item bg-light mb-4'>
                    <div class='product-img position-relative overflow-hidden'>
                        <img class='img-fluid w-100' src='img/product-1.jpg' alt=''>
                        <div class='product-action'>
                            <a class='btn btn-outline-dark btn-square $dsiable' href='index.php?add={$row['product_id']}#recent' ><i class='fa fa-shopping-cart'></i></a>
                            <a class='btn btn-outline-dark btn-square' href=''><i class='far fa-heart'></i></a>
                            <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-sync-alt'></i></a>
                            <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-search'></i></a>
                        </div>
                    </div>
                    <div class='text-center py-4'>
                    <p class=' position-relative text-uppercase' style='color:red; margin-bottom: 0px;'>{$info}</p>
                        <a class='h6 text-decoration-none text-truncate' href='detail.php?p_id={$row['product_id']}'>{$row['product_title']}</a>
                        <div class='d-flex align-items-center justify-content-center mt-2'>
                            <h5>{$row['product_price']}</h5><h6 class='text-muted ml-2'><del>$123.00</del></h6>
                        </div>
                        <div class='d-flex align-items-center justify-content-center mb-1'>
                            <small class='fa fa-star text-primary mr-1'></small>
                            <small class='fa fa-star text-primary mr-1'></small>
                            <small class='fa fa-star text-primary mr-1'></small>
                            <small class='fa fa-star text-primary mr-1'></small>
                            <small class='fa fa-star text-primary mr-1'></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>";
            }
        }

        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star-half-alt text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star-half-alt text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-6.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star-half-alt text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-7.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star-half-alt text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="img/product-8.jpg" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>$123.00</h5>
                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small class="far fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>