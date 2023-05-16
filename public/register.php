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
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $confirm_password = $_POST['confirm_password'];
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $number = mysqli_real_escape_string($conn, $number);
    $address = mysqli_real_escape_string($conn, $address);
    $username = mysqli_real_escape_string($conn, $username);

    if($password == $confirm_password){
        $password = md5($password);
        $sql = "INSERT INTO `users`(`user_fname`, `user_lname`, `username`, `user_email`, `user_password`, `user_phone`, `user_address`) VALUES ('$fname','$lname','$username','$email','$password', '$number','$address')";
        $res = $conn->query($sql);
        header("Location: login.php");
    }
    else{
        $msg = "Password doesn't matched!!";
    }

}

?>
<div class="container">

    <header>
        <h1 class="text-center">Register</h1>
        <div class="">
        <h3 class="text-center my-3" style='color:red;'><?php echo $msg ?></h3>
            <form class="row" action="" method="post" enctype="multipart/form-data" style="width:70%; margin:auto;">
            
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        First Name
                        <input type="text" name="fname" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        Last Name
                        <input type="text" name="lname" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        Phone Number
                        <input type="text" name="number" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        Address
                        <input type="text" name="address" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        UserName
                        <input type="text" name="username" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="" style="width:100%;">
                        email
                        <input type="text" name="email" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="password" style="width:100%;">
                        Password
                        <input type="password" name="password" class="form-control" required>
                    </label>
                </div>
                <div class="form-group col-lg-6" style="width:100%;">
                    <label for="password" style="width:100%;">
                        Confirm Password
                        <input type="password" name="confirm_password" class="form-control" required>
                    </label>
                </div>

                <div class="form-group" style="width:100%; display:flex;  align-items: center; justify-content: center;">
                    <input type="submit" name="register" class="btn btn-primary">
                </div>
            </form>
        </div>


    </header>


</div>

<!-- Footer Start -->
<?php
include("./includes/footer.php");
?>
<!-- Footer End -->