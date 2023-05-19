<?php
if (isset($_GET['status'])) {
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'user') {
    } else {
      $id = $_GET['id'];
      if ($_GET['status'] == 'deactive') {
        $satus = 'active';
      } else {
        $satus = 'deactive';
      }
      $sql_status = "UPDATE products SET product_status = '$satus' WHERE product_id = '$id'";
      $conn->query($sql_status);
      header("Location: index.php?products");
    }
  }
}
if (isset($_GET['delete'])) {
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'user') {
    } else {
      $id = $_GET['id'];
      $sql_status = "DELETE FROM `products` WHERE  product_id = '$id'";
      $conn->query($sql_status);
      header("Location: index.php?products");
    }
  }
}
?>


<div class="row">

  <h1 class="page-header">
    All Products

  </h1>
  <div style="text-align:right; margin:auto;">
            <a href='index.php?add_product' class='btn btn-link btn-warning btn-just-icon edit' style="padding: 6px 12px; background-color:deepskyblue; border-radius: 5px; color:white; margin-bottom: 20px;">
                Add New Product
            </a>
  </div>
  <table class="table table-hover">


    <thead>

      <tr>
        <th>SN</th>
        <th>Title</th>
        <th>Category</th>
        <th>Sub Category</th>
        <th>Image</th>
        <th>Price</th>
        <th>Short Description</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Extra Info</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i=1;
      $sql = "SELECT *
      FROM products
      INNER JOIN categories
      ON products.product_cat_id = categories.cat_id
      INNER JOIN sub_cat
      ON products.pro_sub_cat_id = sub_cat.sub_cat_id";
      $res = $conn->query($sql);
      if ($res->num_rows > 0) {
        while ($row = $res->fetch_array()) {
          $desc =  substr($row['product_descript'],0,200).'...';
          $sdesc =  substr($row['extra_info'],0,200).'...';
          echo "<tr>
    <td>{$i}</td>
    <td>{$row['product_title']}</td>
    <td>{$row['cat_title']}</td>
    <td>{$row['sub_cat_title']}</td>
    <td> 
      <img src='../img/product/{$row['product_img']}' alt='' width='100'>
    </td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_short_desc']}</td>
    <td>{$desc}</td>
    <td>{$row['product_quantity']}</td>
    <td>{$sdesc}</td>
    <td>
    <a href='index.php?products&id={$row['product_id']}&status={$row['product_status']}' class='btn btn-info'>
    {$row['product_status']}
        </a>
        </td>
    <td>
    <a href='index.php?id={$row['product_id']}&edit_product' class='btn  btn-warning '>
    EDIT
</a>
<a onClick=\"javascript: return confirm('Are you sure you want to delete this Item?'); \" href='index.php?products&id={$row['product_id']}&delete' class='btn btn-danger '>
    DELETE
</a>
</td>
  </tr>";
  $i++;
        }
        
      }

      ?>


    </tbody>
  </table>

</div>