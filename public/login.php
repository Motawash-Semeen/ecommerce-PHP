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
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $v = $res->fetch_array();
        if ($v['user_status'] == 'active') {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $v['user_id'];
            $_SESSION['username'] = $v['username'];
            $_SESSION['role'] = $v['user_role'];
            $_SESSION['msg'] = null;
            header("Location: ./admin/index.php");
        } else {
            $_SESSION['msg'] = 'Pending For Approval!!';
            header("Location: login.php");
        }
    } else {
        $_SESSION['msg'] = 'Incorrect Password or Email!';
        header("Location: login.php");
    }
}

?>
<div class="container">

    <header>
        <h1 class="text-center">Login</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            echo "<h2 class='text-center bg-warning'>{$msg}</h2>";
        }
        ?>

        <div class="">
            <form class="row" action="" method="post" enctype="multipart/form-data" style="width:70%; margin:auto;">

                <div class="form-group" style="width:100%;">
                    <label for="" style="width:100%;">
                        email
                        <input type="text" name="email" class="form-control" required>
                    </label>
                </div>
                <div class="form-group" style="width:100%;">
                    <label for="password" style="width:100%;">
                        Password
                        <input type="password" name="password" class="form-control" required>
                    </label>
                </div>

                <div class="form-group" style="width:100%; display:flex;  align-items: center; justify-content: center;">
                    <input type="submit" name="login" class="btn btn-primary">
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