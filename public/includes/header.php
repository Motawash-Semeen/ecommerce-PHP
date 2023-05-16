<?php
session_start();
?>
<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
    
/**********************************/
/********* My Account CSS *********/
/**********************************/
.my-account {
    position: relative;
    padding: 30px 0;
}

.my-account .nav.nav-pills .nav-link {
    padding: 10px 15px;
    color: #353535;
    background: #ffffff;
    border-radius: 0;
    border-bottom: 1px solid #dddddd;
    transition: all .3s;
}

.my-account .nav.nav-pills .nav-link:last-child {
    border-bottom: none;
}

.my-account .nav.nav-pills .nav-link:hover,
.my-account .nav.nav-pills .nav-link.active {
    color: #ffffff;
    background: #ffc800;
}

.my-account .nav.nav-pills .nav-link i {
    margin-right: 5px;
}

.my-account .tab-content {
    padding: 30px;
    background: #ffffff;
}

.my-account .tab-content .table {
    width: 100%;
    text-align: center;
    margin-bottom: 0;
}

.my-account .tab-content .table .thead-dark th {
    text-align: center;
    color: #353535;
    background: #ffffff;
    border-color: #dddddd;
    border-bottom: none;
    vertical-align: middle;
}

.my-account .tab-content .table td {
    vertical-align: middle;
}


/**********************************/
/******* Call to Action CSS *******/
/**********************************/
.call-to-action {
    position: relative;
    padding: 30px 0;
    background: #ffc800;
}

.call-to-action .col-md-6:last-child {
    text-align: right;
}

.call-to-action h1 {
    color: #ffffff;
    font-size: 30px;
    margin: 0;
}

.call-to-action a {
    display: inline-block;
    padding: 0 20px;
    border: 1px solid #ffffff;
    border-radius: 4px;
    color: #ffffff;
    font-size: 30px;
    letter-spacing: 2px;
    transition: all .3s;
}

.call-to-action a:hover {
    color: #000000;
    border-color: #000000;
}

@media (max-width: 767.98px) {
    .call-to-action,
    .call-to-action .col-md-6:last-child {
        text-align: center;
    }
    
    .call-to-action h1 {
        margin-bottom: 20px;
    }
}
</style>
</head>

<body>

<?php 
include("./includes/db.php");
$total_qun = 0;
?>