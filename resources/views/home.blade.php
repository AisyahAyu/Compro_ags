@extends('layouts.Member.master')

@section('content')
    <!-- Menampilkan pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Ada Kesalahan:</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Berhasil!</h4>
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="header-carousel owl-carousel mb-5">
        @if ($sliders->isEmpty())
            <!-- Default Slider if no data -->
            <div class="header-carousel-item">
                <img src="{{ asset('assets/img/MAS00029.jpg') }}" class="img-fluid w-100" alt="Default Image">
                <div class="carousel-caption">
                    <div class="carousel-caption-content p-3">
                        <h5 class="text-white text-uppercase fw-bold mb-2" style="letter-spacing: 2px;">
                            {{ __('messages.company_name') }}
                        </h5>
                        <h1 class="display-4 text-capitalize text-white mb-3">
                            {{ __('messages.tagline') }}
                        </h1>
                        <p class="mb-4 fs-6">{{ __('messages.description') }}</p>
                        <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{ route('about') }}">
                            {{ __('messages.about_us') }}
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Loop through sliders if data exists -->
            @foreach ($sliders as $slider)
                <div class="header-carousel-item">
                    <img src="{{ asset($slider->image_url) }}" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <h5 class="text-white text-uppercase fw-bold mb-2" style="letter-spacing: 2px;">
                                {{ $slider->subtitle }}
                            </h5>
                            <h1 class="display-4 text-capitalize text-white mb-3">
                                {{ $slider->title }}
                            </h1>
                            <p class="mb-4 fs-6">{{ $slider->description }}</p>
                            <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{ $slider->button_url }}">
                                {{ $slider->button_text }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- About Carousel Start -->
    <div id="aboutCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach ($sliders as $index => $slider)
                <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="{{ $index }}" 
                        class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <!-- Carousel Items -->
        <style>
        .carousel-item {
            background-size: cover !important;
            background-position: center right 20% !important;
            min-height: 100vh !important; /* Pastikan gambar full ke atas pada semua perangkat */
            width: 100vw !important;
            min-width: 100vw;
        }
        #carouselExample {
            min-height: 100vh;
        }
        
        .carousel-caption {
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            padding-left: 5% !important;
            padding-bottom: 0 !important;
            transform: translateY(10%); /* Turunkan teks sedikit agar lebih pas di tengah */
        }
        .navbar {
            margin-bottom: 0 !important;
        }
        
        .carousel-caption h4 {
            font-size: 30px !important;
        }
        
        .carousel-caption p {
            font-size: 18px !important;
        }
        
        .carousel-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh; /* Pastikan layer hitam menutupi seluruh tinggi layar */
            background: rgba(0, 0, 0, 0.5); /* Layer hitam transparan */
            z-index: 1;
        }
        
        .carousel-caption {
            position: relative;
            z-index: 2; /* Agar teks tetap di atas layer hitam */
        }
</style>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $index => $slider)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ asset($slider->image_url) }}'); background-size: cover; background-position: center right 20%; min-height: 100vh; width: 100vw; position: relative;">
                <div class="carousel-caption d-none d-md-block d-md-flex align-items-center justify-content-start text-left" style="background: none; left: 0; right: auto; width: 100%; height: 100vh; padding-left: 10%; transform: translateY(10%);">
                    <div class="container">
                        <div class="row align-items-center" style="min-height: 100vh;"> 
                            <div class="col-lg-6 text-left"> 
                                <h4 class="display-4 mb-3" style="font-size: 30px; color: {{ $slider->title_color }};">
                                    {{ $slider->title }}
                                </h4>
                                <p class="mb-3" style="color: {{ $slider->description_color }};">
                                    {{ $slider->description }}
                                </p>
                                <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{ route('product.index') }}">
                                    {{ $slider->button_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <!-- About Start -->
     <div class="container-fluid about bg-light py-5">
         <div class="container py-5">
             <div class="row g-5 align-items-center">
                 <!-- Teks Bagian Kiri -->
                 <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                     <div class="section-title text-start mb-5">
                         <h4 class="sub-title pe-3 mb-0">{{ __('messages.about_us') }}</h4>
                         <h4 class="display-3 mb-4" style="font-size: 40px;">
                             {{ $company->nama_perusahaan ?? 'Arkamaya Guna Saharsa' }}</h4>
                         <p class="mb-4" style="text-align: justify;">
                             {{ $company->sejarah_singkat ?? ' ' }}
                         </p>
                     </div>
                     <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                         <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                             href="{{ route('about') }}">See More</a>
                     </div>
                 </div>
                 <!-- Gambar Bagian Kanan -->
                 <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                     <div class="about-img position-relative overflow-hidden">
                         <!-- Gambar About -->
                         <div style="text-align: right;">
                         <img src="{{ $company && $company->nama_gambar ? Storage::url($company->nama_gambar) : asset('assets/img/about.jpg') }}"
                         style="object-fit: cover; max-height: 400px;">
                     </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
    <!-- About End -->
    <!-- Product Start -->
    @if (!$produks->isEmpty())
        <div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">{{ __('messages.find_products') }}</h4>
                    </div>
                    <h1 class="display-3 mb-4">{{ __('messages.our_products') }}</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($produks as $produk)
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <!-- Card is now wrapped in a link -->
                            <a href="{{ route('product.show', $produk->id) }}" style="text-decoration: none;">
                                <div class="blog-item rounded"
                                    style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; height: 400px; border-radius: 15px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="blog-img"
                                        style="overflow: hidden; border-radius: 15px; position: relative; flex: 1;">
                                        <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                            class="img-fluid w-100"
                                            style="border-radius: 15px; width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                            alt="{{ $produk->nama }}"
                                            onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0px 4px 15px rgba(0, 0, 0, 0.2)';"
                                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    </div>
                                    <h5
                                        style="font-weight: bold; color: #343a40; font-size: 1rem; margin: 0; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $produk->nama }}
                                        <span class="arrow"
                                            style="display: inline-block; font-size: 1.5rem; color: #007BFF; transition: transform 0.3s ease;"
                                            onmouseover="this.textContent='—>'" onmouseout="this.textContent='→'">→</span>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                            href="{{ route('product.index') }}">See More</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Product End -->

    <!-- Partner Section Start -->
    <section id="merek-mitra">
        <div class="container-fluid service mb-5">
            <div class="container">
                <div class="section-title wow fadeInUp" data-wow-delay="1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">{{ __('messages.partnership') }}</h4>
                    </div>
                    <h1 class="display-3 mb-4">{{ __('messages.our_partners') }}</h1>
                </div>
                @if ($partners->isNotEmpty())
                    <div class="container overflow-hidden">
                        <div class="row gy-4">
                            @foreach ($partners as $key => $p)
                                <div
                                    class="col-6 col-md-4 col-xl-3 text-center partner-item {{ $key >= 8 ? 'd-none' : '' }}">
                                    <div class="bg-light px-4 py-3 px-md-6 py-md-4 px-lg-8 py-lg-5">
                                        <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}"
                                            width="100%" height="100" style="object-fit:contain;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($partners->count() > 8)
                            <div class="text-center mt-4">
                                <button id="show-more-partners"
                                    class="btn btn-primary">{{ __('messages.show_more') }}</button>
                                <button id="show-less-partners"
                                    class="btn btn-secondary d-none">{{ __('messages.show_less') }}</button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Partner Section End -->

    <!-- Principal Section Start -->
    <div class="container-fluid wow zoomInDown" data-wow-delay="0.1s">
        <div class="container">
            <div class="section-title">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ __('messages.trusted_collaboration') }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ __('messages.distributor_company') }}</h1>
            </div>
            @if ($principals->isNotEmpty())
                <div class="container overflow-hidden">
                    <div class="row gy-4">
                        @foreach ($principals as $key => $p)
                            <div
                                class="col-6 col-md-4 col-xl-3 text-center principal-item {{ $key >= 8 ? 'd-none' : '' }}">
                                <div class="bg-light px-4 py-3 px-md-6 py-md-4 px-lg-8 py-lg-5">
                                    <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}"
                                        width="100%" height="65">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($principals->count() > 8)
                        <div class="text-center mt-4">
                            <button id="show-more-principals"
                                class="btn btn-primary">{{ __('messages.show_more') }}</button>
                            <button id="show-less-principals"
                                class="btn btn-secondary d-none">{{ __('messages.show_less') }}</button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <!-- Principal Section End -->

    <!-- Combined Script for Show More and Show Less -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupShowMoreLess(sectionClass, showMoreBtnId, showLessBtnId, itemClass, limit) {
                const showMoreBtn = document.getElementById(showMoreBtnId);
                const showLessBtn = document.getElementById(showLessBtnId);
                const items = document.querySelectorAll(`.${itemClass}`);

                if (showMoreBtn && showLessBtn) {
                    showMoreBtn.addEventListener('click', function() {
                        items.forEach(function(item, index) {
                            if (index >= limit) {
                                item.classList.remove('d-none'); // Show additional items
                            }
                        });
                        showMoreBtn.classList.add('d-none'); // Hide Show More button
                        showLessBtn.classList.remove('d-none'); // Show Show Less button
                    });

                    showLessBtn.addEventListener('click', function() {
                        items.forEach(function(item, index) {
                            if (index >= limit) {
                                item.classList.add('d-none'); // Hide additional items
                            }
                        });
                        showLessBtn.classList.add('d-none'); // Hide Show Less button
                        showMoreBtn.classList.remove('d-none'); // Show Show More button
                    });
                }
            }

            // Setup Show More/Less for Partner Section
            setupShowMoreLess(
                'partner-section',
                'show-more-partners',
                'show-less-partners',
                'partner-item',
                8
            );

            // Setup Show More/Less for Principal Section
            setupShowMoreLess(
                'principal-section',
                'show-more-principals',
                'show-less-principals',
                'principal-item',
                8
            );
        });
    </script>

    <!-- E-commerce Section Start -->
    @if ($brand->isNotEmpty())
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">{{ __('messages.ecommerce_title') }}</h4>
                    </div>
                    <h1 class="display-3 mb-4">{{ __('messages.explore_more_products') }}</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="col-12 wow fadeInUp text-center" data-wow-delay="0.1s">
                            <div class="logo-container text-center">
                                <div class="logo-static text-center"
                                    style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px;">
                                    @foreach ($brand as $b)
                                        @if ($b->gambar)
                                            @php
                                                $imagePath = asset('storage/' . $b->gambar);
                                                $brandUrl = !empty($b->url) ? (filter_var($b->url, FILTER_VALIDATE_URL) ? $b->url : 'http://' . $b->url) : '#';
                                            @endphp
                                            <a href="{{ $brandUrl }}" target="{{ !empty($b->url) ? '_blank' : '_self' }}"
                                                style="display: inline-block; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                                onmouseover="this.firstElementChild.style.transform='scale(1.2)'; this.firstElementChild.style.boxShadow='0px 4px 15px rgba(0, 0, 0, 0.2)';"
                                                onmouseout="this.firstElementChild.style.transform='scale(1)'; this.firstElementChild.style.boxShadow='none';">
                                                <img src="{{ $imagePath }}" alt="{{ $b->type ?? 'Brand Logo' }}"
                                                    class="logo"
                                                    style="width: 300px; height: auto; object-fit: contain; padding: 10px; border-radius: 8px; transition: transform 0.3s ease;">
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  

    <!-- Map Start -->
    <div class="container"
        style="
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            background-color: #fff;
            text-align: center; ">

        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="sub-style">
                <h4 class="sub-title px-3 mb-0">{{ __('messages.our_loyal_customers') }}</h4>
            </div>
            <h1 class="display-3 mb-4">{{ __('messages.our_customers') }}</h1>
        </div>

        <hr>

        <div id="umalo" style=" width: 100%; height: 600px; border-radius: 10px; overflow: hidden;"></div>
    </div> <br> <br>
    <!-- Map End -->

    <!-- Include Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta
        var map = L.map('umalo').setView([-2.548926, 118.0148634], 5); // Pusat Indonesia

        //tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Terjemahan dari server untuk konten popup
        let translationTemplate =
            `{{ __('messages.members_in_province', ['count' => ':count', 'province' => ':province']) }}`;

        function addMarker(lat, lng, province, userCount, users) {
            var marker = L.marker([lat, lng]).addTo(map);

            // Buat daftar pengguna
            let userList = '<ul>';
            users.forEach(function(user) {
                userList += `<li>${user.nama_perusahaan} (Became a Member on: ${user.created_at})</li>`;
            });
            userList += '</ul>';

            // Terjemahan dinamis
            let popupText = translationTemplate
                .replace(':count', userCount)
                .replace(':province', province);

            // Konten popup untuk marker
            marker.bindPopup(`
                <div class="info-window">
                    <h3 class="popup-title">${province}</h3>
                    <p class="popup-description">${popupText}</p>
                    ${userList}
                </div>
            `);

            // Tooltip
            marker.bindTooltip(`<div>${province}</div>`, {
                permanent: false,
                direction: 'top',
                offset: [0, -20],
                className: 'marker-tooltip'
            });

            marker.on('mouseover', function(e) {
                this.openTooltip();
            });
            marker.on('mouseout', function(e) {
                this.closeTooltip();
            });
        }



        fetch("{{ url('/locations') }}")
            .then(response => response.json())
            .then(data => {
                console.log("Received Data:", data); // Debugging to check data
                data.forEach(location => {
                    if (location.user_count > 0) {
                        console.log("Adding marker for:", location.province, "with", location.user_count,
                            "users.");
                        addMarker(location.latitude, location.longitude, location.province, location.user_count,
                            location.user_data);
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    <style>
        
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .navbar-nav .nav-link {
        font-size: 14px; /* Lebih kecil untuk HP */
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
    .navbar-nav .nav-link {
        font-size: 16px;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
    .navbar-nav .nav-link {
        font-size: 18px;
    }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
    .navbar-nav .nav-link {
        font-size: 20px;
    }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
    .navbar-nav .nav-link {
        font-size: 22px;
    }

        /* Efek Fade + Zoom */
        .carousel-item {
            transition: transform 1s ease-in-out, opacity 1s ease-in-out;
            transform: translateX(-100%);
            opacity: 0;
        }

        .carousel-item.active {
            transform: translateX(0);
            opacity: 1;
        }
        .marker-tooltip {
            background-color: #b3d9ff;
            border: 1px solid #80b3ff;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            font-size: 12px;
            color: #333;
        }

        .info-window img.popup-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .popup-title {
            font-size: 20px;
            color: black;
            font-weight: bold;
        }

        .popup-description,
        .popup-address {
            font-size: 12px;
            color: #333;
            margin-top: 10px;
            text-align: justify;
        }

        /* Media query untuk perangkat dengan lebar maksimal 768px */
        @media (max-width: 768px) {
            .info-window {
                padding: 10px;
            }

            .popup-title {
                font-size: 18px;
            }

            .popup-description,
            .popup-address {
                font-size: 10px;
            }

            .info-window img.popup-image {
                margin-bottom: 5px
            }
        }

        /* Media query untuk perangkat dengan lebar maksimal 480px */
        @media (max-width: 480px) {
            .popup-title {
                font-size: 16px;
            }

            .popup-description,
            .popup-address {
                font-size: 9px;
            }
        }
    </style>
    <!-- Map End -->

    <style>
        .logo-container {
            width: 100%;
            overflow: hidden;
            background-color: #ffffff;
            padding: 10px 0;
        }

        .logo-scroller {
            display: flex;
            width: max-content;
        }

        /* Partner Section Animation */
        .partner-scroller {
            animation: scroll-right 10s linear infinite;
        }

        /* Principal Section Animation */
        .principal-scroller {
            animation: scroll-left 10s linear infinite;
        }

        /* Static section for E-commerce, no animation */
        .logo-static {
            display: flex;
            justify-content: center;
            /* Center the logos horizontally */
            align-items: center;
            /* Vertically align the logos */
            flex-wrap: wrap;
            /* Allow logos to wrap in mobile view */
        }

        .logo {
            width: 300px;
            margin-right: 20px;
            height: 120px;
            object-fit: contain;
        }

        @keyframes scroll-right {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(100%);
            }
        }

        @keyframes scroll-left {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Media query for mobile view */
        @media (max-width: 768px) {
            .logo-static {
                flex-direction: column;
                /* Stack logos vertically in mobile view */
            }

            .logo {
                margin: 10px 0;
                /* Add vertical spacing between logos in mobile view */
            }
        }
    </style>

    <style>
        /* Styling About Image */
        .about-img {
            position: relative;
            max-height: 400px;
            overflow: hidden;
        }

        .about-img img {
            object-fit: cover;
        }

        /* Styling Logo di Atas Layer */
        .about-logo {
            position: absolute;
            top: 88%;
            /* Posisi vertikal (default: tengah) */
            left: 8%;
            /* Posisi horizontal (default: tengah) */
            transform: translate(-50%, -50%);
            /* Agar posisi logo tepat di tengah */
            z-index: 10;
            /* Membawa logo ke depan layer gambar utama */
            width: 130px;
            /* Ukuran default logo */
            height: 130px;
            border: 3px solid #fff;
            /* Border putih opsional */
            border-radius: 50%;
            /* Membuat logo berbentuk lingkaran */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Opsional: Bayangan */
            overflow: hidden;
        }

        .about-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .about-logo {
                width: 110px;
                /* Ukuran logo lebih kecil di layar kecil */
                height: 110px;
                top: 90%;
                /* Menyesuaikan posisi vertikal */
                left: 10%;
                /* Menyesuaikan posisi horizontal */
            }
        }

        @media (max-width: 576px) {
            .about-logo {
                width: 90px;
                /* Ukuran logo paling kecil di layar sangat kecil */
                height: 90px;
                top: 90%;
                /* Menyesuaikan posisi vertikal */
                left: 10%;
                /* Menyesuaikan posisi horizontal */
            }
        }
    </style>
    <!-- Ecommerce End -->
@endsection