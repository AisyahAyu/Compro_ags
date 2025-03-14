@extends('layouts.Member.master')

@section('content')
    <div class="container mt-4 py-5 mb-5"
        style="background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        <!-- Banner Section -->
        <div class="bg-light p-5 rounded" style="box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">
    <div class="row align-items-center">
        <!-- Kolom Gambar (Kiri) -->
        <div class="col-md-6 text-center">
            @if ($produk->images->count() > 1)
            <!-- Bootstrap Carousel for multiple images -->
            <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($produk->images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset($image->gambar) }}" alt="{{ $produk->nama }}" class="img-fluid w-100"
                            style="height: 350px; object-fit: cover; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#productImageCarousel" role="button" data-bs-slide="prev"
                    style="width: 40px; height: 40px; background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="filter: invert(1); width: 20px; height: 20px;"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productImageCarousel" role="button" data-bs-slide="next"
                    style="width: 40px; height: 40px; background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="filter: invert(1); width: 20px; height: 20px;"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
            <!-- Thumbnails dengan Indikator -->
             <!-- Thumbnail Container -->
            <div class="thumbnails d-flex gap-2 overflow-auto pb-2">
                @foreach ($produk->images as $key => $image)
                <div class="thumbnail-item {{ $key == 0 ? 'active' : '' }}" 
                     data-bs-target="#productImageCarousel" 
                     data-bs-slide-to="{{ $key }}">
                    <img src="{{ asset($image->gambar) }}" 
                         class="thumbnail-img img-fluid rounded"
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                </div>
                @endforeach
            </div>
            @else
            <!-- Display single image if there's only one -->
            <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" alt="{{ $produk->nama }}"
                class="img-fluid" style="max-height: 350px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);">
            @endif
        </div>

        <!-- Kolom Teks (Kanan) -->
        <div class="col-md-6">
            <h3 class="text-primary font-weight-bold">{{ $produk->nama }}</h3><br>
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel">
            <div class="product__details__tab__desc">
                <h4>{{ __('messages.description_product') }}</h4>
                <p id="product-description">{!! $produk->deskripsi !!}</p>
                <a href="javascript:void(0);" id="toggle-description" style="color: blue; cursor: pointer;">Read More</a>
            </div>
            <br>
            <ul style="list-style: none; padding: 0;">
                <li style="font-weight: bold; color: black;">
                    <b>{{ __('messages.merk') }}</b>
                    <span style="font-weight: normal; color: #555; margin-left: 54px;">{{ $produk->merk }}</span>
                </li>
                <li style="font-weight: bold; color: black;">
                    <b>{{ __('messages.type') }}</b>
                    <span style="font-weight: normal; color: #555; margin-left: 66px;">{{ $produk->tipe }}</span>
                </li>
                <li style="font-weight: bold; color: black;">
                    <b>{{ __('messages.link') }}</b>
                    <span style="font-weight: normal; color: #555; margin-left: 29px;">
                        <a href="{{$produk->link}}" target="_blank" style="text-decoration: none;">
                            {{ __('messages.click_here') }}
                        </a>
                    </span>
                </li>
            </ul>
            <div class="product__details__tab__desc">
                <h4>{{ __('messages.specification_product') }}</h4>
                @if($produk->spesifikasi)
                    @php
                        // Pisahkan berdasarkan titik koma (;) atau newline (\n)
                        $items = preg_split("/;\s*|\n/", $produk->spesifikasi);
                    @endphp
                    <ul id="product-specification" style="list-style: none;">
                        @foreach ($items as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="javascript:void(0);" id="toggle-specification" style="color: blue; cursor: pointer;">Read More</a>
                @else
                    <p>Spesifikasi tidak tersedia.</p>
                @endif
            </div>


            <!-- Tab Content untuk Deskripsi dan Spesifikasi -->
            <!-- <div class="mt-4"> -->
                <!-- <ul class="nav nav-tabs" role="tablist"> -->
                    <!-- <li class="nav-item"> -->
                        <!-- <a class="nav-link active" data-bs-toggle="tab" href="#tabs-1" role="tab" aria-selected="true"> -->
                            <!-- <b>{{ __('messages.description_product') }}</b> -->
                        <!-- </a> -->
                    <!-- </li> -->
                    <!-- <li class="nav-item"> -->
                        <!-- <a class="nav-link" data-bs-toggle="tab" href="#tabs-2" role="tab" aria-selected="false"> -->
                            <!-- <b>{{ __('messages.specification_product') }}</b> -->
                        <!-- </a> -->
                    <!-- </li> -->
                <!-- </ul> -->
                <!-- <div class="tab-content"> -->
                    <!-- <div class="tab-pane fade show active" id="tabs-1" role="tabpanel"> -->
                        <!-- <div class="product__details__tab__desc"><br> -->
                            <!-- <h4>{{ __('messages.description_product') }}</h4> -->
                            <!-- <p>{!! $produk->deskripsi !!}</p> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="tab-pane fade" id="tabs-2" role="tabpanel"> -->
                        <!-- <div class="product__details__tab__desc"><br> -->
                            <!-- <h4>{{ __('messages.specification_product') }}</h4> -->
                            <!-- <p>{!! $produk->spesifikasi !!}</p> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
</div>

            <!-- Custom CSS -->
            <style>
                /* Flexbox for tab navigation */
                .nav-tabs {
                    display: flex;
                    justify-content: space-between;
                }
                .nav-tabs .nav-item {
                    flex: 1;
                }
                .nav-tabs .nav-link {
                    text-align: center;
                    padding: 10px 20px;
                    white-space: nowrap; /* Prevent text wrapping */
                }
                /* Remove horizontal scroll for mobile */
                @media (max-width: 768px) {
                    .nav-tabs {
                        flex-direction: row; /* Ensure tabs are in a row */
                    }
                }
            </style>

        </div>
    </div>
    <!-- Spacer -->
    <div class="my-5"></div>

    <div class="container mt-4 py-5 mb-5"
    style="background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
    <!-- Similar Products Section -->
    <h2 class="text-center text-uppercase font-weight-bold mb-5" style="letter-spacing: 2px;">
        {{ __('messages.similar_product') }}</h2>
    <div class="bg-light p-5 rounded" style="box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">
        <div class="row">
            @foreach ($produkSerupa as $similarProduct)
                <div class="col-md-3 mb-4">
                    <div class="product-card text-center"
                        style="border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                        @php
                            $name = $similarProduct->nama;
                            $limitedName = strlen($name) > 22 ? substr($name, 0, 22) . '...' : $name;
                        @endphp
                        <a href="{{ route('product.show', $similarProduct->id) }}" class="d-block"
                            style="text-decoration: none;">
                            <img src="{{ asset($similarProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                class="img-fluid w-100" alt="{{ $similarProduct->nama }}"
                                style="max-height: 220px; object-fit: cover; transition: transform 0.3s ease;">
                        </a>
                        <div class="p-3" style="background-color: #fff;">
                            <h5 class="mt-2 text-dark font-weight-bold">{{ $limitedName }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

    </div>

    <!-- Custom CSS -->
    <style>
        .readMore{
           display:inline-block;
           color:blue;
        }
        .readLess{
           display:none;
           color:blue;
        }
        #readMore:hover,#readLess:hover{
           color:navy;
           cursor:pointer;
           text-decoration:underline;
        }
        #moreText{
           display:none;
        }
        .thumbnail-item { /* tambahkan titik di sini */
        /* Pastikan ada titik di awal */
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
        }

        .thumbnail-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .thumbnail-item.active::before {
            border-color: #007bff;
        }

        .thumbnail-item:hover::before {
            border-color: #007bff;
        }

        .thumbnails::-webkit-scrollbar {
            height: 8px;
        }

        .thumbnails::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .thumbnails::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        /* Hover effect on product cards */
        .product-card:hover {
            transform: translateY(-10px);
        }

        .product-card img:hover {
            transform: scale(1.1);
        }

        /* Text Styles */
        .text-primary {
            color: #007bff !important;
        }

        /* Font weight and shadow for heading */
        h1,
        h2 {
            font-weight: 700;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }
    </style>   
    // Tambahkan di bagian bawah template Blade
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var descElement = document.getElementById("product-specification");
        var toggleBtn = document.getElementById("toggle-specification");
        var fullText = descElement.innerHTML;
        var maxWords = 250;

        // Split text menjadi array kata
        var words = fullText.split(" ");
            
        // Jika lebih dari maxWords, potong teks
        if (words.length > maxWords) {
            var shortText = words.slice(0, maxWords).join(" ") + "...";
            descElement.innerHTML = shortText;

            toggleBtn.addEventListener("click", function() {
                if (descElement.innerHTML === shortText) {
                    descElement.innerHTML = fullText;
                    toggleBtn.innerHTML = "Read Less";
                } else {
                    descElement.innerHTML = shortText;
                    toggleBtn.innerHTML = "Read More";
                }
            });
        } else {
            toggleBtn.style.display = "none"; // Sembunyikan tombol jika teks kurang dari 100 kata
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
    var descElement = document.getElementById("product-description");
    var toggleBtn = document.getElementById("toggle-description");
    var fullText = descElement.innerHTML;
    var maxWords = 25;
    // Split text menjadi array kata
    var words = fullText.split(" ");
        
    // Jika lebih dari maxWords, potong teks
    if (words.length > maxWords) {
        var shortText = words.slice(0, maxWords).join(" ") + "...";
        descElement.innerHTML = shortText;
        toggleBtn.addEventListener("click", function() {
            if (descElement.innerHTML === shortText) {
                descElement.innerHTML = fullText;
                toggleBtn.innerHTML = "Read Less";
            } else {
                descElement.innerHTML = shortText;
                toggleBtn.innerHTML = "Read More";
            }
        });
    } else {
        toggleBtn.style.display = "none"; // Sembunyikan tombol jika teks kurang dari 100 kata
    }
});
            document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk update active thumbnail
            function updateThumbnails(index) {
                document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                    item.classList.toggle('active', i === index);
                });
            }
        
            // Saat carousel berganti
            const carousel = document.getElementById('productImageCarousel');
            carousel.addEventListener('slid.bs.carousel', function (e) {
                updateThumbnails(e.to);
            });
        
            // Saat thumbnail diklik
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const index = this.getAttribute('data-bs-slide-to');
                    const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                    carouselInstance.to(index);
                    updateThumbnails(index);
                });
            });
        
            // Inisialisasi posisi awal
            updateThumbnails(0);
        });
    </script>
    @endsection
