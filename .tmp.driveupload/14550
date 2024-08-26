@extends('website.layout.layout')
@section('meta_description')
        {{ strip_tags($post->content)}}
@endsection
@section('meta_keywords')
        الكلمات الدلالية
@endsection

@section('title')
{{$post->title}} - {{$setting->title}}
@endsection


@section('body')
 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="#">Home</a>
            <a class="breadcrumb-item" href="#">Category</a>
            <a class="breadcrumb-item" href="#">Technology</a>
            <span class="breadcrumb-item active">News Title</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{asset($post->image)}}" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
                        <div class="mb-3">
                            <a href="">{{$post->category->title}}</a>
                            <span class="px-1">/</span>
                            <span>{{$post->created_at->format('M d,Y')}}</span>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$post->title}}</h3>
                            <p>{!! $post->smallDesc !!}</p>
                            <p>{!! $post->content !!}</p>
                            <div class="social-btn-sp">
                                {!! $shareButtons !!}
                                  <a href="#" class="copy-link-button" data-post-url="{{ $postUrl }}">Copy Link</a>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- News Detail End --> 
            </div> 
        </div>
    </div>
</div>
</div>


{{-- for allow user copy link of post --}}
<script>
    var copyLinkButtons = document.querySelectorAll('.copy-link-button');

    copyLinkButtons.forEach(function (button) {
        var postUrl = button.getAttribute('data-post-url');

        button.addEventListener('click', function (event) {
            event.preventDefault();

            var tempInput = document.createElement('input');
            tempInput.value = postUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            alert('Link copied!');
        });
    });

</script>




    
@endsection
