@extends('./frontend/layouts.app')

@section('title', $post->title . ' - Samh - International School')

@section('content')
<div class="container-fluid p-0 mb-5">
    {{-- صورة الغلاف --}}
    @if($post->thumbnail)
    <div class="position-relative" style="height: 450px; overflow: hidden;">
        <img class="w-100 h-100 object-fit-cover" 
             src="{{ asset('storage/' . $post->thumbnail) }}" 
             alt="{{ $post->title }}">
        <div class="position-absolute top-0 start-0 w-100 h-100  opacity-50" ></div>
        <div class="position-absolute bottom-0 start-0 p-4 text-white">
            <h1 class="fw-bold">{{ $post->title }}</h1>
            
            {{-- الفئة --}}
            @if($post->category)
                <span class="badge bg-primary">{{ $post->category->name }}</span>
            @endif

            {{-- الكاتب + الوقت --}}
            <div class="mt-2 small">
                {{-- @foreach($post->users as $author)
                    <span class="me-2"><i class="fa fa-user"></i> {{ $author->name }}</span>
                @endforeach --}}
                <span><i class="fa fa-clock"></i> {{ $post->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- التاجات --}}
            @if(!empty($post->tags))
                <div class="mb-3">
                    @foreach($post->tags as $tag)
                        <span class="badge bg-secondary me-1">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            {{-- المحتوى --}}
            <div class="post-content mb-5" style="font-size: 1.2rem; line-height: 1.8;">
                {!! nl2br(e($post->content)) !!}
            </div>

            {{-- مشاركة على السوشيال (اختياري) --}}
            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <div>
                    <span class="fw-bold"> Share:</span>
                    <a href="#" class="text-primary ms-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-info ms-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-danger ms-2"><i class="fab fa-pinterest"></i></a>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection
