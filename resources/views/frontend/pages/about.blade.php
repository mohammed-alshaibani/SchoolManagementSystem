<?php
// resources/views/frontend/about.blade.php (enhanced)
?>
@extends('./frontend/layouts.app')

@php
    /** @var \App\Models\AboutPage $page */
    /** @var \App\Models\AboutSetting|null $about */
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

    $hero = $page->hero_image
        ? Storage::disk('public')->url($page->hero_image)
        : asset('img/hero-about.jpg');
@endphp

@section('title', ($page->meta_title ?: ($page->title . ' - ' . config('app.name'))))
@section('meta_description', $page->meta_description)

@push('styles')
<style>
    /* why: subtle polish without editing global theme */
    .hero-wrap { height: 420px; }
    .hero-img { object-fit: cover; filter: saturate(1.02) contrast(1.02); }
    .hero-overlay { background: linear-gradient(180deg, rgba(0,0,0,.35), rgba(0,0,0,.65)); }
    .glass-card { backdrop-filter: blur(6px); background: rgba(255,255,255,0.85); }
    .soft-card { border: 0; border-radius: 1rem; box-shadow: 0 10px 30px rgba(16,24,40,.08); }
    .soft-card:hover { transform: translateY(-4px); box-shadow: 0 16px 42px rgba(16,24,40,.12); transition: .2s; }
    .icon-badge { width: 56px; height: 56px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; }
    .icon-grad-1 { background: linear-gradient(135deg, #5b8def, #7bdaff); color: #fff; }
    .icon-grad-2 { background: linear-gradient(135deg, #ff8f70, #ff3d54); color: #fff; }
    .icon-grad-3 { background: linear-gradient(135deg, #5dd39e, #348f50); color: #fff; }
    .section-heading .underline { width: 64px; height: 4px; border-radius: 4px; background: currentColor; opacity: .3; margin: .5rem auto 0; }
    .prose p { line-height: 1.8; font-size: 1.05rem; }
</style>
@endpush

@section('content')
    <div class="container-fluid p-0 mb-5">
        <div class="position-relative hero-wrap">
            <img src="{{ $hero }}" alt="{{ $page->title }}" class="w-100 h-100 hero-img">
            <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay"></div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3 wow fadeInUp" data-wow-delay=".1s">
                <span class="badge bg-light text-dark rounded-pill px-3 py-2 mb-3">About</span>
                <h1 class="display-5 text-white mb-2">{{ $page->title }}</h1>
                @if($page->subtitle)
                    <p class="lead mb-0 text-white">{{ $page->subtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <article class="prose mx-auto wow fadeInUp" data-wow-delay=".1s">
                    {!! Str::markdown($page->body) !!}
                </article>

                @if($page->contact_email || $page->phone)
                    <div class="row g-3 align-items-center mt-5 wow fadeInUp" data-wow-delay=".15s">
                        @if($page->contact_email)
                            <div class="col-md-auto">
                                <div class="d-inline-flex align-items-center gap-2 glass-card rounded-3 px-3 py-2">
                                    <span class="icon-badge icon-grad-1"><i class="fa fa-envelope"></i></span>
                                    <div>
                                        <div class="small text-muted">Email</div>
                                        <a href="mailto:{{ $page->contact_email }}" class="fw-semibold">{{ $page->contact_email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($page->phone)
                            <div class="col-md-auto">
                                <div class="d-inline-flex align-items-center gap-2 glass-card rounded-3 px-3 py-2">
                                    <span class="icon-badge icon-grad-3"><i class="fa fa-phone"></i></span>
                                    <div>
                                        <div class="small text-muted">Phone</div>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $page->phone) }}" class="fw-semibold">{{ $page->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if(isset($about) && $about)
            <hr class="my-5">
            <div class="row g-4 wow fadeInUp" data-wow-delay=".1s">
                <div class="col-lg-6">
                    <div class="card soft-card h-100">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="icon-badge icon-grad-1"><i class="fa fa-bullseye"></i></span>
                                <h2 class="h3 mb-0">{{ $about->mission_title ?? 'Our Mission' }}</h2>
                            </div>
                            <div class="text-muted">{!! Str::markdown($about->mission_body ?? '') !!}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card soft-card h-100">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="icon-badge icon-grad-2"><i class="fa fa-eye"></i></span>
                                <h2 class="h3 mb-0">{{ $about->vision_title ?? 'Our Vision' }}</h2>
                            </div>
                            <div class="text-muted">{!! Str::markdown($about->vision_body ?? '') !!}</div>
                        </div>
                    </div>
                </div>
            </div>

            @php($goals = $about->strategic_goals ?? [])
            @if(!empty($goals))
                <div class="text-center mx-auto mt-5 mb-4 section-heading wow fadeInUp" data-wow-delay=".1s" style="max-width: 720px;">
                    <h2 class="h3 mb-2">{{ $about->goals_title ?? 'Strategic Goals' }}</h2>
                    <p class="text-muted">Our objectives that guide us forward.</p>
                    <div class="underline"></div>
                </div>
                <div class="row g-4">
                    @foreach($goals as $i => $goal)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 + ($i % 3) * 0.1 }}s">
                            <div class="card soft-card h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start gap-3 mb-2">
                                        <span class="icon-badge icon-grad-3"><i class="{{ $goal['icon'] ?? 'fa fa-flag' }}"></i></span>
                                        <div>
                                            <div class="text-muted small">Goal {{ $i + 1 }}</div>
                                            <h3 class="h5 mb-1">{{ $goal['title'] ?? '' }}</h3>
                                        </div>
                                    </div>
                                    @if(!empty($goal['description']))
                                        <p class="text-muted mb-0">{{ $goal['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @php($features = $about->unique_features ?? [])
            @if(!empty($features))
                <div class="text-center mx-auto mt-5 mb-4 section-heading wow fadeInUp" data-wow-delay=".1s" style="max-width: 720px;">
                    <h2 class="h3 mb-2">{{ $about->features_title ?? 'Unique Features' }}</h2>
                    <p class="text-muted">What makes us stand out.</p>
                    <div class="underline"></div>
                </div>
                <div class="row g-4">
                    @foreach($features as $i => $feature)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 + ($i % 3) * 0.1 }}s">
                            <div class="card soft-card h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start gap-3 mb-2">
                                        <span class="icon-badge icon-grad-1"><i class="{{ $feature['icon'] ?? 'fa fa-sparkles' }}"></i></span>
                                        <h3 class="h5 mb-0">{{ $feature['title'] ?? '' }}</h3>
                                    </div>
                                    @if(!empty($feature['description']))
                                        <p class="text-muted mb-0">{{ $feature['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
