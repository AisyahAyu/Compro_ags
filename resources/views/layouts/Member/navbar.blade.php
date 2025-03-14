<body>
    <!-- Topbar Start -->
    @php
        $compro = \App\Models\CompanyParameter::first();
    @endphp

    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="container">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <!-- Maps / Office Location -->
                        @if (!empty($compro->maps))
                            <a href="{{ $compro->maps }}" class="text-light me-4" target="_blank">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>{{ __('messages.lokasi') }}
                            </a>
                        @else
                            <p class="text-light me-4">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Office Location Not Available
                            </p>
                        @endif

                        <!-- Phone Number -->
                        @if (!empty($compro->no_telepon))
                            <a href="tel:+62{{ $compro->no_telepon }}" class="text-light me-4">
                                <i class="fas fa-phone-alt text-primary me-2"></i>{{ $compro->no_telepon }}
                            </a>
                        @else
                            <p class="text-light me-4">
                                <i class="fas fa-phone-alt text-primary me-2"></i>Phone Number Not Available
                            </p>
                        @endif

                        <!-- Email -->
                        @if (!empty($compro->email))
                            <a href="mailto:{{ $compro->email }}" class="text-light me-0">
                                <i class="fas fa-envelope text-primary me-2"></i>{{ $compro->email }}
                            </a>
                        @else
                            <p class="text-light me-0">
                                <i class="fas fa-envelope text-primary me-2"></i>Email Not Available
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        @if (auth()->check())
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" id="companyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <small><i class="fa fa-user text-primary me-2"></i>{{ auth()->user()->nama_perusahaan }}</small>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ auth()->user()->type === 'member' ? route('profile.show') : route('distributor.profile.show') }}">
                                            <i class="fa fa-user me-2"></i>{{ __('messages.profil') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out-alt me-2"></i>{{ __('messages.keluar') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @auth
                                @if (Auth::user()->type === 'distributor')
                                    <div class="nav-item">
                                        <a href="{{ route('quotations.cart') }}" class="nav-link">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span id="cart-count" class="badge bg-primary rounded-pill">
                                                {{ session('quotation_cart') ? count(session('quotation_cart')) : 0 }}
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            @endauth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                <small class="btn btn-primary rounded-pill text-white py-1 px-1" style="width: 120px;">
                                    <i class="fa fa-sign-in-alt text-white me-2"></i>{{ __('messages.masuk') }}
                                </small>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @php
        $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->get()
            ->groupBy('type');

        $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
    @endphp

<nav class="navbar navbar-expand-lg navbar-light transparent">
    <div class="container-fluid px-4 py-2">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center p-0 flex-wrap">
            <img src="{{ asset('assets/img/AGS-logo.png') }}" alt="Logo" class="me-2" style="width: 70px;">
            <img src="{{ asset('images/catalogue.png') }}" alt="Logo" class="me-2 catalogue-logo" style="width: 120px;">
            <h6 class="fs-6 text-primary fw-bold ms-2 text-wrap">PT. ARKAMAYA GUNA SAHARSA</h6>
        </a>
        <button class="navbar-toggler menu-icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <ul class="navbar-nav transparent" style="border-radius: 30px; padding: 10px;">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-light-blue">Home</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link text-light-blue">About us</a></li>
                <li class="nav-item"><a href="{{ route('activity') }}" class="nav-link text-light-blue">Our Activities</a></li>
                <a href="{{ route('product.index') }}" class="nav-item nav-link text-light-blue">{{ __('messages.products') }}</a>

                @if ($brand->isNotEmpty())
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-light-blue" id="ecommerceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('messages.ecommerce') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="ecommerceDropdown">
                            @foreach ($brand as $singleBrand)
                                <li>
                                    <a href="{{ strpos($singleBrand->url, 'http://') === 0 || strpos($singleBrand->url, 'https://') === 0 ? $singleBrand->url : 'http://' . $singleBrand->url }}" target="_blank" class="dropdown-item">{{ $singleBrand->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="#footer-section" id="contact-link" class="nav-item nav-link text-light-blue">{{ __('messages.contact_us') }}</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-light-blue" data-bs-toggle="dropdown">
                        @if (LaravelLocalization::getCurrentLocale() == 'id')
                            <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia">
                        @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                            <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English">
                        @else
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="{{ LaravelLocalization::getLocalizedURL('id') }}" class="dropdown-item">
                            <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia">{{ __('messages.bahasa') }}
                        </a>
                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item">
                            <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English">{{ __('messages.english') }}
                        </a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>


    <style>
         @media (max-width: 991px) {
            .navbar-collapse {
                background-color: rgba(255, 255, 255, 0.9); 
                padding: 10px;
                border-radius: 10px;
            }
            .navbar-nav .nav-item {
                text-align: center;
                padding: 5px 0;
            }
            .navbar-brand .catalogue-logo {
                display: none;
            }
        }

        .navbar-toggler {
            border: none;
            outline: none;
            color: white;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-nav.transparent {
            background-color: rgba(255, 255, 255, 0) !important;
        }

        .navbar-nav.solid {
            background-color: rgb(15, 15, 53) !important;
            border-radius: 30px;
            color: #0D0D55;
            padding: 10px;
            transition: background-color 0.3s ease-in-out;
            font-weight: bold !important;
        }

        .text-light-blue {
            color: #FFD700 !important;
            font-weight: bold !important;
            font-size: 18px !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #FFD700 !important;
            font-weight: bold !important;
            font-size: 18px !important;
        }

        .navbar-light .dropdown-menu .dropdown-item {
            color: #FFD700 !important;
            font-weight: bold !important;
            font-size: 18px !important;
        }

        .navbar {
            position: fixed;
            top: 0;
            color: white;
            width: 100%;
            left: 0;
            z-index: 1000;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .navbar.transparent {
            background-color: rgba(255, 255, 255, 0.1);
            top: 45px;
            box-shadow: none;
        }

        .navbar.solid {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-icon {
            color: white;
            font-size: 1.5em;
            line-height: normal;
        }

        .navbar-nav .nav-link {
            font-weight: bold;
            padding: 10px 15px;
            color: white !important;
        }

        .navbar-nav .nav-link:hover {
            color: #eb6f4a !important;
        }

        .navbar-nav .dropdown-menu {
            background-color: #3D4852 !important;
        }

        .navbar-nav .dropdown-menu .dropdown-item {
            color: darkblue !important;
        }

        .navbar-nav .dropdown-menu .dropdown-item:hover {
            background-color: white !important;
        }

        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
            }

            .dropdown-menu {
                text-align: center;
            }

            .navbar-nav .nav-item {
                padding: 10px 0;
            }
        }

        @media (min-width: 992px) {
            .navbar1.fixed {
                position: fixed;
                top: 0;
                left: 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        }
    </style>

    <script>
        document.addEventListener("scroll", function () {
            const navbar = document.querySelector(".navbar");
            const navbarNav = document.querySelector(".navbar-nav");

            if (window.scrollY > 50) {
                navbar.classList.remove("transparent");
                navbar.classList.add("solid");
                navbarNav.classList.add("solid");
                navbarNav.classList.remove("transparent");
            } else {
                navbar.classList.remove("solid");
                navbar.classList.add("transparent");
                navbarNav.classList.remove("solid");
                navbarNav.classList.add("transparent");
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const dropdownItems = document.querySelectorAll(".navbar-nav .dropdown-toggle");

            dropdownItems.forEach((item) => {
                item.addEventListener("click", function (event) {
                    if (window.innerWidth < 992) {
                        event.preventDefault();
                        const submenu = this.nextElementSibling;
                        submenu.classList.toggle("show");
                    }
                });
            });
        });
    </script>
</body>