<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM products WHERE product_id ='$id'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    $row = $res->fetch_array();
  }
}

if (isset($_POST['update'])) {

  $title = $_POST['title'];
  $sdesc = $_POST['sdesc'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $tags = $_POST['tags'];
    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../img/product/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
            //header("Location: manageposts.php");
        }
        if ($img_name == '') {
            $new_img_name = $_POST['old_image'];
        }
    }


    $status = $_POST['status'];
  $content = $_POST['content'];
  $add = $_POST['add'];

  $title = mysqli_real_escape_string($conn, $title);
  $sdesc = mysqli_real_escape_string($conn, $sdesc);
  $category = mysqli_real_escape_string($conn, $category);
  $price = mysqli_real_escape_string($conn, $price);
  $quantity = mysqli_real_escape_string($conn, $quantity);
  $tags = mysqli_real_escape_string($conn, $tags);
  $status = mysqli_real_escape_string($conn, $status);
  $content = mysqli_real_escape_string($conn, $content);
  $add = mysqli_real_escape_string($conn, $add);

    
        $sql_up = "UPDATE `products` SET `product_title`='$title',`product_short_desc`='$sdesc',`product_cat_id`='$category',`product_price`='$price',`product_descript`='$content',`product_quantity`='$quantity',`product_tags`='$tags',`product_img`='$new_img_name',`extra_info`='$add',`product_status`='$status'  WHERE `product_id` = '$id'";

        $re_up = $conn->query($sql_up);
        header("Location:  index.php?products");
}

?>

<div class="col-md-12">

  <div class="row ">
    <h2 style="text-align:center;">Edit Product</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
      <div class="form-row align-items-center ">
        <div class=" col-lg-12 mb-2" style=" margin-bottom:30px">
          <label for="inlineFormInput">Product Title</label>
          <input type="text" class="form-control mb-2" name="title" placeholder="Product Title" value="<?php echo $row['product_title'] ?>" required>
        </div>
        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Short Desc</label>
          <textarea name="sdesc" rows="6"><?php echo $row['product_short_desc'] ?></textarea>
        </div>

        <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="cars">Category:</label>

          <select name="category" style="padding: 6px 12px;" required>
            <option value="">...Select Category...</option>
            <?php
            $sql_cate = "SELECT * FROM categories";
            $result_cate = $conn->query($sql_cate);
            if ($result_cate->num_rows > 0) {
              while ($v = $result_cate->fetch_array()) {
                $select = $row['product_cat_id'] == $v['cat_id'] ? 'selected' : '';
                echo "<option value='{$v['cat_id']}' {$select}>{$v['cat_title']}</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Price</label>
          <input type="text" class="form-control mb-2" name="price" placeholder="" value="<?php echo $row['product_price'] ?>" required>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Quantity</label>
          <input type="text" class="form-control mb-2" name="quantity" placeholder="" value="<?php echo $row['product_quantity'] ?>" required>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Tags</label>
          <input type="text" class="form-control mb-2" name="tags" placeholder="" value="<?php echo $row['product_tags'] ?>" required>
        </div>
        <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
          <img src='../img/product/<?php echo $row['product_img'] ?>' width='250'>
        </div>
        <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
          <label for="inlineFormInput">Product Image</label>
          <input type="file" class="form-control mb-2" name="image">
          <input type="hidden" class="form-control mb-2" name="old_image" value="<?php echo $row['product_img'] ?>">
        </div>
        <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Status</label>
          <select name="status" style="padding: 6px 12px;">
            <option value="">...Select Status...</option>
            <option value="active" <?php echo $row['product_status'] == 'active' ? 'selected ' : '' ?>>Active</option>
            <option value="draft" <?php echo $row['product_status'] == 'draft' ? 'selected ' : '' ?>>Draft</option>
          </select>
        </div>


        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="w3review">Product Description:</label>
          <textarea id="editor" name="content" rows="6"><?php echo $row['product_descript'] ?></textarea>
        </div>
        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="w3review">Additional Description:</label>
          <textarea id="editor1" name="add" rows="6"><?php echo $row['extra_info'] ?></textarea>
        </div>
        <div class="col-lg-2 col-lg-offset-5">
          <button type="submit" name="update" class="btn btn-primary mb-2">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>