<?php
include("./includes/header.php");
?>
<?php

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['role'] == 'user') {
        header("Location: ../index.php");
    }
}

?>
<div id="wrapper">

    <!-- Navigation -->
    <?php
    include("./includes/navigation.php");
    ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard <small>Statistics Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php

            if ($_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/" or $_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/index.php") {
                include("./includes/dashboard.php");
            }
            if (isset($_GET['orders'])) {
                include("./includes/orders/orders.php");
            }
            if (isset($_GET['category'])) {
                include("./includes/categories/categories.php");
            }
            if (isset($_GET['add_category'])) {
                include("./includes/categories/addcate.php");
            }
            if (isset($_GET['edit_category'])) {
                include("./includes/categories/editcate.php");
            }
            if (isset($_GET['subcategory'])) {
                include("./includes/subcate/subcate.php");
            }
            if (isset($_GET['add_subcategory'])) {
                include("./includes/subcate/addsubcate.php");
            }
            if (isset($_GET['edit_subcategory'])) {
                include("./includes/subcate/editsubcate.php");
            }
            if (isset($_GET['users'])) {
                include("./includes/users/users.php");
            }
            if (isset($_GET['add_user'])) {
                include("./includes/users/adduser.php");
            }
            if (isset($_GET['edit_user'])) {
                include("./includes/users/updateuser.php");
            }
            if (isset($_GET['products'])) {
                include("./includes/products/products.php");
            }
            if (isset($_GET['add_product'])) {
                include("./includes/products/add_product.php");
            }
            if (isset($_GET['edit_product'])) {
                include("./includes/products/edit_product.php");
            }

            if (isset($_GET['vendors'])) {
                include("./includes/vendors/vendors.php");
            }
            if (isset($_GET['add_vendor'])) {
                include("./includes/vendors/addvendor.php");
            }
            if (isset($_GET['edit_vendor'])) {
                include("./includes/vendors/editvendor.php");
            }

            //echo $_SERVER['REQUEST_URI'];
            ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php
include("./includes/footer.php");
?>