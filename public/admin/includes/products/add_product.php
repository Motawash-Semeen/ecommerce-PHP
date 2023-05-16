<?php
if (isset($_POST['insert'])) {
  $title = $_POST['title'];
  $sdesc = $_POST['sdesc'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $tags = $_POST['tags'];
  //$image = $_POST['image'];
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
      header("Location: index.php?products");
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

  $sql_in = "INSERT INTO `products`( `product_title`, `product_short_desc`, `product_cat_id`, `product_price`, `product_descript`, `product_quantity`, `product_tags`, `product_img`, `extra_info`, `product_status`) VALUES ('$title','$sdesc','$category','$price','$content','$quantity','$tags','$new_img_name','$add','$status')";

  $re_in = $conn->query($sql_in);
  header("Location:  index.php?products");
}

?>

<div class="col-md-12">

  <div class="row ">
    <h2 style="text-align:center;">Add Product</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
      <div class="form-row align-items-center ">
        <div class=" col-lg-12 mb-2" style=" margin-bottom:30px">
          <label for="inlineFormInput">Product Title</label>
          <input type="text" class="form-control mb-2" name="title" placeholder="Product Title" required>
        </div>
        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Short Desc</label>
          <textarea name="sdesc" rows="6"></textarea>
        </div>

        <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="cars">Category:</label>

          <select name="category" style="padding: 6px 12px;" required>
            <option value="">...Select Category...</option>
            <?php
            $sql_cate = "SELECT * FROM categories";
            $result_cate = $conn->query($sql_cate);
            if ($result_cate->num_rows > 0) {
              while ($row = $result_cate->fetch_array()) {
                echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Price</label>
          <input type="text" class="form-control mb-2" name="price" placeholder="" required>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Quantity</label>
          <input type="text" class="form-control mb-2" name="quantity" placeholder="" required>
        </div>
        <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Tags</label>
          <input type="text" class="form-control mb-2" name="tags" placeholder="" required>
        </div>
        <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
          <label for="inlineFormInput">Product Image</label>
          <input type="file" class="form-control mb-2" name="image" required>
        </div>
        <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Product Status</label>
          <select name="status" style="padding: 6px 12px;">
            <option value="">...Select Status...</option>
            <option value="active">Active</option>
            <option value="draft">Draft</option>
          </select>
        </div>


        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="w3review">Product Description:</label>
          <textarea id="editor" name="content" rows="6"></textarea>
        </div>
        <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="w3review">Additional Description:</label>
          <textarea id="editor1" name="add" rows="6"></textarea>
        </div>
        <div class="col-lg-2 col-lg-offset-5">
          <button type="submit" name="insert" class="btn btn-primary mb-2">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>