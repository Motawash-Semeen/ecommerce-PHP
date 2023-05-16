<?php
if (isset($_GET['status'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'user') {
        } else {
            $id = $_GET['id'];
            if ($_GET['status'] == 'pending') {
                $satus = 'completed';
            } else {
                $satus = 'pending';
            }
            $sql_status = "UPDATE orders SET order_status = '$satus' WHERE order_id = '$id'";
            $conn->query($sql_status);
            header("Location: index.php?orders");
        }
    }
}
if (isset($_GET['delete'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'user') {
        } else {
            $id = $_GET['id'];
            $sql_status = "DELETE FROM `orders` WHERE  order_id = '$id'";
            $conn->query($sql_status);
            header("Location: index.php?orders");
        }
    }
}
?>


<div class="col-md-12">
    <div class="row">
        <h1 class="page-header">
            All Orders

        </h1>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>

                <tr>
                    <th>S.N</th>
                    <th>User Details</th>
                    <th>Product</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT *
                FROM orders
                INNER JOIN users
                ON orders.user_id = users.user_id;";
                $res = $conn->query($sql);
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_array()) {
                        
                        echo "
        <tr>
                    <td>21</td>
                    <td>
                        <p>Username: {$row['username']}</p>
                        <p>Email: {$row['order_email']}</p>
                        <p>Phone: {$row['order_phone']}</p>
                        <p>Address: {$row['order_address']}</p>
                    </td>

                    <td>
                        <ul>"
                ?>
                        <?php

                        $quan_array = explode(",", $row['order_quantity']);
                        $id_array = explode(",", $row['product_id']);
                        //print_r($quan_array);
                        //print_r($id_array);
                        for ($i = 0; $i < sizeof($quan_array); $i++) {
                            $sql_up = "SELECT * FROM `products` WHERE product_id = '$id_array[$i]'";
                            $res = $conn->query($sql_up);
                            $v = $res->fetch_array();

                            echo "<li>{$v['product_title']} - {$quan_array[$i]} Item</li>";
                        }
                        ?>
                <?php

                        echo "</ul>
                    </td>
                    <td>{$row['order_amount']}</td>
                    <td>{$row['order_date']}</td>
                    <td> <a href='index.php?orders&id={$row['order_id']}&status={$row['order_status']}' class='btn btn-info'>
                    {$row['order_status']}
                        </a></td>
                    <td><a class='btn btn-danger' href='index.php?orders&id={$row['order_id']}&delete'><span class='glyphicon glyphicon-remove'></span></a></td>
                </tr>
        ";
                    }
                }

                ?>
                <!-- <tr>
                    <td>21</td>
                    <td>
                        <p>Username: Nikon 234</p>
                        <p>Email: Nikon 234</p>
                        <p>Phone: Nikon 234</p>
                        <p>Address: Nikon 234</p>
                    </td>

                    <td>
                        <ul>
                            <li>Hi</li>
                        </ul>
                    </td>
                    <td>456464</td>
                    <td>Jun 2039</td>
                    <td>Completed</td>
                    <td><a class='btn btn-danger' href=""><span class='glyphicon glyphicon-remove'></span></a></td>

                </tr> -->


            </tbody>
        </table>
    </div>


</div>
<!-- /.container-fluid -->