<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <?php
        $value = 0;
        $sql_cat = "SELECT * FROM categories WHERE cat_status = 'active'";
        $res_cat = $conn->query($sql_cat);
        if ($res_cat->num_rows > 0) {
            while ($row = $res_cat->fetch_array()) {
                $sql_count = "SELECT COUNT(product_cat_id) AS duplicate_count
                FROM products  WHERE product_cat_id = '$row[cat_id]'
                GROUP BY `product_cat_id`";
                $res_count = $conn->query($sql_count);
                if($res_count->num_rows > 0){
                    $count = $res_count->fetch_array();
                    $value = $count['duplicate_count'];
                }
                else{
                    $value = 0;
                }
                
                echo "
        <div class='col-lg-3 col-md-4 col-sm-6 pb-1'>
        <a class='text-decoration-none' href='shop.php?cat_id={$row['cat_id']}'>
            <div class='cat-item d-flex align-items-center mb-4'>
                <div class='overflow-hidden' style='width: 100px; height: 100px;'>
                    <img class='img-fluid' src='img/category/{$row['cat_img']}' alt=''>
                </div>
                <div class='flex-fill pl-3'>
                    <h6>{$row['cat_title']}</h6>
                    <small class='text-body'>{$value} Products</small>
                </div>
            </div>
        </a>
    </div>";
            }
        }

        ?>
    </div>
</div>