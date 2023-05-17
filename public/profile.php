<?php
include("./includes/header.php");
?>
<!-- Topbar Start -->
<?php
include("./includes/topbar.php");
?>

<!-- Topbar End -->
<!-- Navbar Start -->
<?php
include("./includes/navbar.php");
?>

<!-- Navbar End -->
<?php
$msg = '';

?>


<?php
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql_user = "SELECT * FROM users WHERE user_id = '$id'";
    $result = $conn->query($sql_user);
    $v = $result->fetch_array();
}
?>


<?php
if (isset($_POST['update'])) {

    $id = $_SESSION['id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $user_name = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $email = mysqli_real_escape_string($conn, $email);
    $user_name = mysqli_real_escape_string($conn, $user_name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);


    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = './img/user/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
        }
        if ($img_name == '') {
            $new_img_name = $_POST['old_image'];
        }
    }


    if ($fname == '' or $lname == '' or $email == '' or $user_name == '') {
        echo "<p>Please Enter Required Data!</p>";
        header("Location:  profile.php");
    } else {


        $sql_up = "UPDATE `users` SET `username`='$user_name',`user_fname`='$fname',`user_lname`='$lname',`user_email`='$email',`user_phone`='$phone',`user_address`='$address', `user_img`='$new_img_name' WHERE `user_id` = '$id'";

        $re_up = $conn->query($sql_up);
        $_SESSION['username'] = $user_name;
        header("Location:  profile.php#account-tab");
    }
}
?>

<?php
if (isset($_POST['pass'])) {
    $id = $_SESSION['id'];

    $old_pass = md5(mysqli_real_escape_string($conn, $_POST['old_pass']));
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $conf_pass = mysqli_real_escape_string($conn, $_POST['conf_pass']);

    $sql_find = "SELECT * FROM users WHERE `user_id` = '$id' and `user_password` = '$old_pass'";
    $res_find = $conn->query($sql_find);
    if ($res_find->num_rows > 0) {
        if ($new_pass == $conf_pass) {
            $new_pass =  md5($new_pass);
            $sql_pass = "UPDATE `users` SET `user_password`='$new_pass' WHERE `user_id` = '$id'";
            $res_pass = $conn->query($sql_pass);
            header("Location:  admin/logout.php");
        } else {
            $msg = 'Passowrd is worng!!';
        }
    }
}


?>


<div class="container">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">My Account</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- My Account Start -->
    <div class="my-account">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i>Dashboard</a>
                        <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                        <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                        <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>address</a>
                        <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>
                        <a class="nav-link" href="admin/logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                            <h4>Dashboard</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                            $id = $_SESSION['id'];
                                            $i = 1;

                                            $sql_order = "SELECT * FROM orders WHERE user_id = '$id'";
                                            $res_order = $conn->query($sql_order);
                                            if ($res_order->num_rows > 0) {
                                                while ($row = $res_order->fetch_array()) {
                                                    $str_array = explode(",", $row['product_id']);
                                                    echo "
                                                            <tr>
                                                                <td>{$i}</td>
                                                                <td>
                                                                <ul>"
                                        ?>
                                        <?php
                                                    for ($i = 0; $i < count($str_array); $i++) {
                                                        $sql = "SELECT * FROM products WHERE product_id = '$str_array[$i]'";
                                                        $res = $conn->query($sql);
                                                        $pro = $res->fetch_array(); 
                                                        echo "<li>{$pro['product_title']}</li>";
                                                    }
                                                    echo "</ul>
                                                            </td>
                                                            <td>{$row['order_date']}</td>
                                                            <td><span>$</span>{$row['order_amount']}</td>
                                                            <td>{$row['order_status']}</td>
                                                            <td><button class='btn'>View</button></td>
                                                        </tr>
                                                        ";
                                                    $i++;
                                                }
                                            }
                                            else{
                                                echo "<tr><td colspan='6'>No data!!</td></tr>";
                                            }
                                        }

                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                            <h4>Payment Method</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                            <h4>Address</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <h5>Payment Address</h5>
                                    <p><?php echo $v['user_address'] ?></p>
                                    <p>Mobile: <?php echo $v['user_phone'] ?></p>
                                    <button class="btn btn-warning rounded text-white">Edit Address</button>
                                </div>
                                <div class="col-md-6">
                                    <h5>Shipping Address</h5>
                                    <p>123 Shipping Street, Los Angeles, CA</p>
                                    <p>Mobile: 012-345-6789</p>
                                    <button class="btn btn-warning rounded text-white">Edit Address</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-md-6 my-2">
                                        <?php
                                        $img = $v['user_img'];
                                        if ($img == null) {
                                            echo "<img src='https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg' class='avatar img-circle img-thumbnail' alt='avatar' width='150'>";
                                        } else {
                                            echo " <img src='./img/user/$img' class='avatar img-circle img-thumbnail' alt='avatar' width='150px' height='150px' style='object-fit: cover;height:150px;'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input type="file" name="image" class="text-center center-block file-upload">
                                        <input type="hidden" name="old_image" class="text-center center-block file-upload" value="<?php echo $v['user_img'] ?>">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" name='first_name' type="text" placeholder="First Name" value="<?php echo $v['user_fname'] ?>">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" name='last_name' type="text" placeholder="Last Name" value="<?php echo $v['user_lname'] ?>">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" name='username' type="text" placeholder="Username" value="<?php echo $v['username'] ?>">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" name='phone' type="text" placeholder="Mobile" value="<?php echo $v['user_phone'] ?>">
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <input class="form-control" name='email' type="email" placeholder="Email" value="<?php echo $v['user_email'] ?>">
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <input class="form-control" name='address' type="text" placeholder="Address" value="<?php echo $v['user_address'] ?>">
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <button type='submit' name='update' class="btn btn-info rounded">Update Account</button>
                                        <br><br>
                                    </div>

                                </div>
                            </form>
                            <h4>Password change</h4>
                            <form method='post' action="">
                                <div class="row">
                                    <h3 style='color:red; text-align:center;'></h3><?php echo $msg ?></h3>
                                    <div class="col-md-12 my-2">
                                        <input class="form-control" type="password" placeholder="Current Password" name='old_pass'>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" type="password" placeholder="New Password" name='new_pass'>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input class="form-control" type="password" placeholder="Confirm Password" name='conf_pass'>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <button type='submit' name='pass' class="btn btn-info rounded">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account End -->


</div>

<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->