@extends('layouts.Member.master')

@section('content')
    <!-- Our Product Header Section -->
    <div class="products-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Our Product.</h1>
        </div>
    </div>

    <!-- Product Category Section -->
    <div class="product-category-section">
        <div class="category-container">
            <h2>Product Category.</h2>
            
            <!-- Search Bar -->
            <div class="search-bar">
                <form action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search For Product..." name="search">
                    </div>
                </form>
            </div>
            
            <!-- Category Grid -->
            <div class="category-grid">
                @php
                    $count = 0;
                    $totalCategories = count($kategori);
                @endphp
                
                @foreach($kategori as $category)
                    @php $count++; @endphp
                    
                    @if($count <= $totalCategories - 3)
                    <!-- Top row categories -->
                    <a href="{{ route('member.product.category', $category->id) }}" class="category-card">
                        <div class="category-image">
                            <img src="{{ asset($category->icon_hover) }}" class="category-icon" alt="{{ $category->nama }}">
                        </div>
                        <div class="category-name">
                            {{ $category->nama }}
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
            
            <!-- Bottom Row (Centered) -->
            <div class="bottom-category-row">
                @php
                    $count = 0;
                @endphp
                
                @foreach($kategori as $category)
                    @php $count++; @endphp
                    
                    @if($count > $totalCategories - 3)
                    <!-- Bottom row categories (last 3) -->
                    <a href="{{ route('member.product.category', $category->id) }}" class="category-card">
                        <div class="category-image">
                            <img src="{{ asset($category->icon_hover) }}" class="category-icon" alt="{{ $category->nama }}">
                        </div>
                        <div class="category-name">
                            {{ $category->nama }}
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* Header Styles */
        .products-header {
            background-image: url('{{ asset('assets/img/header.png') }}');
            background-size: cover;
            background-position: center;
            height: 498px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        /* Added transparent black overlay */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .header-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .products-header h1 {
            color: white;
            font-size: 48px;
            font-weight: bold;
            margin: 0;
        }
        
        /* Product Category Section */
        .product-category-section {
            padding: 40px 0;
            background-color: #f5f9fd;
            position: relative;
            overflow: hidden;
        }
        
        .product-category-section::before,
        .product-category-section::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: #e1eaf8;
            z-index: 0;
        }
        
        .product-category-section::before {
            left: -250px;
            top: -100px;
        }
        
        .product-category-section::after {
            right: -250px;
            bottom: -100px;
        }
        
        .category-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }
        
        .category-container h2 {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        
        /* Search Bar Styles */
        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
        
        .search-input-group {
            position: relative;
            width: 100%;
            max-width: 500px;
        }
        
        .search-input-group input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        /* Category Grid Styles */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(236px, 1fr));
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        /* Bottom Row Styling */
        .bottom-category-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        /* Category Card Styles */
        .category-card {
            width: 236px;
            height: 333px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            position: relative;
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-image {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Update all category backgrounds to use header.png */
        .category-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/img/header.png') }}');
            background-size: cover;
            background-position: center;
        }
        
        /* Add dark overlay on top of the background image */
        .category-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }
        
        .category-image img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            position: relative;
            z-index: 2;
            margin-bottom: 30px;
        }
        
        .category-name {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px 10px;
            text-align: center;
            color: white;
            font-weight: 500;
            font-size: 16px;
            z-index: 2;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .category-card {
                width: 100%;
            }
            
            .bottom-category-row {
                flex-direction: column;
                align-items: center;
            }
        }
        
        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


<!-- Dynamic approach using the database -->
<div class="bestseller-section">
    <div class="bestseller-container">
        <h2>Best Seller Products.</h2>
        
        @php
            // Assume we have products from database
            $products = DB::table('produk')->get();
            $productsChunks = $products->chunk(3); // Split into chunks of 3
        @endphp
        
        @foreach($productsChunks as $chunk)
            <div class="product-row">
                @foreach($chunk as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('assets/img/products/default.jpg') }}" alt="{{ $product->nama }}">
                            <div class="ags-logo">
                                <img src="{{ asset('assets/img/ags-logo.png') }}" alt="AGS Logo">
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>{{ $product->nama }}</h3>
                            @if($product->tipe != '-')
                                <p>{{ $product->tipe }}</p>
                            @endif
                            <a href="#" class="read-more-btn">Read More...</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Best Seller Products Section */
    .bestseller-section {
        padding: 60px 0;
        background-color: #f5f9fd;
        position: relative;
        overflow: hidden;
    }
    
    .bestseller-section::before,
    .bestseller-section::after {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background-color: #e1eaf8;
        z-index: 0;
    }
    
    .bestseller-section::before {
        left: -250px;
        top: -100px;
    }
    
    .bestseller-section::after {
        right: -250px;
        bottom: -100px;
    }
    
    .bestseller-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }
    
    .bestseller-container h2 {
        font-size: 40px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 50px;
    }
    
    .product-row {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    
    .product-card {
        width: 300px;
        height: 400px;
        background-color: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
    
    .product-image {
        width: 100%;
        height: 294px;
        position: relative;
        border: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }
    
    .product-image img {
        max-width: 100%;
        max-height: 180px;
        object-fit: contain;
    }
    
    .ags-logo {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));
        padding-top: 20px;
        padding-bottom: 10px;
        text-align: center;
    }
    
    .ags-logo img {
        height: 30px;
        width: auto;
    }
    
    .product-info {
        padding: 15px;
        text-align: center;
    }
    
    .product-info h3 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }
    
    .product-info p {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }
    
    .read-more-btn {
        display: inline-block;
        padding: 5px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .read-more-btn:hover {
        background-color: #f0f0f0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .product-row {
            gap: 20px;
        }
        
        .product-card {
            width: calc(50% - 20px);
        }
    }
    
    @media (max-width: 768px) {
        .product-card {
            width: 100%;
            max-width: 350px;
        }
    }
</style>
@endsection