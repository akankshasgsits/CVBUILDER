<?php
require_once("config.php");
include('query.php');
if (isset($_GET['logout'])) {
  setcookie('user', '', time() - 5, '/');
  header('Location:index.php');
}
if (isset($_POST['login'])) {
    $info = array(
      'email' => $_POST['email'],
      'password' => $_POST['password']
    );
    $data = login($info, $con);
    if ($data) {
      setcookie('user', $data['id'], time() + 86400 * 60, '/');
      header("location:index.php");
    } else {
      echo "<script> alert('Invalid Credentials'); </script>";
    }
  }
if(isset($_GET['id'])){
	$a=$_GET['id'];

if (isset($_POST['reset'])){
	$password=$_POST['newpass'];
	$password1=$_POST['repass'];
if ($password==$password1){
	$query="UPDATE `login` SET `password`='$password' WHERE id='$a' "; 
    $response=mysqli_query($con,$query) or die ("error in updating the query");
    echo "<script> alert('Password Updated Successfully'); </script>";

}
else{
    echo "<script> alert('Password doesn't match'); </script>";
	
}
}  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online CV Builder</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Anyar - v4.6.0
  * Template URL: https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container">
      <nav id="navbar" class="navbar">
        <ul>
          <h1 class="logo"><a style="font-size: 3rem !important;" href="index.php">CV Builder</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href=index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          <li><a class="nav-link scrollto active" href="#hero" style="color:black;">Home</a></li>
          <li><a class="nav-link scrollto" href="#about" style="color: black;">About</a></li>
          <li><a class="nav-link scrollto" href="#services" style="color: black;">Services</a></li>
          <?php if (!isset($_COOKIE['user'])) { ?>
            <li><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">Login</button>
              &nbsp; &nbsp;
              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#reset">Reset</button>
            </li>
          <?php } else { ?>
            <li><a href="admin/index.php" class="btn btn-primary">Profile</a></li>
            <li><a href="admin/index.php?logout=true" class="btn btn-danger">Logout</a></li>
          <?php } ?>

          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Login your account</h4>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="email" class="col-form-label">E-mail</label>
                      <input type="text" class="form-control" placeholder=" " name="email" required="">
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-form-label">Password</label>
                      <input type="password" class="form-control" placeholder=" " name="password" required="">
                    </div>
                    <div class="right-w3l">
                      <input type="submit" class="form-control" value="Login" name="login">
                    </div>
                    <div class="col forgot-w3l text-right">
                      <p class="text-dark font-weight-bold" data-toggle="modal" data-target="#forgot" style="color: black;">Forgot Password?</a>
                    </div>
                    <p class="text-center dont-do" data-toggle="modal" data-target="#myModalsignup">Don't have an account?</p>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- login  -->
          <div class="modal fade" id="myModalsignup" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Create your account</h4>
                </div>
                <div class="modal-body">
                  <form action="#" method="post">
                    <div class="form-group">
                      <label for="name" class="col-form-label">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" required="">
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-form-label">E-mail</label>
                      <input type="text" class="form-control" placeholder="Email Address" name="email" required="">
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-form-label">Phone</label>
                      <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required="">
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-form-label">Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password" required="">
                    </div>
                    <div class="right-w3l">
                      <input type="submit" class="form-control" value="Register your account " name="signup">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
    <!-- //login -->
    <!-- forget password -->
    <div class="modal fade" id="forgot" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Forgot your Password?</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
              <div class="form-group">
                <label for="email" class="col-form-label">Enter your E-mail</label>
                <input type="text" class="form-control" placeholder="Email Address" name="email" required="">
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">Enter your Mobile number</label>
                <input type="tel" class="form-control" placeholder="Phone Number" name="phone" required="">
              </div>
              <div class="form-group">
                <div class="float-right">
                  <button class="btn btn-primary mr-3" data-toggle="modal" data-target="#reset">Reset Password</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!--End forgot -->
          <!--reset -->
    <div class="modal fade" id="reset" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reset your Password</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
              <div class="form-group">
                <label for="email" class="col-form-label">New Password</label>
                <input type="password" class="form-control" placeholder="New Password" name="newpass" required="">
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">Re-enter password</label>
                <input type="password" class="form-control" placeholder="Re-enter password" name="repass" required="">
              </div>
              <div class="form-group">
                <div class="float-right">
                  <button class="btn btn-success mr-3" name="reset">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> 
    <!--End reset -->

    <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Online CV Builder</span></h2>
          <p class="animate__animated animate__fadeInUp">A Tool that helps you making your CV with professional templates in easy steps. Build your brand-new reume in as little as 5 minutes.
          </p>
          <p class="text-primary bold m-16 h2-subtitle hide-mobile">Online CV builder, easy to use</p>
          <li><i style="color: white;"></i> Wide variety of CV templates</li>
          <li><i style="color: white;"></i> Unique, impressive CV in minutes</li>
          <li><i style="color: white;"></i> A downloadable CV available in PDF format</li>
          <li><i style="color: white;"></i> Add your Information</li>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"></h2>
          <p class="animate__animated animate__fadeInUp"></p>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Icon Boxes Section ======= -->
    <section id="icon-boxes" class="icon-boxes">
      <div class="container">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-calendar"></i></div>
              <h4 class="title"><a href="">Choose an exclusive template</a></h4>
              <p class="description">Altresume offers a wide selection of CV templates that you can easily customise.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Build your professional CV</a></h4>
              <p class="description">Create your CV in just a few minutes with our online creation platform.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Add your content</a></h4>
              <p class="description">Add your content or fields , according to your requirements</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4 class="title"><a href="">Download the perfect CV</a></h4>
              <p class="description">Download your CV in PDF format, in one click, and finally complete all of your projects</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Icon Boxes Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
          <h4>The faster way to create professional-looking resumes</h4>
          <p>Trusted by thousands of job seekers around the world.</p>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <ul>
              <li><i class="ri-check-double-line"></i> Choose from different professionally designed templates</li>
              <li><i class="ri-check-double-line"></i> Download your design on demand with one click</li>
              <li><i class="ri-check-double-line"></i> Access your resume design on any device</li>
              <li><i class="ri-check-double-line"></i> Customize your resume with your requirements</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Enjoy customised support to create your professional CV.
              For each section (education and training, skills, professional experiences, etc.), an interactive guide helps you to enhance your career path.
              Thanks to our online platform, you can also benefit from personalised, tailor-made advice in order to make it more simple to write your CV.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Create your resume by picking relevant responsibilities from the examples below and then add your accomplishments. This way, you can position yourself in the best way to get hired.</p>
        </div>

        <div class="row">
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <i class="bi bi-card-checklist"></i>
              <h4><a href="#">Choose Template </a></h4>
              <p>Select our template from a range of field-tested styles and resume formats</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <i class="bi bi-file-earmark-plus"></i>
              <h4><a href="#">Add your Info</a></h4>
              <p>Use pre-written phrases and interactive layouts to create your resume</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <i class="bi bi-pencil-square"></i>
              <h4><a href="#">Create your resume</a></h4>
              <p>Designing a professional resume cannot get easier, with ready made, field-tested templates</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <i class="bi bi-arrow-down-circle-fill"></i>
              <h4><a href="#">Export to PDF</a></h4>
              <p>Download your resume or share in PDF format directly with your future employer</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row mt-1 d-flex justify-content-end" data-aos="fade-right" data-aos-delay="100">

          <div class="col-lg-5">
            <div class="info">
              <div class="address">
                <i class="bi bi-arrow-right"></i>
                <h4>Name:</h4>
                <p>Akansha Shukla</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+91 9876543201</p>
              </div>

            </div>

          </div>

          <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->




  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>