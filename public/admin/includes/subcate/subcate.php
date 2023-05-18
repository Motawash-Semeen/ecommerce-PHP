<?php

$sql_data = "SELECT * FROM sub_cat INNER JOIN categories
ON sub_cat.cat_id = categories.cat_id;";

$result_data = $conn->query($sql_data);

?>
<?php
if (isset($_SESSION['id'])) {
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM sub_cat WHERE sub_cat_id = '$id'";
        $conn->query($sql);
        header("Location: index.php?subcategory");
    }
}
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
        $sql_status = "UPDATE sub_cat SET sub_cat_status = '$satus' WHERE sub_cat_id = '$id'";
        $conn->query($sql_status);
        header("Location: index.php?subcategory");
      }
    }
  }

?>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div style="text-align:right; margin:auto;">
            <a href='index.php?add_subcategory' class='btn btn-link btn-warning btn-just-icon edit'
                style="padding: 6px 12px; background-color:deepskyblue; border-radius: 5px; color:white; margin-bottom: 20px;">
                Add New Sub Category
            </a>
        </div>
        <div class="card">
            <div class="card-header card-header-primary card-header-icon col-lg-6 col-lg-offset-5">
                <h3 class="card-title">Sub Category Table</h3>
            </div>
            <div class="card-body">
                <div class="toolbar"></div>
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">

                            <div class="col-sm-12 col-md-2 col-lg-offset-7">
                                <div id="datatables_filter" class="dataTables_filter"><label class="form-group"><input
                                            type="search" class="form-control form-control-sm"
                                            placeholder="Search records" aria-controls="datatables"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-offset-3">
                                <table id="datatables" cellspacing="0" width="100%"
                                    class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                                    style="width: 100%;" role="grid" aria-describedby="datatables_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1"
                                                colspan="1" style="width: 287px;" aria-sort="ascending"
                                                aria-label="SN: activate to sort column descending">SN</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1"
                                                colspan="1" style="width: 287px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Name</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1"
                                                colspan="1" style="width: 287px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Category Name</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1"
                                                colspan="1" style="width: 287px;" aria-sort="ascending">Image</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1"
                                                colspan="1" style="width: 287px;" aria-sort="ascending"
                                                aria-label="Status: activate to sort column descending">Status</th>

                                            <th class="disabled-sorting text-right sorting" tabindex="0"
                                                aria-controls="datatables" rowspan="1" colspan="1" style="width: 318px;"
                                                aria-label="Actions: activate to sort column ascending">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        if ($result_data->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $result_data->fetch_array()) {
                                                echo "<tr role='row' class='odd'>
                                                                <td tabindex='0' class='sorting_1'>{$i}</td>
                                                                <td tabindex='0' class='sorting_1'>{$row['sub_cat_title']}</td>
                                                                <td tabindex='0' class='sorting_1'>{$row['cat_title']}</td>
                                                                <td tabindex='0' class='sorting_1'>
                                                                <img src='../img/subcate/{$row['sub_cat_img']}' alt='cat_img' width='100'>
                                                                </td>
                                                                <td tabindex='0' class='sorting_1'>
                                                                <a href='index.php?subcategory&id={$row['sub_cat_id']}&status={$row['sub_cat_status']}' class='btn btn-info'>{$row['sub_cat_status']}</a>
                                                                </td>
                                                                
                                                                <td class='text-right'>
                                                                    <a href='index.php?id={$row['sub_cat_id']}&edit_subcategory' class='btn  btn-warning '>
                                                                    EDIT
                                                                    </a>
                                                                    <a onClick=\"javascript: return confirm('Are you sure you want to delete this Item?'); \" href='index.php?id={$row['sub_cat_id']}&subcategory&delete' class='btn btn-danger'>
                                                                    DELETE
                                                                    </a>
                                                                </td>
                                                            </tr>";
                                                $i++;
                                            }
                                        } else {
                                            echo "<h2>No Data Found</h2>";
                                        }
?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>