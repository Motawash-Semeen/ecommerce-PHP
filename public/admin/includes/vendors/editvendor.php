<?php
if (isset($_GET['edit_vendor'])) {
    $vedor_id = $_GET['id'];
    $sql_edit = "SELECT * FROM vendors WHERE vendor_id = '$vedor_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();
}
if (isset($_POST['update_vendor'])) {
    $ven_id = $_POST['ven_id'];
    $ven_title = $_POST['ven_title'];
    $ven_status = $_POST['status'];
    $ven_title = mysqli_real_escape_string($conn, $ven_title);
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
            //header("Location: manageposts.php");
        }
        if ($img_name == '') {
            $new_img_name = $_POST['old_image'];
        }
    }


    $sql = "UPDATE `vendors` SET `vendor_title`='$ven_title',`vendor_img`='$new_img_name',`vendor_status`='$ven_status' WHERE vendor_id = '$ven_id'";
    $conn->query($sql);
    header("Location: index.php?vendors");
}
?>


<!-- /.row -->
<div class="row">
<h2 class="page-header" style='text-align:center'>
    Edit Vendor
  </h2>
    <div class="col-md-4 col-lg-offset-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input value=<?php echo $v['vendor_id'] ?> type="hidden" class="form-control" name="ven_id">
                <label for="cat-title">Vendor Name</label>
                <input value="<?php echo $v['vendor_title'] ?>" type="text" class="form-control" name="ven_title">

            </div>
            <div class=" mb-2 form-group" style="display:flex; flex-direction:column; margin-bottom:30px">
          <label for="inlineFormInput">Vendor Status</label>
          <select name="status" style="padding: 6px 12px;">
            <option value="">...Select Status...</option>
            <option value="active" <?php echo $v['vendor_status'] == 'active' ? 'selected ' : '' ?>>Active</option>
            <option value="deactive" <?php echo $v['vendor_status'] == 'deactive' ? 'selected ' : '' ?>>Deactive</option>
          </select>
        </div>
            
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <img src='../img/vendor/<?php echo $v['vendor_img'] ?>' width='100'>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Vendor Image</label>
                <input type="file" class="form-control mb-2" name="image">
                <input type="hidden" class="form-control mb-2" name="old_image" value="<?php echo $v['vendor_img'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_vendor" value="Update Vendor">
            </div>

        </form>

    </div>
</div>
<!-- /.container-fluid -->