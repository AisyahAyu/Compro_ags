@extends('layouts.Member.master')

@section('content')

<div class="container" style="margin-top: 150px;">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <div class="mb-4">
                    <!-- Header kategori -->
                    <h4 class="text-dark font-weight-bold d-flex justify-content-left align-items-center"
                        style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#categoryList">
                        {{ __('messages.category') }}
                        <i id="category-icon" class="fas fa-chevron-down ms-2"></i>
                    </h4>

                    <!-- Daftar kategori -->
                    <div class="collapse show" id="categoryList">
                        <ul class="list-group">
                            @foreach ($kategori->take(10) as $kat)
                                <li class="list-group-item category-item text-center py-3 mb-2"
                                    style="background-color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}; color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#fff' : '#000' }};"
                                    onclick="window.location.href='{{ route('filterByCategory', $kat->id) }}'">
                                    <strong>{{ $kat->nama }}</strong>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tombol untuk menampilkan kategori lainnya -->
                        @if ($kategori->count() > 10)
                            <button class="btn btn-link w-100 text-center mt-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#moreCategories" aria-expanded="false" aria-controls="moreCategories"
                                onclick="toggleButtonText(this)">
                                {{ __('messages.show_all_categories') }}
                            </button>

                            <!-- Kategori selebihnya -->
                            <div class="collapse" id="moreCategories">
                                <ul class="list-group mt-2">
                                    @foreach ($kategori->slice(10) as $kat)
                                        <li class="list-group-item category-item text-center py-3 mb-2"
                                            style="background-color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}; color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#fff' : '#000' }};"
                                            onclick="window.location.href='{{ route('filterByCategory', $kat->id) }}'">
                                            <strong>{{ $kat->nama }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Main Content Start -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between mb-4">
                    <div class="col-lg-6">
                        <form method="POST" action="{{ url('products/search') }}" class="d-flex align-items-center">
                            @csrf
                            <input type="text" name="keyword" id="find" placeholder="{{ __('messages.search') }}"
                                class="form-control bg-light shadow-sm" style="border-radius: 10px; padding: 12px;" />
                            <button type="submit" class="btn btn-primary ms-2 px-4"
                                style="padding: 12px; border: none; border-radius: 10px; background-color: #6196FF; color: white;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-3 mt-n2">
                        <select id="sort-by" class="form-select border-0 bg-light shadow-sm" style="border-radius: 10px; padding: 12px; margin-left: 20px; margin-right: 20px;">
                            <option selected>{{ __('messages.sort_by') }}</option>    
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>{{ __('messages.newest') }}</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>{{ __('messages.latest') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Pesan Alert Sukses -->
                <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert"
                    style="display: none;">
                    <span id="success-text"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <div class="row">
                    @foreach ($produks as $produk)
                        <div class="col-md-4 mb-4">
                            <div class="card product-card shadow-sm"
                                style="overflow: hidden; transition: transform 0.3s ease; border-radius: 10px; height: 400px;">
                                <a href="{{ route('product.show', $produk->id) }}">
                                    <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                        class="card-img-top" alt="{{ $produk->nama }}"
                                        style="object-fit: cover; height: 250px; transition: transform 0.3s ease;">
                                </a>
                                <div class="card-body text-center">
                                    @php
                                        $name = $produk->nama;
                                        $limitedName = strlen($name) > 22 ? substr($name, 0, 22) . '..' : $name;
                                    @endphp
                                    <h5 class="card-title text-dark font-weight-bold">{{ $limitedName }}</h5>
                                    <a href="{{ route('product.show', $produk->id) }}"
                                        class="btn btn-outline-primary rounded-pill px-4 py-2 mt-3"
                                        style="transition: background-color 0.3s ease; border-color: #6196FF; color:#6196FF;">
                                        {{ __('messages.show_more') }} →
                                    </a>
                                    <!-- Form untuk Distributor -->
                                    @if (auth()->user() && auth()->user()->type === 'distributor')
                                        <form action="{{ route('quotations.add_to_cart') }}" method="POST"
                                            class="d-flex justify-content-center align-items-center add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                            <input type="number" name="quantity" min="1" value="1"
                                                class="form-control form-control-sm me-2" style="width: 70px;">
                                            <button type="submit" class="btn btn-primary btn-sm px-3">Tambah</button>
                                        </form>
                                    @endif


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $produks->onEachSide(2)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

<script>
    document.getElementById('sort-by').addEventListener('change', function() {
    const params = new URLSearchParams(window.location.search);
    params.set('sort', this.value);
    window.location.search = params.toString();
});
</script>
<script>
    function toggleButtonText(button) {
        const showText = '{{ __('messages.show_all_categories') }}';
        const hideText = '{{ __('messages.show_less_categories') }}';

        if (button.textContent.trim() === showText) {
            button.textContent = hideText;
            button.classList.add('btn-danger');
            button.classList.remove('btn-link');
        } else {
            button.textContent = showText;
            button.classList.add('btn-link');
            button.classList.remove('btn-danger');
        }
    }
</script>
<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah pengiriman form biasa

            const formData = new FormData(this);
            const url = this.action;

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Menampilkan pesan sukses di halaman
                        const successMessage = document.getElementById('success-message');
                        const successText = document.getElementById('success-text');
                        successText.textContent = data.message;
                        successMessage.style.display = 'block';

                        // Perbarui badge jumlah keranjang jika ada
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) {
                            cartCount.textContent = parseInt(cartCount.textContent) + parseInt(
                                formData.get('quantity'));
                        }

                        // Sembunyikan pesan setelah 3 detik
                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 3000);
                    } else {
                        // Menampilkan pesan error
                        alert(data.message || 'Terjadi kesalahan.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>


<!-- Additional Custom CSS -->
<style>
    .product-card {
        border-radius: 10px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        object-fit: cover;
        height: 250px;
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .btn-outline-primary {
        border: 2px solid #007bff;
        color: #007bff;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #007bff;
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 16px;
    }

    .pagination .page-item.active .page-link {
        background-color: #6196FF;
        border-color: #6196FF;
        color: #fff;
    }

    .pagination .page-item .page-link {
        border: 1px solid #ddd;
    }

    @media (max-width: 768px) {
        .pagination .page-link {
            padding: 8px 10px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .pagination .page-item {
            font-size: 12px;
            margin: 0 3px;
        }

        .pagination .page-link {
            padding: 6px 8px;
            font-size: 12px;
        }
    }

    .category-item {
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .category-item:hover {
        background-color: #6196FF;
        color: #fff;
    }

    #category-icon {
        transition: transform 0.3s ease;
    }

    #categoryList {
        margin-top: 10px;
    }

    #categoryList .list-group-item {
        font-size: 14px;
    }

    .btn-link {
        color: #6196FF;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #4576d5;
    }

    @media (max-width: 768px) {
        .category-item {
            font-size: 12px;
        }

        #categoryList .list-group-item {
            padding: 12px;
        }
    }
</style>
