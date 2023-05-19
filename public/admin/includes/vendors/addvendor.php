<?php
include './includes/db.php';
if (isset($_POST['submit'])) {
    $ven_name = $_POST['ven_name'];
    $ven_name = mysqli_real_escape_string($conn, $ven_name);
    $ven_status = $_POST['status'];
    $ven_status = mysqli_real_escape_string($conn, $ven_status);

    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../img/vendor/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
            header("Location: index.php?category");
        }
    }


    $sql_insert = "INSERT INTO vendors (vendor_title, vendor_img, vendor_status) VALUES ('$ven_name', '$new_img_name', '$ven_status')";
    $conn->query($sql_insert);

    header("Location: index.php?vendors");
}



?>



<!-- /.row -->
<div class="row ">
<h2 class="page-header" style='text-align:center'>
    Add Vendor
  </h2>
  <div class='col-md-4 col-lg-offset-4'>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="col-auto col-lg-6 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Vendor Name</label>
                <input type="text" class="form-control mb-2" name="ven_name" placeholder="Vendor Name">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active">Active</option>
                    <option value="deactive">Deactive</option>
                </select>
            </div>
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label class="sr-only" for="inlineFormInput">Vendor Image</label>
                <input type="file" class="form-control mb-2" name="image" placeholder="Category Img">
            </div>
            <div class="col-auto form-group" style='margin:auto; text-align:center;'>
                <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
    </form>

  </div>
    </div>