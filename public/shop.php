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
<!-- Navbar Start -->


<!-- LIMIT PHP -->
<?php

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 5;
}

if (!isset($_GET['sort'])) {
    $type = '';
    $sorting = '';
} else {
    $type = $_GET['sort'];
    $sorting = $_GET['order'];
}


?>

<!-- PAGINATION PHP START-->
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if ($page == "" || $page == 1) {
    $page_1 = 0;
} else {
    $page_1 = ($page * $limit) - $limit;
}
?>
<!-- PAGINATION PHP END-->

<!-- PRODUCT CART ADDING PHP-->

<?php
$error_msg = '';
if (isset($_GET['add'])) {
    if (isset($_SESSION['id'])) {

        $sql = "SELECT * FROM cart WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $sql_quan = "UPDATE cart SET quantity= quantity+1 WHERE product_id = '$_GET[add]' and user_id = '$_SESSION[id]'";
            $res_quan = $conn->query($sql_quan);
            header("Location: shop.php");
        } else {
            $sql_new = "INSERT INTO `cart`(`user_id`, `product_id`, `quantity`) VALUES ('$_SESSION[id]','$_GET[add]', 1)";
            $conn->query($sql_new);
            header("Location: shop.php");
        }
    } else {
        header("Location: login.php");
    }
}
?>

<!-- WISH ADDING PHP -->

<?php
if (isset($_GET['wish'])) {
    if (isset($_SESSION['id'])) {

        $sql_wish = "SELECT * FROM wishs WHERE product_id = '$_GET[wish]' and user_id = '$_SESSION[id]'";
        $res_wish = $conn->query($sql_wish);
        if ($res_wish->num_rows > 0) {
            header("Location: shop.php");
        } else {
            $sql_new = "INSERT INTO `wishs`(`user_id`, `product_id`) VALUES ('$_SESSION[id]','$_GET[wish]')";
            $conn->query($sql_new);
            header("Location: shop.php");
        }
    } else {
        header("Location: login.php");
    }
}

?>

<!-- Navbar Start -->

<!-- Navbar End -->
<?php
if (isset($_GET['cat'])) {
    $table = 'cat';
    $id = $_GET['cat'];
    $sql_count = "SELECT * FROM products WHERE product_status = 'active' and product_cat_id = '$id'";
    $res_count = $conn->query($sql_count);
    $count = mysqli_num_rows($res_count);
    $count = ceil($count / $limit);

    if($type!=''){
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and product_cat_id = '$id' ORDER BY $type $sorting LIMIT $page_1, $limit";
    }
    else{
        
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and product_cat_id = '$id' LIMIT $page_1, $limit";
    }

    $res = $conn->query($sql_pro);
    if ($res->num_rows > 0) {
    } else {
        echo "<h2 style='text-align:center'>No Product Found!!</h2>";
    }
} else if (isset($_GET['subcat'])) {
    $table = 'subcat';
    $id = $_GET['subcat'];

    $sql_count = "SELECT * FROM products WHERE product_status = 'active' and pro_sub_cat_id = '$id'";
    $res_count = $conn->query($sql_count);
    $count = mysqli_num_rows($res_count);
    $count = ceil($count / $limit);

    if($type!=''){
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and pro_sub_cat_id = '$id' ORDER BY $type $sorting LIMIT $page_1, $limit";
    }
    else{
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and pro_sub_cat_id = '$id' LIMIT $page_1, $limit";
    }
    
    $res = $conn->query($sql_pro);
    if ($res->num_rows > 0) {
    } else {
        $error_msg =  "No Product Found!!";
    }
} else if (isset($_GET['submit'])) {
    $value = $_GET['search'];

    $sql_count = "SELECT * FROM products WHERE product_status = 'active' and product_title LIKE '%$value%'";
    $res_count = $conn->query($sql_count);
    $count = mysqli_num_rows($res_count);
    $count = ceil($count / $limit);

    if($type!=''){
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and product_title LIKE '%$value%' ORDER BY $type $sorting LIMIT $page_1, $limit";
    }
    else{
        
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' and product_title LIKE '%$value%' LIMIT $page_1, $limit";
    }

    $res = $conn->query($sql_pro);
    if ($res->num_rows > 0) {
    } else {
        $error_msg =  "No Product Found!!";
    }
}
 
else {
    $sql_count = "SELECT * FROM products WHERE product_status = 'active'";
    $res_count = $conn->query($sql_count);
    $count = mysqli_num_rows($res_count);
    $count = ceil($count / $limit);

    if ($type != '') {
        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' ORDER BY $type $sorting LIMIT $page_1, $limit";
    } else {

        $sql_pro = "SELECT * FROM products WHERE product_status = 'active' LIMIT $page_1, $limit";
    }

    $res = $conn->query($sql_pro);
    if ($res->num_rows > 0) {
    } else {
        $error_msg = "No Product Found!!";
    }
}
?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Color</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Black</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">White</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Red</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Blue</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">Green</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-1">
                        <label class="custom-control-label" for="size-1">XS</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-2">
                        <label class="custom-control-label" for="size-2">S</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-3">
                        <label class="custom-control-label" for="size-3">M</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-4">
                        <label class="custom-control-label" for="size-4">L</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="size-5">
                        <label class="custom-control-label" for="size-5">XL</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            Size End --> 
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">



                <!-- Sorting Start -->
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=product_id&order=DESC&<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Latest</a>
                                    <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=product_price&order=DESC&<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Price (High - Low)</a>
                                    <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=product_price&order=ASC&<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Price (Low -High)</a>
                                    <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=product_title&order=DESC&<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Name (A - Z)</a>
                                    <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=product_title&order=ASC&<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Name (Z -A)</a>
                                    <!-- <a class="dropdown-item" href="shop.php?limit=<?php echo $limit ?>&sort=rating&order=DESC&<?php //echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>">Best Rating</a> -->
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="shop.php?limit=5<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>&<?php echo isset($_GET['sort'])? 'sort='.$_GET['sort'].'&order='.$_GET['order']: '' ?>">5</a>
                                    <a class="dropdown-item" href="shop.php?limit=10<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>&<?php echo isset($_GET['sort'])? 'sort='.$_GET['sort'].'&order='.$_GET['order']: '' ?>">10</a>
                                    <a class="dropdown-item" href="shop.php?limit=20<?php echo isset($_GET['subcat'])? '&'.$table.'='.$_GET['subcat']: '' ?>&<?php echo isset($_GET['sort'])? 'sort='.$_GET['sort'].'&order='.$_GET['order']: '' ?>">20</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sorting End -->
                <h2 style='text-align:center; margin:auto;'><?php echo $error_msg != '' ? $error_msg : '' ?></h2>


                <?php
                if ($res->num_rows > 0) {
                    while ($v = $res->fetch_array()) {
                        if (isset($_SESSION['id'])) {
                            $sql_find = "SELECT * FROM cart WHERE product_id = '$v[product_id]' and user_id = '$_SESSION[id]'";
                            $res_find = $conn->query($sql_find);
                            if ($res_find->num_rows > 0) {
                                $row = $res_find->fetch_array();
                                if ($row['quantity'] >= $v['product_quantity']) {
                                    $info = "Only {$v['product_quantity']}  Left";
                                    $dsiable = "disabled";
                                } else {
                                    $info = '';
                                    $dsiable = "";
                                }
                            } else {
                                $info = '';
                                $dsiable = "";
                            }
                        }

                        echo "<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
        <div class='product-item bg-light mb-4'>
            <div class='product-img position-relative overflow-hidden'>
                <img class='img-fluid w-100' src='img/product/{$v['product_img']}' alt=''>
                <div class='product-action'>
                    <a class='btn btn-outline-dark btn-square' href='shop.php?add={$v['product_id']}' ><i class='fa fa-shopping-cart'></i></a>
                    <a class='btn btn-outline-dark btn-square' href='shop.php?wish={$v['product_id']}'><i class='far fa-heart'></i></a>
                    <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-sync-alt'></i></a>
                    <a class='btn btn-outline-dark btn-square' href=''><i class='fa fa-search'></i></a>
                </div>
            </div>
            <div class='text-center py-4'>
                <a class='h6 text-decoration-none text-truncate' href='detail.php?p_id={$v['product_id']}'>{$v['product_title']}</a>
                <div class='d-flex align-items-center justify-content-center mt-2'>
                    <h5><span>$</span>{$v['product_price']}</h5>
                    <h6 class='text-muted ml-2'><del>$123.00</del></h6>
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

                <!-- Pagination Start -->
                <div class="col-12 mt-2">
                    <nav>
                        <ul class="pagination justify-content-center">

                            <li class="page-item <?php echo $page <= 1 ? "disabled" : "" ?>"><a class="page-link" href="shop.php?page=<?php echo $page - 1 ?>">Previous</span></a></li>
                            <?php
                            for ($i = 1; $i <= $count; $i++) {
                                $link_active = ($page == $i) ? 'active' : '';
                                echo " <li class='page-item $link_active'><a class='page-link' href='shop.php?page=$i'>$i</a></li>";
                            }
                            ?>

                            <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <li class="page-item <?php echo $page >= $count ? "disabled" : "" ?>"><a class="page-link" href="shop.php?page=<?php echo $page + 1 ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination End -->
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->