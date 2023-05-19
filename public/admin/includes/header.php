<?php
session_start();
?>
<?php
ob_start();
?>
<?php 
include("./includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Item', 'Total', 'Active', 'Not Active'],

  //['products', 12, 12, 0],['categories', 9, 9, 0],['users', 3, 3, 0],
                <?php
                $array = ['products', 'categories', 'users', 'orders'];
                $array2 = ['product_status', 'cat_status', 'user_status', 'order_status'];
                $count = [];
                $count2 = [];

                for ($i = 0; $i < 4; $i++) {
                    $sql = "SELECT * FROM {$array[$i]}";
                    $res = $conn->query($sql);
                    $count[$i] = mysqli_num_rows($res);

                    $sql2 = "SELECT * FROM {$array[$i]} WHERE {$array2[$i]} = 'approved' or {$array2[$i]} = 'active' or {$array2[$i]} = 'completed'";
                    $res2 = $conn->query($sql2);
                    $count2[$i] = mysqli_num_rows($res2);
                    $draft = $count[$i] - $count2[$i];
                    echo "['{$array[$i]}',{$count[$i]}, {$count2[$i]}, {$draft}],";
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Website Statistic',
                    subtitle: 'Products, Users and Categories',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

</head>

<body>

