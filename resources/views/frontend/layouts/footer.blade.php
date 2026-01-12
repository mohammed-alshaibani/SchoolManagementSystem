<!-- resources/views/partials/footer.blade.php -->
@php
    /**
     * Uses the singleton FooterSetting row.
     * If the controller/layout passes $footer, it will use that; otherwise it queries once here.
     */
    /** @var \App\Models\SiteFooterSetting|null $footer */
    $f = isset($footer) ? $footer : \App\Models\SiteFooterSetting::first();
@endphp

<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Get in Touch -->
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">{{ $f->title_contact ?? 'Get In Touch' }}</h3>
                @if(!empty($f?->address))
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $f->address }}</p>
                @endif
                @if(!empty($f?->phone))
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $f->phone }}</p>
                @endif
                @if(!empty($f?->email))
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $f->email }}</p>
                @endif
                <div class="d-flex pt-2">
                    @if(!empty($f?->twitter_url))
                        <a class="btn btn-outline-light btn-social" href="{{ $f->twitter_url }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(!empty($f?->facebook_url))
                        <a class="btn btn-outline-light btn-social" href="{{ $f->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($f?->youtube_url))
                        <a class="btn btn-outline-light btn-social" href="{{ $f->youtube_url }}"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!empty($f?->linkedin_url))
                        <a class="btn btn-outline-light btn-social" href="{{ $f->linkedin_url }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">{{ $f->title_links ?? 'Quick Links' }}</h3>
                @foreach(($f->quick_links ?? []) as $link)
                    <a class="btn btn-link text-white-50" href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a>
                @endforeach
            </div>

            <!-- Photo Gallery -->
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">{{ $f->title_gallery ?? 'Photo Gallery' }}</h3>
                <div class="row g-2 pt-2">
                    @php($gallery = $f->gallery ?? [])
                    @forelse($gallery as $img)
                        @php(
                            $src = (is_string($img) && (str_starts_with($img, 'http://') || str_starts_with($img, 'https://') || str_starts_with($img, '//'))) 
                                ? $img 
                                : \Illuminate\Support\Facades\Storage::disk('public')->url($img)
                        )
                        <div class="col-4">
                            <img class="img-fluid rounded bg-light p-1" src="{{ $src }}" alt="">
                        </div>
                    @empty
                        @for($i = 1; $i <= 6; $i++)
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{ asset("img/classes-$i.jpg") }}" alt="">
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">{{ $f->title_newsletter ?? 'Newsletter' }}</h3>
                <p>{{ $f->newsletter_text ?? 'Subscribe to our newsletter.' }}</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="email" placeholder="{{ $f->newsletter_placeholder ?? 'Your email' }}">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">{{ $f->newsletter_button ?? 'SignUp' }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{ config('app.name') }}</a>, All Right Reserved.
                    
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="#">Cookies</a>
                        <a href="#">Help</a>
                        <a href="#">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
