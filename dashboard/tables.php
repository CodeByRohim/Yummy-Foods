<?php 
    include_once "../inc/BackendHeader.php";
    // BANNER IMG FETCH
    include "../database/env.php";
    $query = "SELECT banner_heading, banner_para, banner_img, cta_text, cta_link, banner_url FROM banners ";
    $resultBanner = mysqli_query($conn, $query);
    $getBanner = mysqli_fetch_assoc($resultBanner);
    // ABOUT US IMG FETCH
    $queryAbout = "SELECT about_title, about_middle,about_bottom, about_img, about_thumbnail, video_url FROM about_us ";
    $resultAbout = mysqli_query($conn, $queryAbout);
    $getAbout = mysqli_fetch_assoc($resultAbout);
    // STATS FETCH
    $queryStats = "SELECT clients, projects, support, workers, stats_img FROM stat";
    $resultStats = mysqli_query($conn, $queryStats);
    $getStats = mysqli_fetch_assoc($resultStats);
    // MENU FETCH
    $queryMenu = "SELECT id, menu_img, menu_name, menu_price, menu_details FROM menu ORDER BY id DESC";
    $resultMenu = mysqli_query($conn, $queryMenu);
    $getMenu = mysqli_fetch_assoc($resultMenu);

?>

     <!-- Banner update  -->
     <section id="banner" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Banner Section</h4>
            <form action="../controller/BannerUpdateController.php" method="POST" enctype="multipart/form-data">
            
             <input type="hidden" name="id" class="">
                <div class="row justify-content-around">
                    <div>
                       
                        <label class="d-block mt-3" for="banner_heading">Banner Heading <span class="text-danger">*</span> </label>
                        <input class="form-control" style="width: 330px;"  id="banner_heading" type="text" name="banner_heading" value="<?= $getBanner['banner_heading'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['banner_heading'] ?? '' ?></span>
                        
                        <label class="d-block mt-3" for="para">Banner Paragraph </label>
                        <input class="form-control" id="para" type="text" name="banner_para" value="<?= $getBanner['banner_para'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['banner_para'] ?? '' ?></span>
 
                        <label class="d-block mt-3" for="cta-text">CTA Text <span class="text-danger">*</span></label>
                        <input class="form-control" id="cta-text" type="text" name="cta_text" value="<?= $getBanner['cta_text'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['cta_text'] ?? '' ?></span>

                        <label class="d-block mt-3" for="cta-link">CTA Link</label>
                        <input class="form-control" id="cta-link" type="text" name="cta_link" value="<?= $getBanner['cta_link'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['cta_link'] ?? '' ?></span>

                        <label class="d-block mt-3" for="url">Banner Video URL </label>
                        <input class="form-control" id="url" type="text" name="banner_url" value="<?= $getBanner['banner_url'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['banner_url'] ?? '' ?></span>
                    </div>
                    
                    <div class="d-flex flex-column justify-content-center">
                        <label for="banner-img-input" class="d-block text-center" for="image">Banner Image <span class="text-danger">*</span></label>
                    <label class="d-block mt-1" for="banner-img-input"><img  src="<?= "../uploads/banner/" . $getBanner["banner_img"] ?? '' ?>" alt="" class="banner_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center" >
                    </label>
                    <input name="banner_img" class="d-none" id="banner-img-input" type="file" accept="image/*" value="<?= $getBanner['banner_img'] ?? '' ?>">
                    <span class="text-danger"><?= $_SESSION['errors']['banner_error'] ?? '' ?></span>
                    </div>
                </div>
    
                <div class="mt-3 ml-4"><button class="btn btn-primary" type="submit">Banner Update</button></div>
            </form>
        </div>
    </section>
    <!-- About Us -->
     <section id="about" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">About Us Section</h4>
            <form action="../controller/AboutUsUpdateController.php" method="POST" enctype="multipart/form-data">
           
             <!-- <input type="hidden" name="id" class=""> -->
                <div class="row justify-content-around">
                <div class="d-flex text-center mt-3">
                    <!-- About Us Image -->
                    <div class="col-lg-6">
                        <label for="about-img-input" class="d-block text-center">About Us Image <span class="text-danger">*</span></label>
                        <label class="text-center" for="about-img-input"><img  src="<?= "../uploads/aboutimg/" . $getAbout['about_img'] ?? '' ?>" alt="" class="about_image img-fluid rounded-circle text-center" style="width:150px; height:150px;object-fit:cover;object-position:center">
                        </label>
                        <input name="about_img" class="d-none" id="about-img-input" type="file" value="<?= $getAbout['about_img'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_img'] ?? '' ?></span>
                    </div>

                    <!-- About Us Thumbnail -->
                    <div class="col-lg-6">
                     <label for="about-thumbnail-input" class=" text-center">About Us Thumbnail <span class="text-danger">*</span></label>
                     <label class="" for="about-thumbnail-input"><img  src=" <?= "../uploads/aboutThumbnail/" . $getAbout['about_thumbnail']  ?>" alt="" class="about_thumbnail img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center">
                     </label>
                    <input name="about_thumbnail" class="d-none" id="about-thumbnail-input" type="file" value="<?= $getAbout['about_thumbnail'] ?? ''?>">
                    <span class="text-danger"><?= $_SESSION['errors']['about_thumbnail'] ?? '' ?></span>
                    </div>
                    </div>
                </div>

                    <div>                      
                        <label class="d-block mt-3" for="about_title">About Us Title <span class="text-danger">*</span></label>
                        <input class="form-control" id="about_title" type="text" name="about_title" value="<?= $getAbout['about_title'] ?? ''?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_tile'] ?? '' ?></span>

                        <label class="d-block mt-3" for="about_middle">About Us Middle</label>
                        <input class="form-control" id="about_middle" type="text" name="about_middle" value="<?= $getAbout['about_middle'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_middle'] ?? '' ?></span>

                        <label class="d-block mt-3" for="about_bottom">About Us bottom</label>
                        <input class="form-control" id="about_bottom" type="text" name="about_bottom" value="<?= $getAbout['about_bottom'] ?? ''?>">
                        <span class="text-danger"><?= $_SESSION['errors']['about_bottom'] ?? '' ?></span>

                        <label class="d-block mt-3" for="video_url">About Us Video Url</label>
                        <input class="form-control" id="video_url" type="text" name="video_url" value="<?= $getAbout['video_url'] ?? ''?>">
                        <span class="text-danger"><?= $_SESSION['errors']['video_url'] ?? '' ?></span>
                    </div>

                 <div class="mt-3"><button class="btn btn-primary" type="submit">About Update</button></div>
            </form>
        </div>
    </section>
     <!-- Stats update  -->
     <section id="stats" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Stats Section</h4>
            <form action="../controller/StatsUpdateController.php" method="POST" enctype="multipart/form-data">
             
                <div class="row justify-content-around">
                    <div>
                       <input type="hidden" name="id">
                        <label class="d-block mt-3" for="clients">Stats Clients</label>
                        <input class="form-control" style="width: 330px;"  id="clients" type="number" name="clients" value="<?= $getStats['clients'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['clients_error'] ?? '' ?></span>

                        <label class="d-block mt-3" for="projects">Stats Projects</label>
                        <input class="form-control" id="projects" type="number" name="projects" value="<?= $getStats['projects'] ?? ''?>">
                        <span class="text-danger"><?= $_SESSION['errors']['projects_error'] ?? '' ?></span>

                        <label class="d-block mt-3" for="support">Our Of Support</label>
                        <input class="form-control" id="support" type="number" name="support" value="<?= $getStats['support'] ?? '' ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['support_error'] ?? '' ?></span>

                        <label class="d-block mt-3" for="workers">Stats Workers</label>
                        <input class="form-control" id="workers" type="number" name="workers" value="<?= $getStats['workers'] ?? ''?>">
                        <span class="text-danger"><?= $_SESSION['errors']['workers_error'] ?? '' ?></span>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <label for="stats-img-input" class="d-block text-center">Stats Background Image <span class="text-danger">*</span> </label>
                    <label class="d-block mt-2" for="stats-img-input"><img  src="<?= "../uploads/stats/" . $getStats["stats_img"] ?? '' ?>" alt="" class="stats_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center" >
                    </label>
                    <input name="stats_img" class="d-none" id="stats-img-input" type="file" value="<?= $getStats['stats_img'] ?? ''?>">
                    <span class="text-danger"><?= $_SESSION['errors']['stats_error'] ?? '' ?></span>
                    </div>
                </div>
    
                <div class="mt-3 ml-3"><button class="btn btn-primary" type="submit">Stats Update</button></div>
            </form>
        </div>
    </section>
     <!-- Menu update  -->
     <section id="menu" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Menu Update</h4>
            <form action="../controller/MenuUpdateController.php" method="POST" enctype="multipart/form-data">
             
                <div class="row justify-content-around">
                    <div>
                       <input type="hidden" name="id" value="<?= $getMenu['id'] ?>">
                        <label class="d-block mt-3" for="menu_name">Menu Name <span class="text-danger">*</span></label>
                        <input class="form-control" style="width: 330px;"  id="menu_name" type="text" name="menu_name" value="<?= $getMenu['menu_name'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['menu_name_error'] ?? '' ?></span>

                        <label class="d-block mt-3" for="menu_details">Menu Details </label>
                        <input class="form-control" id="menu_details" type="text" name="menu_details" value="<?= $getMenu['menu_details'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['menu_details_error'] ?? '' ?></span>

                        <label class="d-block mt-3" for="menu_price">Menu Price <span class="text-danger">*</span></label>
                        <input class="form-control" id="menu_price" type="text" name="menu_price" value="<?= $getMenu['menu_price'] ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['menu_price_error'] ?? '' ?></span>

                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <label for="menu-img-input" class="d-block text-center">Menu Image <span class="text-danger">*</span></label>
                    <label class="d-block mt-1" for="menu-img-input"><img  src="<?= "../uploads/menu/" . $getMenu["menu_img"] ?? '' ?>" alt="" class="menu_image img-fluid rounded-circle" style="width:150px; height:150px;object-fit:cover;object-position:center" >
                    </label>
                    <input name="menu_img" class="d-none" id="menu-img-input" type="file" accept="image/*" value="<?= $getMenu['menu_img'] ?>">
                    <span class="text-danger"><?= $_SESSION['errors']['menu_error'] ?? '' ?></span>
                    </div>
                </div>
    
                <div class="mt-3 ml-4"><button class="btn btn-primary" type="submit">Menu Update</button></div>
            </form>
        </div>
    </section>
    <!-- Contact Info For Home Page Show -->
    <section id="contact-info" class="d-flex justify-content-center">
        <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Contact Info For Home Page Show</h4>
            <form action="../controller/ContactInfoUpdateController.php" method="POST">
              <input type="hidden" name="id">
    
                <label class="d-block mt-3" for="phone">Phone: </label>
                <input class="form-control" id="phone" type="text" name="phone" >
                <span class="text-danger"><?= $_SESSION['errors']['phone'] ?? '' ?></span>
                <label class="d-block mt-3" for="email">Email: </label>
                <input class="form-control" id="email" type="email" name="email" >
                <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="address">Address: </label>
                <input class="form-control" id="address" type="text" name="address" >
                <span class="text-danger"><?= $_SESSION['errors']['address'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="hours">Hours: </label>
                <input class="form-control" id="hours" type="text" name="hours" >
                <span class="text-danger"><?= $_SESSION['errors']['hours'] ?? '' ?></span>
    
                <div class="mt-3"><button class="btn btn-primary" type="submit">Contact Update</button></div>
            </form>
        </div>
    </section>
    <!-- Book a Table -->
    <section id="book-table" class="d-flex justify-content-center">
     <div class="card shadow p-3 mb-5 bg-white rounded col-lg-6">
        <h4 class="text-center">Book a Table</h4>
            <form action="../controller/ContactInfoUpdateController.php" method="POST">
              <input type="hidden" name="id">
    
                <label class="d-block mt-3" for="fname">Full Name: </label>
                <input class="form-control"  id="fname" type="text" name="fullname" >
                <span class="text-danger"><?= $_SESSION['errors']['fname'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="bemail">Email: </label>
                <input class="form-control" id="bemail" type="email" name="email" >
                <span class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="bphone">Phone: </label>
                <input class="form-control" id="bphone" type="text" name="phone" >
                <span class="text-danger"><?= $_SESSION['errors']['phone'] ?? '' ?></span>
    
    
                <label class="d-block mt-3" for="date">Date: </label>
                <input class="form-control" id="date" type="date" name="date" >
                <span class="text-danger"><?= $_SESSION['errors']['date'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="time">Time: </label>
                <input class="form-control" id="time" type="text" name="time" >
                <span class="text-danger"><?= $_SESSION['errors']['time'] ?? '' ?></span>
    
                <label class="d-block mt-3" for="people">Time: </label>
                <input class="form-control" id="people" type="text" name="people" >
                <span class="text-danger"><?= $_SESSION['errors']['people'] ?? '' ?></span>
    
                <div class="mt-3"><button class="btn btn-primary" type="submit">Book Table Update</button></div>
            </form>
        </div>
     </section>


<?php 
    include_once "../inc/BackendFooter.php";
  ?>
  <script>
  $(document).ready(function(){
    $('#banner-img-input, #about-img-input, #about-thumbnail-input, #stats-img-input').change(function(){
      let file = $(this)[0].files[0];
      let url = URL.createObjectURL(file);
      
      if ($(this).attr('id') === 'banner-img-input') {
        $('.banner_image').attr('src', url);
      } else if ($(this).attr('id') === 'about-img-input') {
        $('.about_image').attr('src', url);
      } else if ($(this).attr('id') === 'about-thumbnail-input') {
        $('.about_thumbnail').attr('src', url);
      } else if ($(this).attr('id') === 'stats-img-input') {
        $('.stats_image').attr('src', url);
      }
    });
  });
</script>
