<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">

            <?php 
$sql = "SELECT * FROM vendors WHERE vendor_status='active'";
$res = $conn->query($sql);
if($res->num_rows > 0){
    while($row = $res->fetch_array()){
        echo"<div class='bg-light p-4'>
        <img src='img/vendor/{$row['vendor_img']}' alt='{$row['vendor_title']}'>
    </div>";
    }
}
?>
            </div>
        </div>
    </div>
</div>