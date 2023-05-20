<?php
if (isset($_GET['edit_banner'])) {
    $banner_id = $_GET['id'];
    $sql_edit = "SELECT * FROM banners WHERE banner_id = '$banner_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();
}
if (isset($_POST['update_banner'])) {
    $banner_id = $_POST['banner_id'];
    $banner_title = $_POST['banner_title'];
    $banner_status = $_POST['status'];
    $banner_link = $_POST['banner_link'];
    $banner_des = $_POST['banner_des'];

    $banner_id = mysqli_real_escape_string($conn, $banner_id);
    $banner_title = mysqli_real_escape_string($conn, $banner_title);
    $banner_status = mysqli_real_escape_string($conn, $banner_status);
    $banner_link = mysqli_real_escape_string($conn, $banner_link);
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
            //header("Location: manageposts.php");
        }
        if ($img_name == '') {
            $new_img_name = $_POST['old_image'];
        }
    }


    $sql = "UPDATE `banners` SET `banner_title`='$banner_title',`banner_img`='$new_img_name',`banner_link`='$banner_link',`banner_des`='$banner_des',`banner_status`='$banner_status' WHERE `banner_id`='$banner_id'";
    $conn->query($sql);
    header("Location: index.php?banners");
}
?>


<!-- /.row -->
<div class="row">
    <h2 class="page-header" style='text-align:center'>
        Edit Banner
    </h2>
    <div class="col-md-6 col-lg-offset-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group col-auto col-lg-12">
                <input value=<?php echo $v['banner_id'] ?> type="hidden" class="form-control" name="banner_id">
                <label for="cat-title">Banner Name</label>
                <input value="<?php echo $v['banner_title'] ?>" type="text" class="form-control" name="banner_title">

            </div>
            
            <div class="col-auto col-lg-12 mb-2 form-group">
                <label for="inlineFormInput">Banner Link</label>
                <input type="text" class="form-control mb-2" name="banner_link" placeholder="Banner Link" value="<?php echo $v['banner_link'] ?>">
            </div>
            
            <div class=" col-auto col-lg-12 mb-2 form-group">
                <label  for="inlineFormInput">Banner Description</label>
                <textarea id="editor1" name="banner_des" rows="6"><?php echo $v['banner_des'] ?></textarea>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <img src='../img/banner/<?php echo $v['banner_img'] ?>' width='100'>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Banner Image</label>
                <input type="file" class="form-control mb-2" name="image">
                <input type="hidden" class="form-control mb-2" name="old_image" value="<?php echo $v['banner_img'] ?>">
            </div>
            <div class="col-lg-12 mb-2 form-group" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Banner Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active" <?php echo $v['banner_status'] == 'active' ? 'selected ' : '' ?>>Active</option>
                    <option value="deactive" <?php echo $v['banner_status'] == 'deactive' ? 'selected ' : '' ?>>Deactive</option>
                </select>
            </div>
            <div class="form-group" style='margin:auto; text-align:center;'>
                <input class="btn btn-primary" type="submit" name="update_banner" value="Update Banner">
            </div>

        </form>

    </div>
</div>
<!-- /.container-fluid -->