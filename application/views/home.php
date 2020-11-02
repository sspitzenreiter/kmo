<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kompetisi Matematika Online</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- logo -->
  <link rel="icon" href="<?php echo base_url(); ?>./assets/img/logo.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>./assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>./assets/css/style.css" rel="stylesheet">

</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="<?= site_url('Home');?>" class="logo mr-auto" style="margin-right:5px!important;"><img src="<?php echo base_url(); ?>./assets/img/logo.png" alt="" class="img-fluid"></a>
      <h1 class="logo mr-auto" ><a href="<?= site_url('Home');?>">KMO</a></h1>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?= site_url('Home');?>">Home</a></li>
          <li><a href="#timeline">Timeline</a></li>
          <li><a href="#pendaftaran">Alur Pendaftaran</a></li>
          <li><a href="#pembayaran">Alur Pembayaran</a></li>
          <li><a href="#contact">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="<?= site_url('auth');?>" class="get-started-btn scrollto">Daftar</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Kompetisi Matematika Online</h1>
          <h2>Kompetisi Matematika Online (KMO) merupakan kompetisi dibidang matematika yang diselenggarakan oleh Himpunan Mahasiswa Pendidikan Matematika (HIMAPTIKA) IKIP Siliwangi. Kegiatan ini diperuntukkan bagi siswa/i SMP/MTs/sederajat dan siswa-siswi SMA/MA/sederajat.</h2>
          <div class="d-lg-flex">
            <a href="<?= site_url('auth');?>" class="btn-get-started scrollto">Daftar</a>
            <a href="#" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Watch Video <i class="icofont-play-alt-2"></i></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="<?php echo base_url(); ?>./assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Timeline Section ======= -->
    <section id="timeline" class="team section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Timeline Acara</h2>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/pendaftaran.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Pendaftaran</h4>
                <p>20 September s.d. 20 Oktober 2020 (Via Website)</p>
              </div>
            </div>
          </div>
          <div class="col-lg-12  mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/penyisihan.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Penyisihan</h4>
                <p>24 s.d. 25 Oktober 2020 (Via Website)</p>
              </div>
            </div>
          </div>
          <div class="col-lg-12 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/final.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Final</h4>
                <p>1 November 2020 (Gedung C6 IKIP Siliwangi)</p>
              </div>
            </div>
          </div>
          <div class="col-lg-12  mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/pengumuman.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Pengumuman</h4>
                <p>1 November 2020 (Kampus IKIP Siliwangi dan Media Sosial
                </p>
              </div>
            </div>
          </div>
         </div>
      </div>
    </section><!-- End Timeline Section -->
     <!-- ======= Alur Pendaftaran Section ======= -->
     <section id="pendaftaran" class="pendaftaran">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Alur Pendaftaran</h2>
          </div>
  
          <div class="row content">
            <div class="col-lg-12">
              <ol type='I' data-aos="zoom-in" data-aos-delay="100">
                <li>Buat akun di website KMO (xxxxx).</li>
                <li>Login ke website dan buat akun peserta KMO dengan e-mail serta nomor handphone yang aktif. </li>
                <li>Mengisi formulis pendaftaran online sesuai tata cara yang tertera pada website.</li>
                <li>Melunasi biaya pendaftaran sebesar Rp.100.00,00 per tim. </li>
                <li>Upload pas foto terbaru</li>
              </ol>
            </div>
          </div>
        </div>
    </section> <!-- End  Alur Pendaftaran Section -->
    <!-- ======= Alur Pembayaran Section ======= -->
    <section id="pembayaran" class="pembayaran">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Alur Pembayaran</h2>
          </div>
  
          <div class="row content">
            <div class="col-lg-12">
              <ol  type='I'  data-aos="zoom-in" data-aos-delay="100">
                <li>Biaya pendaftaran dapat ditransfer melalui Bank BRI dengan no rek. 013701135602508 a.n. Citra Aditia  Rahayu</li>
                <li>Setelah melakukan pembayaran, lakukan konfirmasi di menu pembayaran</li>
                <li>Tunggu verifikasi dari panitia selambat-lambatnya    1 x 24 jam</li>
              </ol>
            </div>   

          </div>
          
        </div>
    </section> <!-- End  Alur Pembayaran Section -->
    <!-- ======= Materi Section ======= -->
    <section id="materi" class="materi section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Materi Lomba</h2>
          <p>Materi yang akan dilombakan terbagi kedalam dua tingkat yaitu tingkat SMP dan tingkat SMA</p>
        </div>
        <div class="row">
          <div class="col-lg-4 first">
            <div class="materi-content d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100" >
              <div class="materi-info">
                <h4>Sekolah Menegah Pertama</h4>
                <span></span>
                <p><i class="ri-check-double-line"></i>  Statistika</p>
                <p><i class="ri-check-double-line"></i>  Teori Bilangan</p>
                <p><i class="ri-check-double-line"></i>  Geometri</p>
                <p><i class="ri-check-double-line"></i>  Peluang</p>
                <p class="mb-4"><i class="ri-check-double-line"></i>  Aljabar</p>         
              </div>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="materi-content d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
              <div class="materi-info">
                <h4>Sekolah Menegah Atas</h4>
                <span></span>
                <p><i class="ri-check-double-line"></i>  Kombinatorik</p>
                <p><i class="ri-check-double-line"></i>  Aljabar</p>
                <p><i class="ri-check-double-line"></i>  Teori Bilangan</p>
                <p><i class="ri-check-double-line"></i>  Geometri</p>
                <p><i class="ri-check-double-line"></i>  Kalkulus</p>
                <p><i class="ri-check-double-line"></i>  Logika Matematika</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End materi Section -->
    <!-- ======= Persyaratan Section ======= -->
    <section id="persyaratan" class="persyaratan">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Persyaratan Peserta</h2>
          </div>
  
          <div class="row content">
            <div class="col-lg-12">
              <ol data-aos="zoom-in" data-aos-delay="100">
                <li>Peserta merupakan siswa/i SMP/MTs/sederajat untuk kategori CCM SMP dan siswa/i SMA/MA/sederajat untuk kategori CCM SMA.</li>
                <li>Peserta adalah tim yang terdiri dari 3 orang danberasal  dari sekolah yang sama</li>
                <li>Anggota tim diperbolehkan dari tingkat kelas yang berbeda. </li>
                <li>Setiap sekolah diperbolehkan mengirim lebih dari 1 tim.</li>
                <li>Apabila pada saat perlombaan berlangsung peserta tidak dapat hadir, maka tidak dapat digantikan oleh orang lain</li>
              </ol>
            </div>
          </div>
        </div>
    </section> <!-- End Persyaratan Section -->
    <div class="biaya-section" data-aos="fade-up">   
        <h2 class="col-lg-12 d-flex justify-content-center">Biaya Pendaftaran</h2>
        <div class="col-lg-12 d-flex justify-content-center">
        <div class="biaya" data-aos="zoom-in" data-aos-delay="100">
            <h4><sup>Rp</sup>100.000,00<sub>/ tim</sub></h4>
        </div>
        </div>
        </div>
   
    <!-- ======= Hadiah Section ======= -->
    <section id="hadiah" class="pricing">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Hadiah</h2>
        </div>
        <div class="row">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/final.png" class="img-fluid" alt=""></div>
            <h3>Juara 1</h3>
            <div class="box">
              <ul>
                <li>E-Sertifikat</li>
                <li>Piala</li>
                <li>Uang Pembinaan</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/final.png" class="img-fluid" alt=""></div>
            <h3>Juara 2</h3>
            <div class="box">
              <ul>
                <li>E-Sertifikat</li>
                <li>Piala</li>
                <li>Uang Pembinaan</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="pic"><img src="<?php echo base_url(); ?>./assets/img/icon/final.png" class="img-fluid" alt=""></div>
            <h3>Juara 3</h3>
            <div class="box">
              <ul>
                <li>E-Sertifikat</li>
                <li>Piala</li>
                <li>Uang Pembinaan</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Pricing Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Contact</h2>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="info">
              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Alfi Fani S</h4>
                <p>0895344934254 </p>
              </div>
              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Citra Aditia R</h4>
                <p>0881023092830 </p>
              </div>
              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Fikri Fauzi</h4>
                <p>083845875860  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-contact">
            <h3>HIMAPTIKA</h3>
            <p>
              Himpunan Mahasiswa Pendidikan Matematika IKIP Siliwangi<br>
              Jl. Terusan Jend. Sudirman, Baros <br> Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40521<br><br>
              <strong>Phone :</strong> +1 5589 55488 55<br>
              <strong>Email :</strong> himaptika.siliwangi17@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-6 col-md-6 footer-links">
            <h4>Our Social Media</h4>
            <ul>
              <li><a href="" class="facebook"></a><i class="bx bxl-instagram "></i>@himaptikasiliwangi_</li>
              <li><i class='bx bxl-youtube '></i>HIMAPTIKA IKIP Siliwangi</li>
              <li><i class='bx bx-envelope '></i>himaptika.siliwangi17@gmail.com</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>HIMAPTIKA</span></strong>. All Rights Reserved
      </div>
  </div>
</div>
   
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="<?php echo base_url(); ?>./assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>./assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>./assets/js/main.js"></script>

</body>

</html>