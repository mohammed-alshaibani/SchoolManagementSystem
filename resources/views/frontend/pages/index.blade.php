@extends('./frontend/layouts.app')

@section('title', 'Home - Samha - International School')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">

        <div class="owl-carousel header-carousel position-relative">

            @foreach ($banners as $banner)
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset("storage/".$banner->path) }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">{{ $banner->content }}</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">{{$banner->text}}</p>
                                <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn More</a>
                                <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our Classes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">The Best Kindergarten School For Your Child</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn More</a>
                                <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our Classes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">Make A Brighter Future For Your Child</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn More</a>
                                <a href="" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our Classes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
<div class="container py-5">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">{{ __('messages.nav_news') }}</h1>
            <p>{{ __('Last Posts.') }}</p>
        </div>
    <div class="row g-4">
        @foreach($News as $news)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden hover-card">

                    {{-- صورة البوست --}}
                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('single-post', $news->slug) }}">
                            <img class="card-img-top transition-img" 
                                 src="{{ asset('storage/' . $news->thumbnail) }}" 
                                 alt="{{ $news->title }}" 
                                 style="height: 150px; object-fit: cover;">
                        </a>
                        {{-- التصنيف --}}
                        @if($news->category)
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">
                                <i class="fa fa-folder me-1"></i> {{ $news->category->name }}
                            </span>
                        @endif
                    </div>

                    {{-- محتوى الكارد --}}
                    <div class="card-body d-flex flex-column p-4">
                        
                        {{-- العنوان --}}
                        <a href="{{ route('single-post', $news->slug) }}" 
                           class="h5 fw-bold text-decoration-none text-dark mb-2">
                            {{ $news->title }}
                        </a>

                        {{-- مقتطف من المحتوى --}}
                        <p class="text-muted small mb-3">
                            {{ Str::limit(strip_tags($news->content), 100) }}
                        </p>

                        {{-- الكاتب + التاريخ --}}
                        <div class="d-flex align-items-center mb-3 text-muted small">
                            {{-- <img class="rounded-circle me-2 border" 
                                 src="{{ asset('img/images.png') }}" 
                                 alt="author" 
                                 style="width: 35px; height: 35px;"> --}}
                            <div>
                                {{-- @foreach($news->users as $author)
                                    <span class="d-block"><i class="fa fa-user me-1"></i> {{ $author->name }}</span>
                                @endforeach --}}
                                <span><i class="fa fa-clock me-1"></i> {{ $news->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>

                        {{-- التاجات --}}
                        @if(!empty($news->tags))
                            <div class="mb-3">
                                @foreach($news->tags as $tag)
                                    <span class="badge bg-light text-dark border me-1">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif

                        {{-- زر قراءة المزيد --}}
                        <div class="mt-auto">
                            <a href="{{ route('single-post', $news->slug) }}" 
                               class="btn btn-primary w-100 rounded-pill">
                                اقرأ المزيد <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- بعض الستايل المخصص --}}
<style>
    .hover-card:hover .transition-img {
        transform: scale(1.05);
        transition: transform 0.4s ease;
    }
    .transition-img {
        transition: transform 0.4s ease;
    }
</style>



    <!-- Facilities Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">School Facilities</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                @php
                    $facilities2 = [
                        ['icon' => 'fa-bus-alt', 'title' => 'School Bus', 'color' => 'primary', 'text' => 'Eirmod sed ipsum dolor sit rebum magna erat lorem kasd vero ipsum sit'],
                        ['icon' => 'fa-futbol', 'title' => 'Playground', 'color' => 'success', 'text' => 'Eirmod sed ipsum dolor sit rebum magna erat lorem kasd vero ipsum sit'],
                        ['icon' => 'fa-home', 'title' => 'Healthy Canteen', 'color' => 'warning', 'text' => 'Eirmod sed ipsum dolor sit rebum magna erat lorem kasd vero ipsum sit'],
                        ['icon' => 'fa-chalkboard-teacher', 'title' => 'Positive Learning', 'color' => 'info', 'text' => 'Eirmod sed ipsum dolor sit rebum magna erat lorem kasd vero ipsum sit']
                    ];
                @endphp

                @foreach($facilities2 as $facility)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($loop->index * 0.2) }}s">
                        <div class="facility-item">
                            <div class="facility-icon bg-{{ $facility['color'] }}">
                                <span class="bg-{{ $facility['color'] }}"></span>
                                <i class="fa {{ $facility['icon'] }} fa-3x text-{{ $facility['color'] }}"></i>
                                <span class="bg-{{ $facility['color'] }}"></span>
                            </div>
                            <div class="facility-text bg-{{ $facility['color'] }}">
                                <h3 class="text-{{ $facility['color'] }} mb-3">{{ $facility['title'] }}</h3>
                                <p class="mb-0">{{ $facility['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> -->
    
    
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">School Facilities</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                @foreach($facilities as $facility)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($loop->index * 0.2) }}s">
                        <div class="facility-item">
                            <div class="facility-icon bg-{{ $facility->color }}">
                                <span class="bg-{{ $facility->color }}"></span>
                                <!-- <img src="{{ asset('storage/' . $facility->icon) }}" 
                                alt="{{ $facility->title }}" 
                                class="w-12 h-12 object-contain" style="width: 48px; height: 48px;"> -->
                                <i class="fa fa-home  fa-3x text-{{ $facility->color }}"></i>
                                <span class="bg-{{ $facility->color }}"></span>
                            </div>
                            <div class="facility-text bg-{{ $facility->color }}">
                                <h3 class="text-{{ $facility->color }} mb-3">{{ $facility->title }}</h3>
                                <p class="mb-0">{{ $facility->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Facilities End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Learn More About Our Work And Our Cultural Activities</h1>
                    <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos, ipsum labore duo duo sit no sea diam. Et dolor et kasd ea. Eirmod diam at dolor est vero nonumy magna.</p>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('img/user.jpg') }}" alt="" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Jhon Doe</h6>
                                    <small>CEO & Founder</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3" src="{{ asset('img/about-1.jpg') }}" alt="">
                        </div>
                        <div class="col-6 text-start" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset('img/about-2.jpg') }}" alt="">
                        </div>
                        <div class="col-6 text-end" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset('img/about-3.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Rest of your index page content (Call To Action, Classes, Appointment, Team, Testimonial sections) -->
    <!-- ... -->
@endsection

@push('scripts')
<script>
    // Initialize carousel and other JS functionality
    $(document).ready(function(){
        $('.header-carousel').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            dots: false
        });
    });
</script>
@endpush
