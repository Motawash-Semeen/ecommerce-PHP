<?php
include("./includes/header.php");
?>
<?php

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['role'] == 'user') {
        header("Location: ../index.php");
    }
}
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


    if ($fname == '' or $lname == '' or $email == '' or $user_name == '') {
        echo "<p>Please Enter Required Data!</p>";
        header("Location:  profile.php");
    } else {


        $sql_up = "UPDATE `users` SET `username`='$user_name',`user_fname`='$fname',`user_lname`='$lname',`user_email`='$email',`user_phone`='$phone',`user_address`='$address' WHERE `user_id` = '$id'";

        $re_up = $conn->query($sql_up);
        $_SESSION['username'] = $user_name;
        header("Location:  profile.php");
    }
}
?>
<?php
if (isset($_POST['upphoto'])) {

    $id = $_SESSION['id'];

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

    $sql_upphoto = "UPDATE `users` SET `user_img`='$new_img_name' WHERE `user_id` = '$id'";

    $conn->query($sql_upphoto);
    header("Location:  profile.php");
}
?>


<div id="wrapper">

    <!-- Navigation -->

    <?php
    include("./includes/navigation.php");
    ?>

    <div id="page-wrapper" style="height: 100%;">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="profile.php"><i class="fa fa-file"></i> Profile</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-3"><!--left col-->


                    <div class="text-center">
                        <form class="form" action="" method="post" enctype="multipart/form-data">
                            <?php
                            $img = $v['user_img'];
                            if ($img == null) {
                                echo "<img src='https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg' class='avatar img-circle img-thumbnail' alt='avatar' width='150'>";
                            } else {
                                echo " <img src='../img/user/$img' class='avatar img-circle img-thumbnail' alt='avatar' width='150px' height='150px' style='object-fit: cover;height:150px;'>";
                            }
                            ?>

                            <h6>Upload a different photo...</h6>
                            <input type="file" name="image" class="text-center center-block file-upload">
                            <input type="hidden" name="old_image" class="text-center center-block file-upload" value="<?php echo $v['user_img'] ?>">
                            <input type="submit" name="upphoto" value="Submit" class="btn btn-info">
                        </form>
                    </div>
                    </hr><br>


                    <div class="panel panel-default">
                        <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                        <div class="panel-body"><a href="index.php">ecom.com</a></div>
                    </div>


                    <ul class="list-group">
                        <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 125</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Comments</strong></span> 37</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
                    </ul>

                    <div class="panel panel-default">
                        <div class="panel-heading">Social Media</div>
                        <div class="panel-body">
                            <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                        </div>
                    </div>

                </div><!--/col-3-->
                <div class="col-sm-9">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>

                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <hr>
                            <form class="form" action="" method="post" id="registrationForm">
                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="first_name">
                                            <h4>First name</h4>
                                        </label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any." value="<?php echo $v['user_fname'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="last_name">
                                            <h4>Last name</h4>
                                        </label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any." value="<?php echo $v['user_lname'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="phone">
                                            <h4>User Name</h4>
                                        </label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="enter username" title="enter your username." value="<?php echo $v['username'] ?>">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="email">
                                            <h4>Email</h4>
                                        </label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="<?php echo $v['user_email'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="phone">
                                            <h4>User Phone</h4>
                                        </label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your username." value="<?php echo $v['user_phone'] ?>">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="email">
                                            <h4>User Address</h4>
                                        </label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="123, ABC" title="enter your email." value="<?php echo $v['user_address'] ?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="password">
                                            <h4>Password</h4>
                                        </label>
                                        <input type="text" class="form-control" name="password" id="password" placeholder="password" title="enter your password." value="<?php //echo $v['user_password'] 
                                                                                                                                                                            ?>">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-lg btn-success" type="submit" name="update"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                        <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                    </div>
                                </div>
                            </form>

                            <hr>

                        </div><!--/tab-pane-->
                    </div><!--/tab-pane-->
                </div><!--/tab-content-->
            </div><!--/col-9-->
        </div><!--/row-->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


<?php
include("./includes/footer.php");
?>