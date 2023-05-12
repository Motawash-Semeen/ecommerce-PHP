<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/" or $_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/index.php")? 'active' : '' ?>">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="<?php echo isset($_GET['orders'])? 'active':'' ?>">
            <a href="index.php?orders"><i class="fa fa-fw fa-dashboard"></i> Orders</a>
        </li>
        <li>
            <a href="products.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Products</a>
        </li>
        <li>
            <a href="add_product.php"><i class="fa fa-fw fa-table"></i> Add Product</a>
        </li>

        <li>
            <a href="categories.php"><i class="fa fa-fw fa-desktop"></i> Categories</a>
        </li>
        <li>
            <a href="users.php"><i class="fa fa-fw fa-wrench"></i>Users</a>
        </li>

    </ul>
</div>