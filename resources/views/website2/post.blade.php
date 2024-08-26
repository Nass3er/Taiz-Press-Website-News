@php
use Carbon\Carbon;
@endphp

@extends('website2.layout.layout')
@section('styles')
        <link rel="stylesheet" href="{{asset('front2')}}/css/news.css" />  
@endsection


@section('body')
<main>

     {{-- alert for link copied --}}
     <div id="alert" class="alert alert-success" role="alert">
      <span id="alert-message">{{trans('words.Link Copied!')}}</span>
   </div>

    <button class="to-up">
       <svg width="25" height="25" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3.952 11.648a1.2 1.2 0 0 1 0-1.696l7.2-7.2a1.2 1.2 0 0 1 1.696 0l7.2 7.2a1.2 1.2 0 0 1-1.696 1.696L13.2 6.497V20.4a1.2 1.2 0 1 1-2.4 0V6.497l-5.152 5.151a1.2 1.2 0 0 1-1.696 0Z" clip-rule="evenodd"></path>
        </svg>
    </button>  
    <div class="container1 main-cont">
    <article class="article-news">
       <div class="title">

          <h2> {{$post->category->title ?? 'no category'}}  </h2>
       </div>
       <div class="the-news">
          <div class="new-title">
             <h3> {{$post->title ?? 'no title'}} </h3>
          </div>

          <div class="img-news">
            
              @if ($post->images->isNotEmpty() && $post->images->first()->isVideo())
          <video width="100%" height="100%" controls>
              <source src="{{ asset($post->images->first()->filename ?? '') }}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
      @else
          <img src="{{ asset($post->images->first()->filename ?? '') }}" alt="news file" width="100%" height="100%" />
      @endif
  
          </div>

          <div class="social">
             <div class="date">
              
                <span class="datestyle">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                 
             </div>
            
             <div class="share">
                <ul>
                  <li>
                                      
                     {!! $shareButtons ?? 'no post' !!}

                   </li>
                   <li>
                     <span ><a class="copy-link-button" data-post-url="{{ $postUrl?? ' ' }}"  title="{{trans('words.copy')}}">
                        <i class="fa-solid fa-link"></i></a></span>
                               
                   </li>
                </ul>
             </div>
          </div>
          {{-- عدد المشاهدات --}}
          {{-- <span class="mb-2">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;" ></i>  {{views($post)->count() }} </span> --}}
          <div class="text-news">
             <span>
               {!! $post->content !!}
             </span>
             

             <div class="other-images">
               @php
               $images = $post->images->slice(1); // Get all images except the first
               @endphp

               @foreach ($images as $image)
                  <img src="{{ asset($image->filename) }}" alt="{{ $post->title ?? 'no title' }}" width="30%">
               @endforeach
             </div>
             <span>
               {!!$post->smallDesc!!}
             </span>
          </div>

      @php
          $tags = explode(' ', $post->tags);  // Explode the tags string into an array
      @endphp
       <span>{{trans('words.tags')}} : </span>
       @foreach ($tags as $tag)
       <a href="{{ route('posts.byTag', $tag) }}" class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
           # {{ $tag }}
       </a>
      @endforeach
    
      
       </div>
    </article>

    {{-- latest news --}}
    <aside>
       <div class="title">
          <h2> {{trans('words.latest news')}}</h2>
       </div>
       <div class="last-news">
         @foreach($lastFivePosts as $lastpost)
          <div class="news-l">
            <a href="{{Route('post',$lastpost->id)}}">
             <div class="img-n" style="position: relative;">
              @if ($lastpost->images->isNotEmpty() && $lastpost->images->first()->isVideo())
              <img src="{{ asset($lastpost->images->first()->thumbnail ?? '') }}" alt="thumbnail" width="100%" height="100%">
              <i class="fa-regular fa-circle-play" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: min(10vw, 100px); color:white;"></i>
             @else
              <img src="{{ asset($lastpost->images->first()->filename ?? '') }}" alt="news file" width="100%" height="100%" />
             @endif
                
             </div>
            </a>
             <a href="{{Route('post',$lastpost->id)}}" class="desc-n">
                <h4>
                  {{$lastpost->title}}
                </h4>
             </a>
          </div>
          @endforeach
         
       </div>
    </aside>
    </div>
</main>

{{-- اخبار متعلقه بالبوست  --}}
<div class="container1 ">
  
 <div class="title">
   <h2>  {{trans('words.related posts')}} </h2>
 </div>

 <div class="top-global-news">
   @if (isset($relatedPosts))
     @foreach($relatedPosts as $relatedpost)
       @if ($relatedpost->id !== $post->id)
         <article class="global-article">
           <div class="img-global" style="position: relative;">
            <a href="{{ Route('post', $post->id ?? '') }}">
              @if ($relatedpost->images->isNotEmpty() && $relatedpost->images->first()->isVideo())
                  <img src="{{ asset($relatedpost->images->first()->thumbnail ?? '') }}" alt="thumbnail" width="100%" height="100%">
                  <i class="fa-regular fa-circle-play" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: min(10vw, 100px); color:white;"></i>
              @else
                  <img src="{{ asset($relatedpost->images->first()->filename ?? '') }}" alt="news file" width="100%" height="100%" />
              @endif
          </a>
           </div>
           <div class="global-details">
             <h3>{{ $relatedpost->title ?? '' }}</h3>
             <div class="news-details">
              <span class="datestyle">{{ Carbon::parse($relatedpost->created_at)->diffForHumans() }}</span>
              <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px; color: #7a95ed;" ></i>  {{views($relatedpost)->count() }} </span>
            </div>
             <div class="para">
               {{-- <span>{!!  $relatedpost->content   !!}</span>  --}}
                {!! Str::limit(strip_tags($relatedpost->content), 100) !!}
             </div>
             <div class="news-details">
               <div class="share">
                 <ul>
                   <li>{!! $relatedpost->shareButtons !!}</li>
                   <li>
                     <span>
                       <a class="copy-link-button" data-post-url="{{ $relatedpost->postUrl }}">
                         <i class="fa-solid fa-link"></i>
                       </a>
                     </span>
                   </li>
                 </ul>
               </div>
               <button>
                 <a href="{{ Route('post', $relatedpost->id ?? '') }}">
                   {{ trans('words.more') }}
                 </a>
               </button>
             </div>
           </div>
         </article>
       @endif
     @endforeach
   @endif
 </div>
</div>
@endsection

{{-- <video tabindex="-1" class="video-stream html5-main-video" webkit-playsinline="" playsinline="" controlslist="nodownload" style="width: 622px; height: 350px; left: 0px; top: 0px;" 
src="blob:https://www.youtube.com/a98e7460-226f-4208-9646-c882f726be32"></video> --}}