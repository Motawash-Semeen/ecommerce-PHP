
<div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php 
$sql = "SELECT * FROM banners WHERE banner_status = 'active'";
$res = $conn->query($sql);
if($res->num_rows > 0){
    $active = 'active';
    while($row = $res->fetch_array()){

        echo "<div class='carousel-item position-relative $active' style='height: 430px;'>
        <img class='position-absolute w-100 h-100' src='img/banner/$row[banner_img]' style='object-fit: cover;'>
        <div class='carousel-caption d-flex flex-column align-items-center justify-content-center'>
            <div class='p-3' style='max-width: 700px;'>
                <h1 class='display-4 text-white mb-3 animate__animated animate__fadeInDown'>$row[banner_title]</h1>
                <p class='mx-md-5 px-5 animate__animated animate__bounceIn'>$row[banner_des]</p>
                <a class='btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp' href='$row[banner_link]'>Shop Now</a>
            </div>
        </div>
    </div>";
    $active = '';
    }
}

?>
                        <!-- <div class='carousel-item position-relative active' style='height: 430px;'>
                            <img class='position-absolute w-100 h-100' src='img/carousel-1.jpg' style='object-fit: cover;'>
                            <div class='carousel-caption d-flex flex-column align-items-center justify-content-center'>
                                <div class='p-3' style='max-width: 700px;'>
                                    <h1 class='display-4 text-white mb-3 animate__animated animate__fadeInDown'>Men Fashion</h1>
                                    <p class='mx-md-5 px-5 animate__animated animate__bounceIn'>Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class='btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp' href='#'>Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                          -->
                    </div>
                </div>
            </div>
            <?php include("includes/sidebanner.php");?>
        </div>
    </div>
    

<!-- Featured icon Start -->
    
<div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured icon End -->