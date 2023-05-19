 <!-- FIRST ROW WITH PANELS -->

 <!-- /.row -->
 <?php
    $query = "SELECT * FROM products";
    $res = $conn->query($query);
    $num_pro = mysqli_num_rows($res);

    ?>
 <div class="row">
     <div class="col-lg-3 col-md-6">
         <div class="panel panel-primary">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-3">
                         <i class="fa fa-file-text fa-5x"></i>
                     </div>
                     <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $num_pro ?></div>
                         <div>Products</div>
                     </div>
                 </div>
             </div>
             <a href="index.php?products">
                 <div class="panel-footer">
                     <span class="pull-left">View Details</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
             </a>
         </div>
     </div>
     <?php
        $query = "SELECT * FROM orders";
        $res = $conn->query($query);
        $num_order = mysqli_num_rows($res);

        ?>
     <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-3">
                         <i class="fa fa-comments fa-5x"></i>
                     </div>
                     <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $num_order ?></div>
                         <div>Orders</div>
                     </div>
                 </div>
             </div>
             <a href="index.php?orders">
                 <div class="panel-footer">
                     <span class="pull-left">View Details</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
             </a>
         </div>
     </div>
     <?php
        $query = "SELECT * FROM users";
        $res = $conn->query($query);
        $num_users = mysqli_num_rows($res);

        ?>
     <div class="col-lg-3 col-md-6">
         <div class="panel panel-yellow">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-3">
                         <i class="fa fa-user fa-5x"></i>
                     </div>
                     <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $num_users ?></div>
                         <div> Users</div>
                     </div>
                 </div>
             </div>
             <a href="index.php?users">
                 <div class="panel-footer">
                     <span class="pull-left">View Details</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
             </a>
         </div>
     </div>
     <?php
        $query = "SELECT * FROM categories";
        $res = $conn->query($query);
        $num_cat = mysqli_num_rows($res);

        ?>
     <div class="col-lg-3 col-md-6">
         <div class="panel panel-red">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-3">
                         <i class="fa fa-list fa-5x"></i>
                     </div>
                     <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $num_cat ?></div>
                         <div>Categories</div>
                     </div>
                 </div>
             </div>
             <a href="index.php?category">
                 <div class="panel-footer">
                     <span class="pull-left">View Details</span>
                     <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
             </a>
         </div>
     </div>
 </div>
 <!-- /.row -->


 <!-- SECOND ROW WITH TABLES-->

 <div class="row">
     <div class="col-lg-4">
         <div class="panel panel-default">
             <div class="panel-heading">
                 <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
             </div>
             <div class="panel-body">
                 <div class="table-responsive">
                     <table class="table table-bordered table-hover table-striped">
                         <thead>
                             <tr>
                                 <th>Order #</th>
                                 <th>Order Date</th>
                                 <th>Amount (USD)</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $query = "SELECT * FROM orders";
                                $res = $conn->query($query);
                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_array()) {
                                        echo " <tr>
                                                <td>{$row['order_id']}</td>
                                                <td>{$row['order_date']}</td>
                                                <td><span>$</span>{$row['order_amount']}</td>
                                            </tr>";
                                    }
                                }
                                ?>


                         </tbody>
                     </table>
                 </div>
                 <div class="text-right">
                     <a href="index.php?orders">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
             </div>
         </div>
     </div>

     <div class="col-lg-8">
         <div class="panel panel-default">
         <div id="columnchart_material" style=" height: 500px;"></div>
        </div>
     </div>
 </div>
 <!-- /.row -->
