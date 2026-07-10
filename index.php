<?php 
include 'koneksi.php';

// Ambil data dari tabel info_penting
$infoPentingResult = $conn->query("SELECT * FROM info_penting");

// Ambil data dari tabel carousel
$carouselResult = $conn->query("SELECT * FROM carousel");

// Ambil semua layanan
$servicesResult = $conn->query("SELECT icon, title, description, delay FROM services");

// Mengambil data guru
$guruResult = $conn->query("SELECT * FROM guru");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SMA SENOPATI</title>
    <link href='img/LOGO_SMA.gif' rel='shortcut icon'>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

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
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="img/LOGO_SMA.gif" alt="SMA SENOPATI Logo" width="60" height="60" style="margin-right: 10px;">
            <h2 class="m-0 text-primary">SMA SENOPATI</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">Tentang</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="courses.php" class="nav-item nav-link">Gallery</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jurusan</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="mipa.html" class="dropdown-item">MIPA</a>
                        <a href="ips.html" class="dropdown-item">IPS</a>
                        <a href="perhotelan.html" class="dropdown-item">PERHOTELAN</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Akademik</a>
                    <div class="dropdown-menu fade-down m-0">
                    <a href="prestasi.php" class="dropdown-item">Prestasi</a>
                        <a href="ekstra.php" class="dropdown-item">Ekstra Kurikuler</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Masuk Admin<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Beranda Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <?php while ($row = $carouselResult->fetch_assoc()): ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?php echo $row['image_url']; ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"><?php echo $row['title']; ?></h5>
                                <h1 class="display-3 text-white animated slideInDown">SMA SENOPATI</h1>
                                <p class="fs-5 text-white mb-4 pb-2"><?php echo $row['description']; ?></p>
                                <a href="upload_bukti.php" class="btn btn-light py-md-3 px-md-5 animated slideInRight"><?php echo $row['button_text']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- Beranda End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <?php if ($servicesResult->num_rows > 0): ?>
                    <?php while ($row = $servicesResult->fetch_assoc()): ?>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo htmlspecialchars($row['delay']); ?>s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x <?php echo htmlspecialchars($row['icon']); ?> text-primary mb-4"></i>
                                <h5 class="mb-3"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada layanan yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Sambutan -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/uUt0PWSNqqM" 
                                title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Sambutan Kepala Sekolah</h6>
                    <h1 class="mb-4">Sekolah SMA SENOPATI</h1>
                    <p class="mb-4">Assalamualaikum warahmatullahi wabarakatuh.</p>
                    <p class="mb-4" style="text-align: justify;">
                        Salam sejahtera bagi kita semua.
                        Selamat datang di website resmi SMA Senopati Sidoarjo. Sebagai dari upaya kami untuk beradaptasi                        dengan perkembangan teknologi dan informasi, kehadiran website ini menjadi jembatan penting untuk memperkuat komunikasi antara sekolah, siswa, orang tua, dan masyarakat.
                        Kami berkomitmen untuk memberikan pendidikan yang berkualitas, serta membangun generasi muda yang berkarakter, kreatif, dan berprestasi. Melalui platform ini, kami berharap seluruh informasi mengenai kegiatan, program, serta pencapaian sekolah dapat diakses dengan mudah oleh semua pihak.
                        Terima kasih atas kepercayaan yang diberikan kepada SMA Senopati Sidoarjo sebagai tempat tumbuh kembangnya putra-putri bangsa. Mari kita bersama menjadikan sekolah ini sebagai wadah yang inspiratif dan inovatif bagi masa depan yang lebih gemilang.
                        Wassalamualaikum warahmatullahi wabarakatuh,
                    </p>
                    <p class="mb-4">Kepala Sekolah</p>
                    <p class="mb-4">Yayuk Kumiyati S.Pd</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sambutan End -->

    <!-- INFO PENTING Start -->
    <div class="container-fluid" style="margin: 90px 0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Section -->
                <div class="col-lg-6 wow fadeInUp">
                    <div class="">
                        <h6 class="text-danger text-uppercase pb-2">SMA SENOPATI</h6>
                        <h1 class="display-5">INFO PENTING !!</h1>
                    </div>
                    <p class="text-muted mb-4">Menuju masa depan emas bersama SMA SENOPATI SIDOARJO</p>
                    
                    <?php while ($row = $infoPentingResult->fetch_assoc()): ?>
                        <div class="d-flex mb-4">
                            <div class="icon-box <?php echo $row['warna_icon']; ?> text-white d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                                <i class="<?php echo $row['icon_class']; ?> fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold"><?php echo $row['judul_info']; ?></h5>
                                <p class="text-muted"><?php echo $row['deskripsi']; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Image Section -->
                <div class="col-lg-6 wow fadeInUp">
                    <?php
                    // Reset pointer ke awal hasil query
                    $infoPentingResult->data_seek(0);
                    // Menampilkan gambar dari data yang diambil
                    while ($row = $infoPentingResult->fetch_assoc()): ?>
                        <img class="img-fluid" src="uploads/<?php echo $row['gambar']; ?>" alt="Learning Image">
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- INFO PENTING END -->

    <!-- Guru Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Guru</h6>
                <h1 class="mb-5">SMA SENOPATI</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative">
                <?php while ($row = $guruResult->fetch_assoc()): ?>
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="uploads/<?php echo $row['gambar']; ?>" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="<?php echo $row['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="<?php echo $row['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="<?php echo $row['instagram']; ?>"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                        <h5 class="mb-0"><?php echo $row['nama']; ?></h5>
                            <small><?php echo $row['jabatan']; ?></small>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- tampilan guru -->

    </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .counter {
            transition: all 0.5s ease-in-out;
        }
        .counter.animate {
            transform: scale(1.2);
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
   <style>
    .team-item img {
        width: 200px; /* Set a fixed width */
        height: 280px; /* Set a fixed height */
        object-fit: cover; /* Crop image to fill the size */
    }
</style>

    
    <script>
        $(document).ready(function() {
            $('.counter').each(function() {
                var $this = $(this);
                var target = $this.data('target');
                var count = 0;
                var interval = setInterval(function() {
                    count++;
                    $this.text(count);
                    $this.addClass('animate');
                    setTimeout(function() {
                        $this.removeClass('animate');
                    }, 500);
                    if (count >= target) {
                        clearInterval(interval);
                    }
                }, 10);
            });
        });
    </script>
    <!-- Guru End-->
    
    <!-- Include the Owl Carousel JS and CSS -->
    <link rel="stylesheet" href="path_to_owl_carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="path_to_owl_carousel/owl.theme.default.min.css">
    <script src="path_to_jquery/jquery.min.js"></script>
    <script src="path_to_owl_carousel/owl.carousel.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $(".team-carousel").owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    576:{
                        items:2
                    },
                    768:{
                        items:3
                    },
                    992:{
                        items:4
                    }
                }
            });
        });
    </script>
    

    <!-- Guru End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <a href="https://maps.app.goo.gl/6jrPYf7CrBQjpzu97">
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Senopati No.02, Kepuh, Betro, Kec. Sedati, Kabupaten Sidoarjo, Jawa Timur 61253</p>
                    </a>
                    <a href="https://wa.me/+6285733325325">
                        <p class="mb-0 fa fa-phone-alt me-3">+6285733325325</p>
                    </a>
                    <a href="https://wa.me/+6281222577771">
                        <p class="mb-0 fa fa-phone-alt me-3">+6281222577771</p>
                    </a>
                    <p class="mb-0"><a href="mailto:info@smasenopati.sch.id">info@smasenopati.sch.id</a></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/smasenopati?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/smasenopati.ok?locale=id_ID"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/@smasenopatisedatisidoarjo8344"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/LOGO_SMA.gif" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/PPDB.png" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/aboutSMASENOPATI.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/SMA HALAMAN DEPAN.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/MPLS SMA SENOPATI.jpg" alt="">
                        </div>
                        <div class="col-3">
                            <img class="img-fluid bg-light p-1" src="img/PPDB ORI.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Daftar Form</h4>
                    <p><span class="text-primary">Daftar Sekarang!</span> Hanya dengan Rp 100.000, Anda sudah bisa mendaftarkan diri di sini.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">SMA SENOPATI</a>, All Right Reserved.
                        Designed By <a class="border-bottom" href="https://sagita-github-io.vercel.app/">Sagita</a> and <a class="border-bottom" href="#">baitul nazwa</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>