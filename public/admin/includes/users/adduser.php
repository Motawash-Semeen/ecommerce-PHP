<!-- PHP AND MYSQL CODE FOR ADD NEW POST  -->

<?php
if (isset($_POST['insert'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $user_name = $_POST['user_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = md5($_POST['password']);
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
                    header("Location: index.php?users");
                }
            }

            $role = $_POST['role'];
            $status = $_POST['status'];


            $fname = mysqli_real_escape_string($conn, $fname);
            $lname = mysqli_real_escape_string($conn, $lname);
            $email = mysqli_real_escape_string($conn, $email);
            $phone = mysqli_real_escape_string($conn, $phone);
            $address = mysqli_real_escape_string($conn, $address);
            $user_name = mysqli_real_escape_string($conn, $user_name);

            if ($fname == '' or $lname == '' or $email == '' or $user_name == '' or $password == '') {
                echo "<p>Please Enter Required Data!</p>";
                header("Location:  index.php?users");
            } else {
                $sql_in = "INSERT INTO users (`username`, `user_password`, `user_fname`, `user_lname`, `user_email`, `user_img`, `user_role`, `user_status`, `user_phone`, `user_address`) VALUES ('$user_name','$password','$fname','$lname','$email','$new_img_name','$role','$status', '$phone', '$address')";

                $re_in = $conn->query($sql_in);
                header("Location:  index.php?users");
            }
        }
    }
}
?>
<div class="row ">
    <h2 style="text-align:center;">Add User</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
        <div class="form-row align-items-center ">
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">First Name</label>
                <input type="text" class="form-control mb-2" name="fname" placeholder="First Name">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Last Name</label>
                <input type="text" class="form-control mb-2" name="lname" placeholder="Last Name">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Email</label>
                <input type="text" class="form-control mb-2" name="email" placeholder="Email">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">User Name</label>
                <input type="text" class="form-control mb-2" name="user_name" placeholder="User Name">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Phone</label>
                <input type="text" class="form-control mb-2" name="phone" placeholder="Phone">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Address</label>
                <input type="text" class="form-control mb-2" name="address" placeholder="User Address">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Password</label>
                <input type="text" class="form-control mb-2" name="password" placeholder="Password">
            </div>

            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">User Image</label>
                <input type="file" class="form-control mb-2" name="image">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">User Role</label>
                <select name="role" style="padding: 6px 12px;">
                    <option value="">...Select Role...</option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">User Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="approved">Approved</option>
                    <option value="disapproved">Disapproved</option>
                </select>
            </div>

            <div class="col-lg-2 col-lg-offset-5">
                <button type="submit" name="insert" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>