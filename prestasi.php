<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>SMA SENOPATI</title>
    <link href='img/LOGO_SMA.gif' rel='shortcut icon'>
      <!-- Icon Font Stylesheet -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  
      <!-- Libraries Stylesheet -->
      <link href="lib/animate/animate.min.css" rel="stylesheet">
      <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  
      
      <!-- Customized Bootstrap Stylesheet -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
  
      <!-- Template Stylesheet -->
      <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-grad-school.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/lightbox.css">
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>

   
  <!--header-->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="#" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><em>SMA</em> SENOPATI</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="about.php" class="nav-item nav-link active">Tentang</a>
            <a href="profile.php" class="nav-item nav-link active">Profile</a>
            <a href="courses.php" class="nav-item nav-link active">Gallery</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jurusan</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="mipa.html" class="dropdown-item">Mipa</a>
                    <a href="ips.html" class="dropdown-item">IPS</a>
                    <a href="perhotelan.html" class="dropdown-item">PERHOTELAN</a>
                    
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">akademik</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="prestasi.php" class="dropdown-item">Prestasi</a>
                    
                    <a href="ekstra.php" class="dropdown-item">EkstraKurikuler</a>
                   </div>
            </div>
            
            <a href="contact.html" class="nav-item nav-link">Contact</a>
           
        </div>
        <a href="login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Masuk Admin<i class=""></i></a>
    </div>
</nav>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="caption">
              <h6>Prestasi</h6>
              <h2><em>SMA SENOPATI</em>  </h2>
              <div class="main-button">
                  <div class="scroll-to-section"><a href="#section2">Discover more</a></div>
              </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->


  <!-- prestasi -->
  <?php include 'koneksi.php';
$sql = "SELECT * FROM prestasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Awards</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<section class="features">
    <div class="container">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-4 col-12">
                    <div class="features-post">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa <?= $row['icon'] ?>"></i> <?= $row['category'] ?></h4>
                            </div>
                            <div class="content-hide">
                                <p><?= $row['title'] ?></p>
                                <p><?= $row['description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
</body>
</html>
<!-- prestasi end  -->

<!-- Prestasi 2 -->
<section class="section why-us" data-section="section2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Why Choose SMA SENOPATI SIDOARJO?</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div id="tabs">
                    <ul>
                        <?php include 'koneksi.php';
                        $sql = "SELECT DISTINCT tab_name FROM prestasi2";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) { ?>
                            <li><a href="#<?= strtolower(str_replace(' ', '-', $row['tab_name'])) ?>">
                                <?= htmlspecialchars($row['tab_name']) ?></a>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="tabs-content">
                        <?php
                        $sql = "SELECT * FROM prestasi2";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) { ?>
                            <article id="<?= strtolower(str_replace(' ', '-', $row['tab_name'])) ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <h4><?= htmlspecialchars($row['title']) ?></h4>
                                        <p><?= htmlspecialchars($row['description']) ?></p>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Prestasi 2 End -->





  

  <section class="section contact" data-section="section6">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>kunjungi kami di alamat</h2>
          </div>
        </div>
        <div class="col-md-6">
        
        <!-- Do you need a working HTML contact-form script?
                	
                    Please visit https://templatemo.com/contact page -->
                    
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-md-6">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Your Email" required="">
                  </fieldset>
                </div>
              <div class="col-md-12">
                <fieldset>
                  <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your message..." required=""></textarea>
                </fieldset>
              </div>
              <div class="col-md-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="button">Send Message Now</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div id="map">
            <iframe src="https://maps.google.com/maps?q=SMA+Senopati+Sidoarjo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="422px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> power by <a href="#">sagita </a>and <a href="#">baitul nazwa</a> 
          
           | Design: <a href=" https://sagita-github-io.vercel.app/" rel="sponsored" target="_parent">Universitas Wijaya Kusuma Surabaya</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/isotope.min.js"></script>
    <script src="js/owl-carousel.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/video.js"></script>
    <script src="js/slick-slider.js"></script>
    <script src="js/custom.js"></script>

     <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="lib/wow/wow.min.js"></script>
     <script src="lib/easing/easing.min.js"></script>
     <script src="lib/waypoints/waypoints.min.js"></script>
     <script src="lib/owlcarousel/owl.carousel.min.js"></script>
 
     <!-- Template Javascript -->
     <script src="js/main.js"></script>
     
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>