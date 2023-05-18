


<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/" or $_SERVER['REQUEST_URI'] == "/ecommerce-php/public/admin/index.php")? 'active' : '' ?>">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="<?php echo isset($_GET['orders'])? 'active':'' ?>">
            <a href="index.php?orders"><i class="fa fa-fw fa-dashboard"></i> Orders</a>
        </li>

        <li class='<?php echo isset($_GET['products']) || isset($_GET['add_product']) || isset($_GET['edit_product'])? 'active':'' ?>'>
            <a href="posts:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo1" class="collapse">
                <li>
                    <a href="index.php?add_product">Add Products</a>
                </li>
                <li>
                    <a href="index.php?products">Manage Products</a>
                </li>
            </ul>
        </li>
        <li class="<?php echo isset($_GET['category']) || isset($_GET['edit_category']) || isset($_GET['add_category'])? 'active':'' ?>">
            <a href="categories:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo2" class="collapse">
                <li>
                    <a href="index.php?add_category">Add Categories</a>
                </li>
                <li>
                    <a href="index.php?category">Manage Categories</a>
                </li>
            </ul>
        </li>
        <li class="<?php echo isset($_GET['subcategory']) || isset($_GET['edit_subcategory']) || isset($_GET['add_subcategory'])? 'active':'' ?>">
            <a href="subcategories:;" data-toggle="collapse" data-target="#demo25"><i class="fa fa-fw fa-arrows-v"></i>Sub Categories <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo25" class="collapse">
                <li>
                    <a href="index.php?add_subcategory">Add Sub Categories</a>
                </li>
                <li>
                    <a href="index.php?subcategory">Manage Sub Categories</a>
                </li>
            </ul>
        </li>
        
            <?php
            if(isset($_SESSION['role'])){
                if($_SESSION['role']=='admin'){
                    $active = isset($_GET['users']) || isset($_GET['edit_user']) || isset($_GET['add_user'])? 'active':'';
                    echo "<li class='{$active}'>
                    <a href='users:;' data-toggle='collapse' data-target='#demo3'><i class='fa fa-fw fa-arrows-v'></i> Users <i class='fa fa-fw fa-caret-down'></i></a>
                    <ul id='demo3' class='collapse'>
                        <li>
                            <a href='index.php?add_user'>Add Users</a>
                        </li>
                        <li>
                            <a href='index.php?users'>Manage Users</a>
                        </li>
                    </ul>
                </li>";
                }
            }
        
        ?>
        
        <li>
            <a href="profile.php"><i class="fa fa-fw fa-wrench"></i> Profile </a>
        </li>
    </ul>
</div>