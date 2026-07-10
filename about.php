<?php include "koneksi.php" ; 

// Ambil semua layanan
$sql = "SELECT icon, title, description, delay FROM services"; // Pastikan kolom sesuai tabel
$result = $conn->query($sql);

// Cek apakah query berhasil
if (!$result) {
    die("Error pada query: " . $conn->error);
}


// Ambil semua layanan
$servicesResult = $conn->query("SELECT icon, title, description, delay FROM services");

// Query untuk mengambil data
$sql = "SELECT * FROM data_siswa";
$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$about = $conn->query("SELECT * FROM about_us LIMIT 1")->fetch_assoc();

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
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link active">Tentang</a>
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


    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header" style="background-image: url('img/guruguru.jpg'); background-size: cover; background-position: center; position: relative;">
        <!-- Overlay -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
        
        <div class="container py-5" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">tentang</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">tentang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header End -->


  <!-- Service Start -->
  

<!-- Service Start -->
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
<!-- Service End -->

<?php
// Tutup koneksi
$conn->close();
?>

    <!-- Service End -->
    
   <!-- data siswa  -->


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    <!-- Data siswa Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 wow fadeInUp mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/diagramsiswa.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInDown">
                    <div class="position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Data Siswa</h6>
                        <h1 class="display-4">SMA SENOPATI</h1>
                    </div>
                    <div class="row pt-3 mx-0">
                        <?php foreach ($data as $item): ?>
                        <div class="col-3 px-0">
                            <div class="bg-<?php echo $item['kelas'] == 'ALL' ? 'success' : ($item['kelas'] == 'X' ? 'primary' : ($item['kelas'] == 'XI' ? 'secondary' : 'warning')); ?> text-center p-4">
                                <h1 class="text-white counter" data-target="<?php echo $item['jumlah']; ?>">0</h1>
                                <h6 class="text-uppercase text-white"><?php echo $item['kelas']; ?><span class="d-block"><?php echo ($item['kelas'] == 'ALL') ? 'Keseluruhan' : $item['kelas']; ?></span></h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.counter').each(function() {
                var $this = $(this);
                var target = parseInt($this.data('target'), 10);
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


<!-- data siswa End -->


   <!-- konten2abaout -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img class="img-fluid rounded shadow" src="<?= $about['image_path'] ?>" alt="" style="object-fit: cover; height: 100%; width: 100%;">
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="section-title bg-white text-start text-primary pe-3"><?= $about['title'] ?></h6>
                <p class="mb-4"><?= $about['description'] ?></p>
                <p class="mb-4"><?= $about['promo'] ?></p>
                <div class="row">
                    <?php foreach (explode("\n", $about['features']) as $feature): ?>
                        <div class="col-sm-6 mb-2">
                            <p><i class="fa fa-arrow-right text-primary me-2"></i><?= $feature ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="btn btn-primary mt-3" href="<?= $about['button_link'] ?>"><?= $about['button_text'] ?></a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
    
    
 
<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($result);
?>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <h6 class="section-title bg-white text-start text-primary pe-3">Tentang</h6>
                <h1 class="mb-4"><?php echo $data['judul']; ?></h1>
                <p class="mb-4"><?php echo $data['deskripsi']; ?></p>
            </div>
            <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <video class="position-absolute w-100 h-100" src="uploads/<?php echo $data['video']; ?>" style="object-fit: contain;" controls></video>
                </div>
            </div>
        </div>
    </div>
</div>

        
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
                    <a href="https://maps.app.goo.gl/6jrPYf7CrBQjpzu97">  <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Senopati No.02, Kepuh, Betro, Kec. Sedati, Kabupaten Sidoarjo, Jawa Timur 61253</p> </a> 
                    <a href="https://wa.me/+6285733325325"><p class="mb-0 fa fa-phone-alt me-3">+6285733325325</p></a>
                    <a href="https://wa.me/+6281222577771"><p class="mb-0 fa fa-phone-alt me-3">+6281222577771</p></a>
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

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://sagita-github-io.vercel.app/">Sagita And baitul nazwa</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
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