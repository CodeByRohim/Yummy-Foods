<?php 
    include_once "../inc/BackendHeader.php";
    // BANNER IMG FETCH
include "../database/env.php";
$query = "SELECT banner_heading, banner_para, banner_img FROM banners ";
$resultBanner = mysqli_query($conn, $query);
$getBanner = mysqli_fetch_assoc($resultBanner);
// ABOUT US IMG FETCH
$queryAbout = "SELECT about_title, about_middle,about_bottom, about_img, about_thumbnail FROM about_us ";
$resultAbout = mysqli_query($conn, $queryAbout);
$getAbout = mysqli_fetch_assoc($resultAbout);
var_dump($getAbout);
?>
     <!-- Banner update  -->
     <section id="banner" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Banner Update</h4>
            <form action="../controller/BannerUpdateController.php" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="id" class="">
                <div class="row justify-content-around">
                    <div>
                       
                        <label class="d-block" for="banner_heading">Banner Heading </label>
                        <input class="form-control" style="width: 330px;"  id="banner_heading" type="text" name="banner_heading" value="<?= $getBanner['banner_heading'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['banner_heading'] ?? '' ?></span>
                        <label class="d-block" for="para">Banner Paragraph </label>
                        <input class="form-control" id="para" type="text" name="banner_para" value="<?= $getBanner['banner_para'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['banner_para'] ?? '' ?></span>
                    </div>
                    <div>
                        <label for="banner-img-input" class="d-block text-center" for="image">Banner Image </label>
                    <label class="d-block" for="banner-img-input"><img  src="<?= "../uploads/banner/" . $getBanner["banner_img"] ?? '' ?>" alt="" class="banner_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center" >
                    </label>
                    <input name="banner_img" class="d-none" id="banner-img-input" type="file" accept="image/*" value="<?= $getBanner['banner_img'] ?>">
                    <span class="text-danger"><?= $_SESSION['errors']['banner_error'] ?? '' ?></span>
                    </div>
                </div>
    
                <div class="d-flex justify-content-center mt-2"><button class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
    </section>
    <!-- About Us -->
     <section id="about" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">About Us</h4>
            <form action="../controller/AboutUsUpdateController.php" method="POST" enctype="multipart/form-data">
             <!-- <input type="hidden" name="id" class=""> -->
                <div class="row justify-content-around">
                <div class="d-flex text-center mt-3">
                    <!-- About Us Image -->
                    <div class="col-lg-6">
                        <label for="about-img-input" class="d-block text-center">About Us Image </label>
                        <label class="text-center" for="about-img-input"><img  src="<?= "../uploads/aboutimg/" . $getAbout['about_img']  ?>" alt="" class="about_image img-fluid rounded-circle text-center" style="width:150px; height:150px;object-fit:cover;object-position:center">
                        </label>
                        <input name="about_img" class="d-none" id="about-img-input" type="file" value="">
                        <span class="text-danger"><?= $_SESSION['errors']['about_img'] ?? '' ?></span>
                    </div>

                    <!-- About Us Thumbnail -->
                    <div class="col-lg-6">
                     <label for="about-thumbnail-input" class="d-block text-center">About Us Thumbnail </label>
                     <label class="" for="about-thumbnail-input"><img  src=" <?= "../uploads/aboutThumbnail/" . $getAbout['about_thumbnail']  ?>" alt="" class="about_thumbnail img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center">
                     </label>
                    <input name="about_thumbnail" class="d-none" id="about-thumbnail-input" type="file">
                    <span class="text-danger"><?= $_SESSION['errors']['about_thumbnail'] ?? '' ?></span>
                    </div>
                    </div>
                </div>

                    <div>                      
                        <label class="d-block" for="about_title">About Us Title</label>
                        <input class="form-control" id="about_title" type="text" name="about_title" value="<?= $getAbout['about_title'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_tile'] ?? '' ?></span>

                        <label class="d-block" for="about_middle">About Us Middle</label>
                        <input class="form-control" id="about_middle" type="text" name="about_middle" value="<?= $getAbout['about_middle'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_middle'] ?? '' ?></span>

                        <label class="d-block" for="about_bottom">About Us bottom</label>
                        <input class="form-control" id="about_bottom" type="text" name="about_bottom" value="<?= $getAbout['about_bottom'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_bottom'] ?? '' ?></span>
                    </div>

                
    
                <div class="d-flex justify-content-center mt-2"><button class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
    </section>
    <!-- Contact Info For Home Page Show -->
    <section id="contact-info" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Contact Info For Home Page Show</h4>
            <form action="../controller/ContactInfoUpdateController.php" method="POST">
              <input type="hidden" name="id">
    
                <label class="d-block" for="phone">Phone: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="phone" type="text" name="phone" >
                <span class="text-danger"><?= $_SESSION['errors']['phone'] ?? '' ?></span>
                <label class="d-block" for="email">Email: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="email" type="email" name="email" >
                <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>
    
                <label class="d-block" for="address">Address: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="address" type="text" name="address" >
                <span class="text-danger"><?= $_SESSION['errors']['address'] ?? '' ?></span>
    
                <label class="d-block" for="hours">Hours: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="hours" type="text" name="hours" >
                <span class="text-danger"><?= $_SESSION['errors']['hours'] ?? '' ?></span>
    
                <div class="d-flex justify-content-center mt-2"><button class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
    </section>
    <!-- Book a Table -->
    <section id="book-table" class="d-flex justify-content-center">
     <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Book a Table</h4>
            <form action="../controller/ContactInfoUpdateController.php" method="POST">
              <input type="hidden" name="id">
    
                <label class="d-block" for="fname">Full Name: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="fname" type="text" name="fullname" >
                <span class="text-danger"><?= $_SESSION['errors']['fname'] ?? '' ?></span>
    
                <label class="d-block" for="bemail">Email: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="bemail" type="email" name="email" >
                <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>
    
                <label class="d-block" for="bphone">Phone: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="bphone" type="text" name="phone" >
                <span class="text-danger"><?= $_SESSION['errors']['phone'] ?? '' ?></span>
    
    
                <label class="d-block" for="date">Date: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="date" type="date" name="date" >
                <span class="text-danger"><?= $_SESSION['errors']['date'] ?? '' ?></span>
    
                <label class="d-block" for="time">Time: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="time" type="text" name="time" >
                <span class="text-danger"><?= $_SESSION['errors']['time'] ?? '' ?></span>
    
                <label class="d-block" for="people">Time: </label>
                <input class="form-control" style="width: 100%; border: 1px solid rgb(92, 180, 83);" id="people" type="text" name="people" >
                <span class="text-danger"><?= $_SESSION['errors']['people'] ?? '' ?></span>
    
                <div class="d-flex justify-content-center mt-2"><button class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
     </section>


<?php 
    include_once "../inc/BackendFooter.php";
    
  ?>