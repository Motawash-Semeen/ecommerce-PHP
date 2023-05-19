<!-- USER ONLINE PHP -->

<?php 
$session = session_id();
$time = time();
$time_out_in_sec = 60;
$timeout = $time-$time_out_in_sec;

$query =  "SELECT * FROM users_online WHERE session='$session'";
$res = $conn->query($query);
$count_online = mysqli_num_rows($res);

if($count_online==null){
    $query_in = "INSERT INTO users_online(session, time) VALUES ('$session','$time')";
    $conn->query($query_in);
}
else{
    $query_in = "UPDATE users_online SET `time`='$time' WHERE `session`='$session'";
    $conn->query($query_in);
}
    $query_in = "SELECT * FROM users_online WHERE time > '$timeout'";
    $users_online = $conn->query($query_in);
    $count = mysqli_num_rows($users_online);
?>



<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Ecom Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>
            <a href="#">Users Online:<?php echo $count; ?></a>
        </li>
        <li>
            <a href="../index.php">Home</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li class="divider"></li>
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php
    include("sidebar.php");
    ?>
    <!-- /.navbar-collapse -->
</nav>