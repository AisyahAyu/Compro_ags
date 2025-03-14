@extends('layouts.Member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="position: relative;">
        <!-- Background Image -->
        <div style="background: url('{{ asset('images/header.png') }}') no-repeat center center; background-size: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        
        <!-- Overlay Hitam Transparan -->
        <div style="background-color: rgba(0, 0, 0, 0.59); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2;"></div>
    
        <!-- Konten Utama -->
        <div class="container text-center py-5" style="max-width: 900px; position: relative; z-index: 3;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ __('messages.about_us') }}</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active text-primary">{{ __('messages.about_us') }}</li>
            </ol>
        </div>
    </div>

    <!-- Header End -->

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


    <!-- Vision Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ __('messages.tujuan_kami') }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ __('messages.visi_misi_perusahaan') }}</h1>
            </div>
            <div class="row g-12 justify-content-center d-flex">
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                    <div class="team-item rounded flex-fill"
                        style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4"
                            style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                            <h5>{{ __('messages.visi') }}</h5>
                            <p class="mb-0" style="font-weight: bold; color: #333;">{{ $company->visi ?? ' ' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                    <div class="team-item rounded flex-fill"
                        style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4"
                            style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                            <h5>{{ __('messages.misi') }}</h5>
                            <p class="mb-0" style="font-weight: bold; color: #333;">{{ $company->misi ?? ' ' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vision End -->


    <!-- Partner Section Start -->
    @if ($principals->isNotEmpty())
        <div class="container-fluid service mb-5">
            <div class="container">
                <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">{{ __('messages.partnership') }}</h4>
                    </div>
                    <h1 class="display-3 mb-4">{{ __('messages.our_partners') }}</h1>
                </div>
                <div class="container overflow-hidden">
                    <div class="row gy-4">
                        @foreach ($partners as $key => $p)
                            <div class="col-6 col-md-4 col-xl-3 text-center partner-item {{ $key >= 8 ? 'd-none' : '' }}">
                                <div class="bg-light px-4 py-3 px-md-6 py-md-4 px-lg-8 py-lg-5">
                                    <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}"
                                        width="100%" height="100" style="object-fit:contain;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($partners->count() > 8)
                        <div class="text-center mt-4">
                            <button id="show-more-partners" class="btn btn-primary">{{ __('messages.show_more') }}</button>
                            <button id="show-less-partners"
                                class="btn btn-secondary d-none">{{ __('messages.show_less') }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <!-- Partner Section End -->

    <!-- Value Start -->
    <div class="container-fluid feature py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ __('messages.keyakinan_kami') }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ __('messages.keunggulan_perusahaan') }}</h1>
            </div>

            <!-- Responsive Values Section -->
            <div class="row g-4 justify-content-center">
                @php
                    // Sample data for the loop, replace with dynamic data if necessary
                    $values = [
                        [
                            'title' => __('messages.bekerja_cepat'),
                            'image' => 'value (1).png',
                            'description' => __('messages.bekerja_cepat_desc'),
                        ],
                        [
                            'title' => __('messages.inovasi'),
                            'image' => 'value (2).png',
                            'description' => __('messages.inovasi_desc'),
                        ],
                        [
                            'title' => __('messages.mandiri'),
                            'image' => 'value (3).png',
                            'description' => __('messages.mandiri_desc'),
                        ],
                        [
                            'title' => __('messages.kualitas'),
                            'image' => 'value (4).png',
                            'description' => __('messages.kualitas_desc'),
                        ],
                        [
                            'title' => __('messages.kepuasan_pelanggan'),
                            'image' => 'value (5).png',
                            'description' => __('messages.kepuasan_pelanggan_desc'),
                        ],
                        [
                            'title' => __('messages.rasa_hormat'),
                            'image' => 'value (6).png',
                            'description' => __('messages.rasa_hormat_desc'),
                        ],
                    ];
                @endphp

                @foreach ($values as $key => $value)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item p-4 h-100"
                            style="height: 400px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <div class="feature-icon mb-4 text-center d-flex align-items-center justify-content-center">
                                <div class="p-3 d-inline-flex bg-white rounded-circle"
                                    style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                    <img src="{{ asset('assets/img/about/' . $value['image']) }}" alt="Icon"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="feature-content text-center">
                                <h5 class="mb-4 font-weight-bold">{{ $value['title'] }}</h5>
                                <p class="mb-0">{{ $value['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Value End -->

    <!-- Sales Channel Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ __('messages.kemitraan') }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ __('messages.saluran_penjualan') }}</h1>
            </div>
            <div class="row g-3 justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-12 col-lg-6 col-xl-4 mb-3">
                    <div class="team-item rounded d-flex flex-column h-100 border-radius-15 box-shadow">
                        <a href="{{ $company->ekatalog ?? '#' }}" target="_blank"
                            class="d-flex flex-column flex-grow-1 text-decoration-none text-dark">
                            <div
                                class="team-content text-center border border-primary border-top-0 rounded-bottom p-4 d-flex flex-column justify-content-center h-100">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <img src="{{ asset('assets/img/e-katalog.png') }}" alt="E-Commerce"
                                        style="width: 55%; height: 50px;">
                                </div>
                                <p class="mb-0 font-weight-bold" style="font-size: 18px;">
                                    {{ __('messages.e_commerce') }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-12 col-lg-6 col-xl-4 mb-3">
                    <div class="team-item rounded d-flex flex-column h-100 border-radius-15 box-shadow">
                        <!-- Card content as a trigger for the modal -->
                        <div class="p-0 w-100 d-flex flex-column flex-grow-1 text-dark text-decoration-none"
                            data-bs-toggle="modal" data-bs-target="#websiteModal">
                            <div
                                class="team-content text-center border border-primary border-top-0 rounded-bottom p-4 d-flex flex-column justify-content-center h-100">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <i class="fa fa-globe fa-3x text-success"></i>
                                    <h5 class="mb-0 font-weight-bold" style="font-size: 28px; margin-left: 15px;">
                                        {{ __('messages.website_kami') }}
                                    </h5>
                                </div>
                                <p class="mb-0" style="font-size: 15px;">{{ __('messages.website_resmi') }}</p>
                                <p class="mb-0 font-weight-bold" style="font-size: 18px;">{{ __('messages.website') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Card 3 -->
                <div class="col-md-12 col-lg-6 col-xl-4 mb-3">
                    <div class="team-item rounded d-flex flex-column h-100 border-radius-15 box-shadow">
                        <a href="https://wa.me/{{ $company->no_wa ? preg_replace('/\D/', '', $company->no_wa) : '' }}"
                            target="_blank" class="d-flex flex-column flex-grow-1 text-decoration-none text-dark">
                            <div
                                class="team-content text-center border border-primary border-top-0 rounded-bottom p-4 d-flex flex-column justify-content-center h-100">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <i class="fab fa-whatsapp fa-3x text-success"></i>
                                    <h5 class="mb-0 font-weight-bold" style="font-size: 28px; margin-left: 15px;">
                                        {{ $company->no_wa ?? ' ' }}
                                    </h5>
                                </div>
                                <p class="mb-0" style="font-size: 13px;">
                                    {{ __('messages.whatsapp_resmi', ['company' => $company->nama_perusahaan ?? '']) }}</p>
                                <p class="mb-0 font-weight-bold" style="font-size: 18px;">
                                    {{ __('messages.hubungi_langsung') }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="websiteModal" tabindex="-1" aria-labelledby="websiteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="websiteModalLabel">{{ __('messages.website_information') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Loop through the first two brands -->
                            @foreach ($brand as $singleBrand)
                                <h5>{{ $singleBrand->nama }}</h5>
                                <p>{{ __('messages.visit_website', ['name' => $singleBrand->nama, 'url' => $singleBrand->url]) }}
                                </p>
                                <p>{{ $singleBrand->description ?? __('messages.no_additional_info') }}</p>
                                <hr>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Channel End -->

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

        function addMarker(lat, lng, province, userCount, users) {
            var marker = L.marker([lat, lng]).addTo(map);

            // Build user info HTML
            let userList = '<ul>';
            users.forEach(function(user) {
                userList += `<li>${user.nama_perusahaan} (Created on: ${user.created_at})</li>`;
            });
            userList += '</ul>';

            // Popup content for marker
            marker.bindPopup(`
        <div class="info-window">
            <h3 class="popup-title">${province}</h3>
            <p class="popup-description">Kami memiliki ${userCount} member di ${province}:</p>
            ${userList}
        </div>
    `);

            // Adding tooltip
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


        // Fetch lokasi dari backend
        // Fetch lokasi dari backend
        fetch("{{ url('/locations') }}")
            .then(response => response.json())
            .then(data => {
                console.log(data); // for debugging
                data.forEach(location => {
                    addMarker(location.latitude, location.longitude, location.province, location.user_count,
                        location.user_data);
                });
            })
            .catch(error => console.error('Error:', error));
    </script>

    <!-- Custom CSS -->
    <style>
        /* Feature item consistent height */
        .feature-item {
            background-color: #fff;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Icon and Image styling */
        .feature-item img {
            max-width: 100%;
            object-fit: cover;
        }

        /* Hover effect on feature items */
        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Behavior */
        @media (max-width: 768px) {
            .feature-item {
                min-height: 300px;
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

    <style>
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

    <script>
        document.getElementById('show-more-partners').addEventListener('click', function() {
            document.querySelectorAll('.partner-item.d-none').forEach(function(item) {
                item.classList.remove('d-none');
            });
            this.style.display = 'none';
            document.getElementById('show-less-partners').classList.remove('d-none');
        });

        document.getElementById('show-less-partners').addEventListener('click', function() {
            document.querySelectorAll('.partner-item').forEach(function(item, index) {
                if (index >= 8) {
                    item.classList.add('d-none');
                }
            });
            this.classList.add('d-none');
            document.getElementById('show-more-partners').style.display = 'inline-block';
        });

        document.getElementById('show-more-principals').addEventListener('click', function() {
            document.querySelectorAll('.principal-item.d-none').forEach(function(item) {
                item.classList.remove('d-none');
            });
            this.style.display = 'none';
            document.getElementById('show-less-principals').classList.remove('d-none');
        });

        document.getElementById('show-less-principals').addEventListener('click', function() {
            document.querySelectorAll('.principal-item').forEach(function(item, index) {
                if (index >= 10) {
                    item.classList.add('d-none');
                }
            });
            this.classList.add('d-none');
            document.getElementById('show-more-principals').style.display = 'inline-block';
        });
    </script>
@endsection
