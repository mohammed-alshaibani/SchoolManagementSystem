@extends('./frontend/layouts.app')

@section('content')
{{-- Contact info cards (from FooterSetting if available) --}}

<!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Contact Us</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->
<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Get In Touch</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit
                        eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
<div class="row g-4 mb-5">
    
    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
            style="width: 75px; height: 75px;">
            <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
        </div>
        <h6>{{ $footer->address ?? 'Dammam, Saudi Arabia' }}</h6>
    </div>
    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
            style="width: 75px; height: 75px;">
            <i class="fa fa-envelope-open fa-2x text-primary"></i>
        </div>
        <h6>{{ $footer->email ?? 'info@example.com' }}</h6>
    </div>
    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
            style="width: 75px; height: 75px;">
            <i class="fa fa-phone-alt fa-2x text-primary"></i>
        </div>
        <h6>{{ $footer->phone ?? '+966 555 555 555' }}</h6>
    </div>
</div>


<div class="bg-light rounded">
    <div class="row g-0">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
            
            <div class="h-100 d-flex flex-column justify-content-center p-5">
                {{-- Success / errors --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf
                    {{-- Honeypot --}} <input type="text" name="website" class="d-none" tabindex="-1"
                        autocomplete="off">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="text" name="name"
                                    class="form-control border-0 @error('name') is-invalid @enderror" id="name"
                                    placeholder="Your Name" value="{{ old('name') }}" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating">
                                <input type="email" name="email"
                                    class="form-control border-0 @error('email') is-invalid @enderror" id="email"
                                    placeholder="Your Email" value="{{ old('email') }}" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" name="phone"
                                    class="form-control border-0 @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="Phone" value="{{ old('phone') }}" required>
                                <label for="phone">Phone</label>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" name="subject"
                                    class="form-control border-0 @error('subject') is-invalid @enderror" id="subject"
                                    placeholder="Subject" value="{{ old('subject') }}" required>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="message"
                                    class="form-control border-0 @error('message') is-invalid @enderror"
                                    placeholder="Leave a message here" id="message" style="height: 140px"
                                    required>{{ old('message') }}</textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
            <div class="position-relative h-100">
                {{-- Keep your map embed --}}
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6008.584165403756!2d50.09812699276878!3d26.432332835651223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49fbcbe8a353c9%3A0xbb37bee63f5fd827!2z2YXYr9in2LHYsyDYs9mF2YfYpyDYp9mE2LnYp9mE2YXZitip!5e0!3m2!1sen!2ssa!4v1756715547258!5m2!1sen!2ssa"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection