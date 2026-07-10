<?php
// Initialize session and include database connection
session_start();
require_once 'koneksi.php'; // Pastikan koneksi.php sudah ada dan berfungsi

// Sanitize and validate input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form submission with improved error handling and logging
function processFormSubmission($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Get and sanitize form data
            $title = sanitizeInput($_POST['title'] ?? '');
            $category = sanitizeInput($_POST['category'] ?? '');
            $instagram_url = sanitizeInput($_POST['instagram_url'] ?? '');
            
            // Validate inputs
            $errors = [];
            if (empty($title)) $errors[] = "Title is required";
            if (empty($category)) $errors[] = "Category is required";
            if (empty($instagram_url)) $errors[] = "Instagram URL is required";
            
            if (!empty($errors)) {
                return ["status" => "error", "message" => implode(", ", $errors)];
            }
            
            // Validate Instagram URL format
            if (!preg_match('/instagram\.com\/(?:p|reel)\/[\w-]+/', $instagram_url)) {
                return ["status" => "error", "message" => "Invalid Instagram URL format"];
            }
            
            // Convert to embed URL
            $instagram_embed = str_replace(
                ["/p/", "/reel/"], 
                ["/p/embed/", "/reel/embed/"], 
                $instagram_url
            );
            
            // Prepare and execute the insertion
            $stmt = $conn->prepare("INSERT INTO gallery (title, category, instagram_embed) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            
            $stmt->bind_param("sss", $title, $category, $instagram_embed);
            
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            
            $_SESSION['success_message'] = "Gallery item added successfully!";
            header("Location: admin_gallery.php");
            exit;
            
        } catch (Exception $e) {
            error_log("Gallery submission error: " . $e->getMessage());
            return ["status" => "error", "message" => "An error occurred while saving the gallery item"];
        }
    }
    return null;
}

// Fetch gallery items with error handling
function getGalleryItems($conn) {
    try {
        $query = "SELECT * FROM gallery ORDER BY id DESC";
        $result = $conn->query($query);
        
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        error_log("Error fetching gallery items: " . $e->getMessage());
        return [];
    }
}

// Delete gallery item (only for admin)
function deleteGalleryItem($conn, $id) {
    if (!isset($_SESSION['id_admin'])) {
        return ["status" => "error", "message" => "Unauthorized access"];
    }
    
    try {
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("i", $id);
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        return ["status" => "success", "message" => "Item deleted successfully"];
    } catch (Exception $e) {
        error_log("Delete error: " . $e->getMessage());
        return ["status" => "error", "message" => "Failed to delete item"];
    }
}

// Main execution
// Use the existing connection from koneksi.php
global $conn; // Make sure to use the global connection variable

// Handle delete requests (only for admin)
if (isset($_POST['delete_id']) && isset($_SESSION['id_admin'])) {
    $delete_result = deleteGalleryItem($conn, $_POST['delete_id']);
    $_SESSION['message'] = $delete_result['message'];
    header("Location: admin_gallery.php");
    exit;
}
$submission_result = processFormSubmission($conn);
$galleryItems = getGalleryItems($conn);

// Close database connection
$conn->close();
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
                <a href="index.php" class="nav-item nav-link ">Home</a>
                <a href="about.php" class="nav-item nav-link">Tentang</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="courses.php" class="nav-item nav-link active">Gallery</a>
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
            <a href="gallery.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Masuk Admin<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


      <!-- Header Start -->
      <div class="bg-success" style="background: url('img/gedung\ SMA\ SENOPATI.jpg') no-repeat center center/cover; position: relative;">
        <div style="background-color: rgba(0, 0, 0, 0.7); position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <div class="container py-5" style="position: relative; z-index: 1;">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Gallery</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


<!-- Kegiatan Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">SMA SENOPATI</h6>
            <h1 class="mb-5">KEGIATAN SMA SENOPATI SIDOARJO</h1>
        </div>

        <div class="row g-3">
            <?php if (!empty($galleryItems)): ?>
                <?php foreach ($galleryItems as $item): ?>
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                        <div class="position-relative d-block overflow-hidden">
                            <iframe 
                                src="<?php echo htmlspecialchars($item['instagram_embed']); ?>"
                                class="w-100"
                                height="450" 
                                frameborder="0" 
                                scrolling="no" 
                                allowtransparency="true"
                                allowfullscreen="true"
                                loading="lazy">
                            </iframe>
                            <div class="bg-white text-center position-relative">
                            <div class="position-absolute bottom-0 end-0 p-3" 
                                style="z-index: 1; background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(5px); border-radius: 5px; padding: 10px;">
                                <h5 class="mb-1"><?php echo htmlspecialchars($item['category']); ?></h5>
                                <small class="text-primary"><?php echo htmlspecialchars($item['title']); ?></small>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No gallery items found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Kegiatan End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row">
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
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
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
                        Designed By <a class="border-bottom" href="https://sagita-github-io.vercel.app/">Sagita And Nazwa</a>
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