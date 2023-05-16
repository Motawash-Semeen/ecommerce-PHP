<!-- PHP AND MYSQL CODE FOR SHOWING DATA FOR A SPECIFIC ROW-->

<?php
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $sql_edit = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result_edit = $conn->query($sql_edit);
            $v = $result_edit->fetch_array();
            $img = $v['user_img'];
            $img_link = ($img==null) ? 'https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg' : '../img/user/'.$img;
        }
    }
}
?>

<!-- PHP AND MYSQL CODE FOR UPDATING DATA -->

<?php
if (isset($_POST['update'])) {
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $user_name = $_POST['user_name'];
        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exc = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exc)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../img/user/' . $new_img_name;
                move_uploaded_file($temp_name, $img_upload_path);
            } else {
                $em = "Only JPG, JPEG, PNG acceptable";
            }
            if ($img_name == '') {
                $new_img_name = $_POST['old_image'];
            }
        }


        $role = $_POST['role'];
        $status = $_POST['status'];

        $fname = mysqli_real_escape_string($conn, $fname);
        $lname = mysqli_real_escape_string($conn, $lname);
        $email = mysqli_real_escape_string($conn, $email);
        $user_name = mysqli_real_escape_string($conn, $user_name);


        if ($fname == '' or $lname == '' or $email == '' or $user_name == '') {
            echo "<p>Please Enter Required Data!</p>";
            header("Location:  index.php?users");
        } else {


            $sql_up = "UPDATE `users` SET `username`='$user_name', `user_fname`='$fname',`user_lname`='$lname',`user_email`='$email',`user_img`='$new_img_name',`user_role`='$role',`user_status`='$status' WHERE `user_id` = '$id'";

            $re_up = $conn->query($sql_up);
            header("Location:  index.php?users");
        }
    }
}
}
?>


<div class="row ">
    <h2 style="text-align:center;">Update User</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
        <div class="form-row align-items-center ">
            <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $v['user_id'] ?>">
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">First Name</label>
                <input type="text" class="form-control mb-2" name="fname" placeholder="First Name" value="<?php echo $v['user_fname'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Last Name</label>
                <input type="text" class="form-control mb-2" name="lname" placeholder="Last Name" value="<?php echo $v['user_lname'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Email</label>
                <input type="text" class="form-control mb-2" name="email" placeholder="Email" value="<?php echo $v['user_email'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">User Name</label>
                <input type="text" class="form-control mb-2" name="user_name" placeholder="User Name" value="<?php echo $v['username'] ?>">
            </div>
            <!-- <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Password</label>
                <input type="text" class="form-control mb-2" name="password" placeholder="Password" value="<?php //echo $v['user_password'] ?>">
            </div> -->
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <img src='<?php echo $img_link ?>'class='avatar img-circle img-thumbnail' alt='avatar' width='150'>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">User Image</label>
                <input type="file" class="form-control mb-2" name="image">
                <input type="hidden" class="form-control mb-2" name="old_image" value="<?php echo $v['user_img'] ?>">
            </div>
            
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">User Role</label>
                <select name="role" style="padding: 6px 12px;">
                    <option value="">...Select Role...</option>
                    <option value="admin" <?php echo $v['user_role'] == 'admin' ? 'selected ' : '' ?>>Admin</option>
                    <option value="editor" <?php echo $v['user_role'] == 'editor' ? 'selected ' : '' ?>>Editor</option>
                    <option value="user" <?php echo $v['user_role'] == 'user' ? 'selected ' : '' ?>>User</option>
                </select>
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">User Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active" <?php echo $v['user_status'] == 'active' ? 'selected ' : '' ?>>Active</option>
                    <option value="deactive" <?php echo $v['user_status'] == 'deactive' ? 'selected ' : '' ?>>Deactive</option>
                </select>
            </div>
            
           
            <div class="col-lg-2 col-lg-offset-5">
                <button type="submit" name="update" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>