<?php include "includes/db.php"; ?>

<?php 
session_start();

unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['role']);
unset($_SESSION['msg']);

header("Location: ../index.php");
?>