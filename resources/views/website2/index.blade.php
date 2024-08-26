@php
use Carbon\Carbon;
@endphp

@extends('website2.layout.layout')
 
@section('body')
 <main>
    <button class="to-up">
       <svg width="25" height="25" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3.952 11.648a1.2 1.2 0 0 1 0-1.696l7.2-7.2a1.2 1.2 0 0 1 1.696 0l7.2 7.2a1.2 1.2 0 0 1-1.696 1.696L13.2 6.497V20.4a1.2 1.2 0 1 1-2.4 0V6.497l-5.152 5.151a1.2 1.2 0 0 1-1.696 0Z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <section class="landing-view">
       <div class="landing-overlay"></div>
       <div class="landing-desc">
          <h1>{{$setting->translate(app()->getlocale())->title}}</h1>
          <p>{{$setting->translate(app()->getlocale())->content}}</p>
       </div>

       <div class="ageel">
           <!-- Arabic Breaking News -->
           <div class="accelerate">
              <span>عاجل</span>
              <div class="accelerate-news">
                 <div class="scrolling-text">
                  @if($lastPost!=null)
                  {{$lastPost->translations->where('locale', 'ar')->first()->title;}}
                  @endif
                 </div>
              </div>
           </div>
        
           <!-- English Breaking News -->
           <div class="accelerate accelerate-en" dir="ltr">
              <span>Breaking news</span>
              <div class="accelerate-news">
                 <div class="scrolling-text">
                  @if($lastPost!=null)
                  {{$lastPost->translations->where('locale', 'en')->first()->title;}}
                  @endif
                 </div>
              </div>
           </div>
        </div>

            {{-- alert for link copied --}}
          <div id="alert" class="alert alert-success" role="alert">
             <span id="alert-message">{{trans('words.Link Copied!')}}</span>
          </div>

    </section>
    {{-- categories_with_posts --}}
    <div class="container1">
       {{-- local news --}}
             <section class="news-section">
               <div class="title">
                  <h2>{{ $categories_with_posts->first()->title ?? 'اخبار محليه' }}</h2>
                 
               </div>
               <div class="article-container">
                  <div class="main-news">
                    
                     <article class="news-card main-n">
                        <div class="news-desc">
                           <div class="desc-top">
                            
                              <h3>
                               <a href="{{Route('post', $categories_with_posts[0]->posts[0]->id ?? '')}}"> 
                                 {{  $categories_with_posts[0]->posts[0]->title }}
                               </a>
                              
                              </h3>
                              <div class="news-details">
                                 <span class="datestyle">{{ Carbon::parse($categories_with_posts[0]->posts[0]->created_at)->diffForHumans() }}</span>
                                 <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;color: #7a95ed;" ></i>  {{views($categories_with_posts[0]->posts[0])->count() }} </span>
                               </div>
                              <p>
                                 {!! Str::limit(strip_tags($categories_with_posts[0]->posts[0]->content ?? ''), 130)  !!}
                                {{-- {!!  $categories_with_posts[0]->posts[0]->content  !!} --}}
                              </p>
                            
                           </div>
                            
                           <div class="news-details">
                              <div class="share">
                                 <ul>
                                    <li>
                                      
                                      {!!  $categories_with_posts[0]->posts[0]->shareButtons ?? '' !!}
     
                                    </li>
                                    <li>
                                      <span ><a class="copy-link-button" data-post-url="{{  $categories_with_posts[0]->posts[0]->postUrl ?? '' }}">
                                         <i class="fa-solid fa-link"></i></a></span>
                                                            
                                    </li>
                                    
                                 </ul>
                              </div>
                              <button>
                                 <a href="{{Route('post', $categories_with_posts[0]->posts[0]->id ?? '')}}">
                                   {{trans('words.more')}}
                                 </a>
                              </button>
                              
                           </div>
                        </div>
                        <div class="news-img">
                        @if(isset( $categories_with_posts[0]->posts[0]->images))
                          @if ( $categories_with_posts[0]->posts[0]->images->count() > 0) 
                           <a href="{{Route('post', $categories_with_posts[0]->posts[0]->id ?? '')}}">
                              <img
                              src="{{asset( $categories_with_posts[0]->posts[0]->images->first()->filename ?? '') }}"
                              alt="news image"
                              width="100%"
                              height="100%"
                              />
                           </a>
                          @endif
                          @endif
                        </div>
                     </article>
                  </div>

                   <div id="alert" class="alert alert-success" role="alert">
                           <span id="alert-message">Link Copied!</span>
                  </div>
                  {{-- another local news --}}
                  <div class="another-news">
                     <div class="right">
                       @foreach ( $categories_with_posts[0]->posts as $post)
                       @if ($loop->last)
                        <article class="news-card horezintel">
                           <div class="news-desc">
                             
                              <div class="desc-top">
                                 <h3>
                                    <a href="{{Route('post',$post->id)}}">  {{ $post->title }} </a>
                                 </h3>
                                 <div class="news-details">
                                    <span class="datestyle">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                    <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;color: #7a95ed;" ></i>  {{views($post)->count() }} </span>
                                  </div>
                                 <p>
                                    {!! Str::limit(strip_tags($post->content), 100) !!}
                                
                                   
                                 </p>
                                  
                              </div>
                              <div class="news-details">
                                <div class="share">
                                   <ul>
                                      <li>
                                        
                                        {!! $post->shareButtons !!}
       
                                      </li>
                                      <li>
                                         <span ><a class="copy-link-button" data-post-url="{{ $post->postUrl }}">
                                             <i class="fa-solid fa-link"></i></a></span>
                                         
                                      </li>
                                      
                                   </ul>
                                </div>
                                <button>
                                   <a href="{{Route('post',$post->id)}}">
                                     {{trans('words.more')}}
                                   </a>
                                </button>
                             
                             </div>
                           </div>
                           <div class="news-img">
                              <a href="{{Route('post',$post->id)}}">
                                 <img
                                 src="{{asset($post->images->first()->filename)}}"
                                 alt="news image"
                                 width="100%"
                                 height="100%"
                                 />
                              </a>
                              
                           </div>
                        </article>
                        @endif
                       @endforeach
                     </div>
     
                       {{-- articles --}}
                      
                     <aside class="left">
                        
                        <div id="ad-container">
                           <!-- Place your ad content here -->
                           <a href="" target="_blank">
                        
                           </a>
                         </div>
                        <div class="art-left">
                           <div class="title">
                              <h2>  {{  $categories_with_posts[2]->title ?? 'مقالات ' }}</h2>
                           </div>
                           <div class="article">
                              <ul>
                                @foreach($categories_with_posts[2]->posts as $article)
                                 <li>
                                    <a href="{{Route('post',$article->id)}}">
                                       <div class="img-art">
                                          <img src="{{asset($article->images->first()->filename ?? '')}}" alt="articlw" width="100%" height="100%">
                                       </div>
                                       <div class="detailes-art">
                                          <div>
                                             <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                                   <path d="M481 31C445.1-4.8 386.9-4.8 351 31l-15 15L322.9 33C294.8 4.9 249.2 4.9 221.1 33L135 119c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0L255 66.9c9.4-9.4 24.6-9.4 33.9 0L302.1 80 186.3 195.7 316.3 325.7 481 161c35.9-35.9 35.9-94.1 0-129.9zM293.7 348.3L163.7 218.3 99.5 282.5c-48 48-80.8 109.2-94.1 175.8l-5 25c-1.6 7.9 .9 16 6.6 21.7s13.8 8.1 21.7 6.6l25-5c66.6-13.3 127.8-46.1 175.8-94.1l64.2-64.2z"/></svg>
                                             </span>
                                             <span>
                                              {{ $article->title}} 
                                             </span>
                                           
                                          </div>
                                           <h5>
                                             {!! Str::limit(strip_tags($post->content), 40) !!}
                                          </h5>
                                       </div>
                                    </a>
                                 </li>
                                 @endforeach
                                 
                              </ul>
                           </div>
                        </div>
                     </aside>

                    
                  </div>
               </div>
            </section>

        
          <section class="news-section">
          
           <div class="article-container">

           

               {{-- اخبار وطنية --}}
               <div class="article-container">
                  <div class="main-news">
                     <div class="title">
                        <h2>{{ $categories_with_posts[1]->title ?? ' اخبار وطنية ' }}</h2>
                      </div>
                      @if (isset($categories_with_posts[1]->posts))
                      @foreach($categories_with_posts[1]->posts as $national)
                     <article class="news-card main-n">
                        <div class="news-desc">
                           <div class="desc-top">
                            
                              <h3>
                               <a href="{{Route('post',$national->id ?? '' ) }}">
                                 {{ $national->title ?? 'no post' }}
                               </a>
                                
                              </h3>
                              <div class="news-details">
                                 <span class="datestyle">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                 <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;color: #7a95ed;" ></i>  {{views($post)->count() }} </span>
                               </div>
                              <p>
                                
                                 {!! Str::limit(strip_tags($national->content), 100) !!}
                              </p>
                            
                           </div>
                            
                           <div class="news-details">
                              <div class="share">
                                 <ul>
                                    <li>
                                      
                                      {!! $national->shareButtons ?? ' ' !!}
     
                                    </li>
                                    <li>
                                      <span ><a class="copy-link-button" data-post-url="{{ $national->postUrl?? ' ' }}"  title="{{trans('words.copy')}}">
                                         <i class="fa-solid fa-link"></i></a></span>
                                         {{-- <script>
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
                                
                                         </script>                         --}}
                                    </li>
                                    
                                 </ul>
                              </div>
                              <button>
                                 <a href="{{Route('post',$national->id ?? '' ) }}">
                                   {{trans('words.more')}}
                                 </a>
                              </button>
                              
                           </div>
                        </div>
                        <div class="news-img">
                         <a href="{{Route('post',$national->id ?? '' ) }}">
                           <img
                           src="{{asset($national->images->first()->filename ?? '') }}"
                           alt="news image"
                           width="100%"
                           height="100%"
                          />
                         </a>
                          
                        
                        </div>
                     </article>
                     @endforeach
                   @endif
                  </div>
                  
                  
               </div>

            
              {{-- اخبار دوليه --}}
             <div class="title">
               <h2>{{ $categories_with_posts[8]->title ?? 'اخبار دوليه' }}</h2>
             </div>
             <div class="top-global-news">
               @if (isset($categories_with_posts[8]->posts))
               @foreach($categories_with_posts[8]->posts as $international)
                <article class="global-article">
                   <div class="img-global">
                     <a href="{{Route('post',$international->id ?? '' ) }}">
                        <img src="{{asset($international->images->first()->filename ?? '')}}" alt="image title"
                        width="100%"
                        height="100%"
                        >
                     </a>
                     
                   </div>
                   <div class="global-details">
                      <h3>
                        <a href="{{Route('post',$international->id ?? '' ) }}">
                           {{$international->title ?? ''}}
                        </a>
                      </h3>
                      <div class="news-details">
                        <span class="datestyle">{{ Carbon::parse($international->created_at)->diffForHumans() }}</span>
                        <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;color: #7a95ed;" ></i>  {{views($international)->count() }} </span>
                      </div>
                      <div class="para">
                        
                          <p>   {!! Str::limit(strip_tags($international->content), 100) !!}</p> 
                           {{-- {!! trim($international->content) !!} --}}
 
                      </div>
                      <div class="news-details">
                         <div class="share">
                            <ul>
                               <li>
                                 {!! $international->shareButtons !!}
                               </li>
                               <li>
                                 <span ><a class="copy-link-button" data-post-url="{{ $international->postUrl }}">
                                    <i class="fa-solid fa-link"></i></a></span>
                               </li>
                            </ul>
                         </div>
                         <button>
                           <a href="{{Route('post',$international->id ?? '' ) }}">
                              {{trans('words.more')}}
                            </a>
                         </button>
                      </div>
                   </div>
                </article>
                @endforeach
                @endif
             </div>

             
 
               {{-- Her Other categories with them posts      بقية الاقسام هنا تم عرضهم بواسطة لوب --}}
             
               <div class="article-container">
                  <div class="main-news">
                      @foreach ($categories_with_posts->whereNotIn('id', [1, 2, 3, 9]) as $category)
                      <div class="title">
                          <h2>{{ $category->title ?? 'قسم اخبار' }}</h2>
                      </div>
                      @if (isset($category->posts))
                      @foreach ($category->posts as $post)
                      <article class="news-card main-n">
                          <div class="news-desc">
                              <div class="desc-top">
                                  <h3>
                                      <a href="{{Route('post',$post->id ?? '' ) }}">
                                          {{ $post->title ?? 'no post' }}
                                      </a>
                                  </h3>
                                  <div class="news-details">
                                    <span class="datestyle">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                    <span class="ml-auto">  <i class="fa-solid fa-eye fa-lg" style="font-size: 20px;color: #7a95ed;" ></i>  {{views($post)->count() }} </span>
                                  </div>
                                
                                  
                                  <p>
                                    {!! Str::limit(strip_tags($post->content), 100) !!}
                                  </p>
                              </div>
                              <div class="news-details">
                                  <div class="share">
                                      <ul>
                                          <li>
                                              {!! $post->shareButtons ?? 'no post' !!}
                                          </li>
                                          <li>
                                              <span><a class="copy-link-button" data-post-url="{{ $post->postUrl ?? ' ' }}">
                                                      <i class="fa-solid fa-link"></i></a></span>
                                          </li>
                                      </ul>
                                  </div>
                                  <button>
                                      <a href="{{Route('post',$post->id ?? '' ) }}">
                                          {{trans('words.more')}}
                                      </a>
                                  </button>
                              </div>
                          </div>
                          <div class="news-img" style="position: relative;">
                           <a href="{{ Route('post', $post->id ?? '') }}">
                               @if ($post->images->isNotEmpty() && $post->images->first()->isVideo())
                                   <img src="{{ asset($post->images->first()->thumbnail ?? '') }}" alt="thumbnail" width="100%" height="100%">
                                   <i class="fa-regular fa-circle-play" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: min(10vw, 100px); color:white;"></i>
                               @else
                                   <img src="{{ asset($post->images->first()->filename ?? '') }}" alt="news file" width="100%" height="100%" />
                               @endif
                           </a>
                       </div>
                       
                      </article>
                      @endforeach
                      @endif
                      @endforeach
                  </div>
              </div>
            
              
       </section>
       
    </div>
 </main>
@endsection

 

  
