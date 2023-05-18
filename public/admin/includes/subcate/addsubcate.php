<?php
include './includes/db.php';
if (isset($_POST['submit'])) {
    $cat_name = $_POST['cat_name'];
    $cat_name = mysqli_real_escape_string($conn, $cat_name);
    $cat_status = $_POST['status'];
    $cat_status = mysqli_real_escape_string($conn, $cat_status);
    $category = $_POST['category'];
    $category = mysqli_real_escape_string($conn, $category);

    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../img/subcate/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
            header("Location: index.php?subcategory");
        }
    }


    $sql_insert = "INSERT INTO sub_cat (cat_id, sub_cat_title, sub_cat_img) VALUES ('$category', '$cat_name', '$new_img_name')";
    $conn->query($sql_insert);

    header("Location: index.php?subcategory");
}



?>



<!-- /.row -->
<div class="row ">
<h2 class="page-header" style='text-align:center'>
    Add Sub Category
  </h2>
  <div class='col-md-4 col-lg-offset-4'>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Sub Category Name</label>
                <input type="text" class="form-control mb-2" name="cat_name" placeholder="Category Name">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active">Active</option>
                    <option value="deactive">Deactive</option>
                </select>
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <select name="category" style="padding: 6px 12px;">
                    <option value="">...Select Category...</option>
                    <?php 
                    $sql_sub = "SELECT * FROM categories";
                    $res_sub = $conn->query($sql_sub);
                    if($res_sub->num_rows > 0){
                        while($cate = $res_sub->fetch_array()){
                            echo "<option value='{$cate['cat_id']}'>{$cate['cat_title']}</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Sub Category Image</label>
                <input type="file" class="form-control mb-2" name="image" placeholder="Category Img">
            </div>
            <div class="col-auto form-group" style='margin:auto; text-align:center;'>
                <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
    </form>

  </div>
    </div>