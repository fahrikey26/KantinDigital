<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Kantin Digital</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="/assets/img/tamsis.png" rel="icon">
    <link href="/assets/img/tamsis.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> <!-- Vendor CSS Files -->
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet"> <!--=======================================================* Template
    Name: Vesperr * Updated: Sep 18 2023 with Bootstrap v5.3.2 * Template URL:
    https://bootstrapmade.com/vesperr-free-bootstrap-template/ * Author: BootstrapMade.com * License:
    https://bootstrapmade.com/license/========================================================-->
</head>

<body>
    <!--=======Header=======-->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center
    justify-content-between">
            <div class="logo">
                <h1><a href="/" class="primary"><img src="assets/img/tamsis.png" alt=""
                            class="img-fluid me-3">Kantin Digital</a> </h1>
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="/">Home</a></li>
                    <li><a class="nav-link scrollto active" href="#produk">Produk</a></li>
                    @if (!Auth::check())
                        <li><a class="getstarted scrollto" href="/login">Login</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <b class="text-primary">{{ Auth::user()->email }}</b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="p-2 text-bold">Status : <b>{{ Auth::user()->role }}</b></li>
                                <li class="p-2 text-bold"><a href="/dashboard"><button
                                            class="btn btn-success">Dashboard</button></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="p-2">
                                    <a href="{{ route('actionlogout') }}">
                                        <button class="btn btn-outline-success" type="submit">Log Out</button>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Jajan Secara Digital</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Ayo..Jajan di Kantin Digital SMK Tamansiswa 2</h2>
                    <div data-aos="fade-up" data-aos-delay="800">
                        <a href="/login" class="btn-get-started scrollto">Ayo Gabung</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                    <img src="assets/img/kantin.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="produk" class="portfolio">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Menu Jajanan</h2>
                    <p>Cari Jajanan Sesuai Seleramu</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            @foreach ($menu as $p)
                                <li data-filter=".{{ $p->id_kantin }}">{{ $p->id_kantin }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    @foreach ($menu as $p)
                        <div class="col-lg-4 col-md-6 portfolio-item {{ $p->id_kantin }}">
                            <div class="portfolio-wrap">
                                <img src="assets/img/{{ $p->foto }}" class="img-fluid" alt=""
                                    width="400px" height="600px">
                                <div class="portfolio-info">
                                    <h4>{{ $p->nama_menu }}</h4>
                                    <p>{{ $p->point }}</p>
                                    <div class="portfolio-links">
                                        <a href="assets/img/{{ $p->foto }}" data-gallery="portfolioGallery"
                                            class="portfolio-lightbox"
                                            title="{{ $p->nama_menu . ' ' . $p->point }}"><i
                                                class="bx bx-plus"></i>SHOW</a>
                                        |
                                        @if (Auth::check())
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#ModalTambahpembelian{{ $p->id_menu }}"
                                                title="Pesan"><i class="bx bx-link"></i>BELI</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ini tampil form tambah pembelian -->
                        <div class=" modal fade" id="ModalTambahpembelian{{ $p->id_menu }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah pembelian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body clearfix">
                                        <div class="card" style="width: 18rem;">
                                            <img src="assets/img/{{ $p->foto }}" class="card-img-top"
                                                alt="{{ $p->nama_menu }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Deskripsi :</h5>
                                                <p class="card-text">Kantin : {{ $p->id_kantin }}</p>
                                                <p class="card-text">Menu : {{ $p->nama_menu }}</p>
                                                <p class="card-text">Harga Poin : {{ $p->point }}</p>
                                            </div>
                                        </div>
                                        <form action="/transaksi/storeinput" method="post" class="form-floating">
                                            @csrf
                                            <input type="hidden" name="idmenu" value="{{ $p->id_menu }}">
                                            <input type="hidden" name="poin" value="{{ $p->point }}">
                                            <div class="form-floating p-1">
                                                <input type="text" name="banyak" required="required"
                                                    class="form-control">
                                                <label for="floatingInputValue">Banyak</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Beli</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Portfolio Section -->



    </main><!-- End #main -->



    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 text-lg-left text-center">
                    <div class="copyright">
                        &copy; Copyright <strong>Zulfahrizal</strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="https://rpl-tamsis2jakarta.webnode.page/">RPL Tamsis 2</a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
