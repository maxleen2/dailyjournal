<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Daily Journal</title>
  <link rel="icon" href="img/logo.png">
  <!-- Bootstrap CSS -->
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
  
  <!-- Custom CSS -->
  <style>
    /* Card Style */
    .card {
      transition: all 0.3s ease-in-out;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    .card img {
      height: 200px;
      object-fit: cover;
    }

    /* Navbar */
    .navbar-brand {
      font-weight: bold;
    }

    /* Carousel */
    .carousel img {
      height: 300px;
      object-fit: cover;
    }

    /* Dark Mode */
    .btn-dark {
      background-color: #121212 !important;
      color: #121212 !important;
    }
    .dark-mode .navbar {
      background-color: #1f1f1f;
    }
    .dark-mode .card {
      background-color: #1e1e1e;
      color: #ffffff;
    }

    .dark-mode .card-footer {
      background-color: #2c2c2c;
    }

    .dark-mode footer {
      background-color: #1f1f1f;
    }

    .dark-mode-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }
  </style>
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">My Daily Journal</a>
    <button 
      class="navbar-toggler" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#navbarNav" 
      aria-controls="navbarNav" 
      aria-expanded="false" 
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
        <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="#about me">About Me</a></li>
        <li class="nav-item"><a class="nav-link" href="Login.php">Login</a></li>
        </ul>
            <div class="d-flex">
              <button class="btn btn-dark me-2">🌙</button>
              <button class="btn btn-danger">☀</button>
    </div>
  </div>
</nav>
<!-- Navbar End -->

<!-- Home Section -->
<section id="home" class="p-5 text-center bg-light">
  <div class="container">
    <h1 class="display-4 fw-bold">Welcome to My Daily Journal</h1>
    <p class="lead">Create and save memories every day</p>
  </div>
</section>

<!-- Article Section -->
<section id="article" class="p-5">
  <div class="container">
    <h1 class="text-center fw-bold mb-5">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $sql = "SELECT * FROM Article ORDER BY Tanggal DESC";
      $hasil = $conn->query($sql);
      while ($row = $hasil->fetch_assoc()) {
      ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="img/<?= $row['Gambar'] ?>" class="card-img-top" alt="<?= $row['Judul'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $row['Judul'] ?></h5>
              <p class="card-text">
                <?= substr($row['Isi'], 0, 100) ?>... <!-- Membatasi teks -->
              </p>
            </div>
            <div class="card-footer">
              <small class="text-muted"><?= date('Y-m-d H:i:s', strtotime($row['Tanggal'])) ?></small>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="p-5 bg-light">
  <div class="container">
    <h1 class="text-center fw-bold mb-5">Gallery</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/the monsters (4).jpg" class="d-block w-300" alt="The Monsters 4"/>
        </div>
        <div class="carousel-item">
          <img src="img/the monsters (5).jpg" class="d-block w-300" alt="The Monsters 5"/>
        </div>
        <div class="carousel-item">
          <img src="img/the monsters (6).jpg" class="d-block w-300" alt="The Monsters 6"/>
        </div>
      </div>
      <button 
        class="carousel-control-prev" 
        type="button" 
        data-bs-target="#carouselExample" 
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button 
        class="carousel-control-next" 
        type="button" 
        data-bs-target="#carouselExample" 
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<!-- Schedule Section -->
<section id="schedule" class="py-5">
  <div class="container">
     <h1 class="text-center p-5">Schedule</h1>
     <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col">
       <div class="card">
        <h4 class="text-center bg-light p-2">SENIN</h4>
        <div class="card-body text-center">
         <h5 class="card-title"><b>09.00-10.30</b></h5>
         <p class="card-text">Basis Data<br>Ruang H.3.4</p>
         <h5 class="card-title"><b>13.00-15.00</b></h5>
         <p class="card-text">Dasar Pemrograman<br>Ruang H.3.1</p>
          </div>
           </div>
            </div>
              <div class="col">
                <div class="card">
                  <h4 class="text-center bg-light p-2">SELASA</h4>
                    <div class="card-body text-center">
                      <h5 class="card-title"><b>08.00-09.30</b></h5>
                      <p class="card-text">Pemrograman Berbasis Web<br>Ruang D.2.J</p>
                      <h5 class="card-title"><b>14.00-16.00</b></h5>
                      <p class="card-text">Basis Data<br>Ruang D.3.M</p>
                    </div>
                 </div>
              </div>
                <div class="col">
                 <div class="card">
                    <h4 class="text-center bg-light p-2">RABU</h4>
                    <div class="card-body text-center">
                      <h5 class="card-title"><b>10.00-12.00</b></h5>
                      <p class="card-text">Pemrograman Berbasis Object<br>Ruang D.2.A</p>
                      <h5 class="card-title"><b>13.30-15.00</b></h5>
                      <p class="card-text">Pemrograman Sisi Server<br>Ruang D.2.A</p>
                    </div>
                  </div>
                </div>
                  <div class="col">
                    <div class="card">
                      <h4 class="text-center bg-light p-2">KAMIS</h4>
                      <div class="card-body text-center">
                        <h5 class="card-title"><b>08.00-10.00</b></h5>
                        <p class="card-text">Pengantar Teknologi Informatika<br>Ruang D.3.N</p>
                        <h5 class="card-title"><b>11.00-13.00</b></h5>
                        <p class="card-text">Rapat Koordinasi DOSCOM<br>Ruang G.1</p>
                      </div>
                  </div>
                </div>
                  <div class="col">
                    <div class="card">
                      <h4 class="text-center bg-light p-2">JUMAT</h4>
                      <div class="card-body text-center">
                        <h5 class="card-title"><b>09.00-11.00</b></h5>
                        <p class="card-text">Data Mining<br>Ruang G.2.3</p>
                        <h5 class="card-title"><b>13.00-15.00</b></h5>
                        <p class="card-text">Information Retrieval<br>Ruang G.2.4</p>
                      </div>
                    </div>
                  </div>
                <div class="col">
                  <div class="card">
                     <h4 class="text-center bg-light p-2">SABTU</h4>
                     <div class="card-body text-center">
                      <h5 class="card-title"><b>08.00-10.00</b></h5>
                      <p class="card-text">Bimbingan Karier<br>Online</p>
                      <h5 class="card-title"><b>10.30-12.00</b></h5>
                      <p class="card-text">Bimbingan Skripsi<br>Online</p>
                     </div>
                  </div>
                </div>
             <div class="col">
             <div class="card">
            <h4 class="text-center bg-light p-2">MINGGU</h4>
          <div class="card-body text-center">
         <p class="card-text">Tidak Ada Jadwal</p>
        </div>
      </div>
     </div>
    </div>
  </div>
 </section>

 <!-- About Me section -->
 <section id="about me">
    <div class="container p-5">
      <h1 class="text-center p-5">ABOUT ME </h1>
        <div class="d-flex justify-content-center">
          <img src="img/the monsters (13).jpg" alt="The Monsters (13).jpg" class="img-fluid" width="300">
          <div class="text-center bg-success-subtle">
            <h1 class="fw-bold"><b>Maxentia Kathleen</b></h1>
            <p> Mahasiswa Teknik Informatika</p>
            <p><b> NIM : </b> A11.2023.15443</p>
            <p><b> Program Studi : </b> Teknik Informatika</p>
            <p><b> Email : </b> maxentiakath@gmail.com</p>
            <p><b> Telephon : </b> +62 81225362589</p>
            <p><b> Alamat : </b> Jl. Borodudur ll No 2A</p>
        </div>
    </div>
  </section> 

<!-- Footer -->
<footer class="p-4 bg-light text-center">
  <p>Copyright MaxentiaKathleen© 2024 | My Daily Journal</p>
</footer>

<!-- Bootstrap JS and other scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
           integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
           crossorigin="anonymous">
    </script>

    <script>
    // Ambil elemen tombol toggle
    const toggle = document.getElementById("darkModeToggle");

    // Cek status tema dari localStorage
    const currentTheme = localStorage.getItem("theme");
    if (currentTheme === "dark") {
        document.body.classList.add("dark-mode");
        toggle.textContent = "☀"; // Ikon matahari untuk mode terang
    } else {
        toggle.textContent = "🌙"; // Ikon bulan untuk mode gelap
    }

    // Tambahkan event listener untuk mengubah tema
    toggle.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        if (document.body.classList.contains("dark-mode")) {
            toggle.textContent = "☀"; // Ganti ikon ke matahari
            localStorage.setItem("theme", "dark"); // Simpan status tema
        } else {
            toggle.textContent = "🌙"; // Ganti ikon ke bulan
            localStorage.setItem("theme", "light"); // Simpan status tema
        }
    });
  </script>
</body>
</html>

  <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="btn btn-dark position-fixed bottom-0 end-0 m-3">🌙</button>

  <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
  </html>

  <!-- JavaScript -->
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
  <script>
    const toggle = document.getElementById("darkModeToggle");
    toggle.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });
  </script>

</body>
</html>