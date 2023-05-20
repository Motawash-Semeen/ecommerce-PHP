<?php
include './includes/db.php';
if (isset($_POST['submit'])) {
    $banner_name = $_POST['banner_name'];
    $banner_name = mysqli_real_escape_string($conn, $banner_name);
    $banner_status = $_POST['status'];
    $banner_status = mysqli_real_escape_string($conn, $banner_status);
    $banner_link = $_POST['banner_link'];
    $banner_link = mysqli_real_escape_string($conn, $banner_link);
    $banner_des = $_POST['banner_des'];
    $banner_des = mysqli_real_escape_string($conn, $banner_des);

    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../img/banner/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
            header("Location: index.php?banners");
        }
    }


    $sql_insert = "INSERT INTO `banners`(`banner_title`, `banner_img`, `banner_link`, `banner_des`, `banner_status`) VALUES ('$banner_name','$new_img_name','$banner_link','$banner_des','$banner_status')";
    $conn->query($sql_insert);

    header("Location: index.php?banners");
}



?>



<!-- /.row -->
<div class="row ">
<h2 class="page-header" style='text-align:center'>
    Add Banner
  </h2>
  <div class='col-md-4 col-lg-offset-4'>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="col-auto col-lg-6 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Banner Name</label>
                <input type="text" class="form-control mb-2" name="banner_name" placeholder="Banner Name">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active">Active</option>
                    <option value="deactive">Deactive</option>
                </select>
            </div>
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Banner Image</label>
                <input type="file" class="form-control mb-2" name="image" placeholder="Banner Img">
            </div>
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Banner Link</label>
                <input type="text" class="form-control mb-2" name="banner_link" placeholder="Banner Link">
            </div><div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Banner Description</label>
                <textarea id="editor1" name="banner_des" rows="6"></textarea>
            </div>
            <div class="col-auto form-group" style='margin:auto; text-align:center;'>
                <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
    </form>

  </div>
    </div>