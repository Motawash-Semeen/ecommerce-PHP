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
  <table class="table table-hover">


    <thead>

      <tr>
        <th>SN</th>
        <th>Title</th>
        <th>Category</th>
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
      $sql = "SELECT *
FROM products
INNER JOIN categories
ON products.product_cat_id = categories.cat_id;";
      $res = $conn->query($sql);
      if ($res->num_rows > 0) {
        while ($row = $res->fetch_array()) {
          echo "<tr>
    <td>20</td>
    <td>{$row['product_title']}</td>
    <td>{$row['cat_title']}</td>
    <td> 
      <img src='../img/{$row['product_img']}' alt='' width='100'>
    </td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_short_desc']}</td>
    <td>{$row['product_descript']}</td>
    <td>{$row['product_quantity']}</td>
    <td>{$row['extra_info']}</td>
    <td>
    <a href='index.php?products&id={$row['product_id']}&status={$row['product_status']}' class='btn btn-info'>
    {$row['product_status']}
        </a>
        </td>
    <td>
    <a href='index.php?products&id={$row['product_id']}&source=edit' class='btn  btn-warning '>
    EDIT
</a>
<a onClick=\"javascript: return confirm('Are you sure you want to delete this Item?'); \" href='index.php?products&id={$row['product_id']}&delete' class='btn btn-danger '>
    DELETE
</a>
</td>
  </tr>";
        }
      }

      ?>
      <tr>
        <td>20</td>
        <td>Nikon 234 </td>
        <td>
          <img src='http://placehold.it/62x62' alt=''>
        </td>
        <td>Category</td>
        <td>123</td>
      </tr>



    </tbody>
  </table>

</div>