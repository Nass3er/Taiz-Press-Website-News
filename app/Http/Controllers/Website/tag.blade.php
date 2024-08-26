
 
   
  
   
   
   <div class="container1">
        <section class="news-section">
           <div class="title">
              <h2> # {{ $tag }}</h2>
             egetgerww
           </div>
           @php
                var_dump($posts);
           @endphp
           <div class="article-container">
              
              {{-- all news of category--}}
              <div class="another-news">
                 <div class="right">
                   @if (isset($posts))
                   @foreach ( $posts as $post)
                   <article class="news-card horezintel">
                      <div class="news-desc">
                        
                         <div class="desc-top">
                            <h3> 
                              <a href="{{Route('post',$post->id)}}">  {{ $post->title }} </a>
                            </h3>
                            <span class="datestyle">{{ Carbon::parse($post->created_at)->diffForHumans()}}</span>
                            <span>
                              {!! Str::limit($post->content, 150) !!}
                            </span>
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
                  @endforeach
                  @else
                    <div style="width: 100%; height:500px">
   
                    </div>
                  @endif
                
   
                   {{-- Pagination links--}}
                   <div class="container">
                       <div class="row">
                           <div class="col-12 text-center">
                              
                               <nav aria-label="Page navigation">
                                   {{$posts->links()}}
                               </nav>
                           </div>
                       </div>
                   </div>
                 
                 </div>
   
   
                  {{-- latest news --}}
                  
                 <aside class="left">
                    
                    <div id="ad-container">
                       <!-- Place your ad content here -->
                       <a href="" target="_blank">
                    
                       </a>
                     </div>
                    <div class="art-left">
                       <div class="title">
                          <h2>آخر الأخبار</h2>
                       </div>
                       <div class="article">
                          <ul>
                           @if (isset($lastFivePosts))
                           @foreach($lastFivePosts as $lastpost)
                             <li>
                                <a href="{{Route('post',$lastpost->id)}}">
                                   <div class="img-art">
                                      <img src="{{asset($lastpost->images->first()->filename)}}" alt="articlw" width="100%" height="100%">
                                   </div>
                                   <div class="detailes-art">
                                      <div>
                                        
                                         <span>
                                           {!! Str::limit($lastpost->title, 50) !!}
                                         </span>
                                      </div>
                                      
                                      
                                   </div>
                                </a>
                             </li>
                             @endforeach
                             @endif
                          </ul>
                       </div>
                    </div>
                    
                 </aside>
              </div>
           </div>
        </section>
       </div>
    