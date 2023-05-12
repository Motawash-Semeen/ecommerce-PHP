<?php
include("./includes/header.php");
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

            if($_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/" or $_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/index.php"){
                include("./includes/dashboard.php");
            }
            if(isset($_GET['orders'])){
                include("./includes/orders/orders.php");
            }
            if(isset($_GET['category'])){
                include("./includes/categories/categories.php");
            }
            if(isset($_GET['users'])){
                include("./includes/users/users.php");
            }
            include("./includes/products/add_product.php");
            include("./includes/products/edit_product.php");
            include("./includes/products/products.php");
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