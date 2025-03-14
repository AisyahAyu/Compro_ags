@extends('layouts.Member.master')

@section('content')
    <div class="container py-5" style="margin-top: 150px;">
        <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">

            <h1 class="display-3 mb-4">{{ __('messages.activity') }}</h1>
        </div>
        <!-- Activity Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <!-- Navigation Section -->
            <div class="row mb-4 d-flex align-items-center justify-content-between">
                <!-- Showing X-Y of Z -->
                <div class="col-md-4">
                    <p class="mb-0">{{ __('messages.showing') }} {{ $activities->firstItem() }} - {{ $activities->lastItem() }}
                        {{ __('messages.from') }} {{ $activities->total() }}</p>
                </div>
                <!-- Show per Page and Sort By -->
                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <label for="sort-by" class="mb-0 me-4" style="white-space: nowrap;">
                        {{ __('messages.sort_by') }} :
                    </label>
                    <select id="sort-by" class="form-select form-select-sm">
                        <option value="newest">{{ __('messages.newest') }}</option>
                        <option value="latest">{{ __('messages.latest') }}</option>
                    </select>
                </div>
            </div>


            <!-- Activity Content -->
            <div class="row g-4 justify-content-center">
                @foreach ($activities as $item)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item rounded"
                            style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 15px;">
                            <div class="blog-img">
                                <img src="{{ asset('images/' . $item->image) }}" class="img-fluid w-100" alt="Image"
                                    style="border-radius: 15px; width: 100%; height: 250px; object-fit: cover;">
                            </div>
                            <div class="blog-content p-4" style="flex-grow: 1;">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted" style="font-size: 0.875rem;"><i
                                            class="fa fa-calendar-alt text-primary"></i> {{ $item->date->format('d M Y') }}
                                    </p>
                                </div>
                                <a href="" class="h4"
                                    style="font-weight: bold; color: #343a40; text-decoration: none;">{{ $item->title }}</a>
                                <p class="my-4"
                                    style="
                                    font-size: 0.875rem;
                                    color: #6c757d;
                                    margin: 0;
                                    line-height: 1.5;
                                    overflow: hidden;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
    {{ Str::limit($item->description, 40) }}
</p>

                                <a href="{{ route('activity.show', $item->id) }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1"
                                    style="background-color: #007BFF; border: none;">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $activities->links() }} <!-- Menampilkan pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- Activity End -->
    </div>
@endsection
