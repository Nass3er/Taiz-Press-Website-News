@extends('dashboard.layout2.master')

@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('dashboard.index')}}">{{ trans('words.dashboard') }}</a> </li>
        <li class="breadcrumb-item"><a href="#">{{ trans('words.posts') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('words.edit post') }}</li>

      
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.posts.update' , $post) }}"  method="post" id="mediaForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('words.post edit') }}</strong>
                        </div>
                        <div class="card-block">
                            {{-- ///images of post --}}
                            <div class="form-group col-md-6">
                                <label>{{ trans('words.current images') }}</label>
                                @if($post->images->isEmpty())
                                    <p>No images available</p>
                                @elseif($post->images->count() === 1)
                                  @if($post->images->first()->isVideo())
                                    <video oncontextmenu="return false;" width="100%"  height="auto"  controls>
                                                    <source src="{{ asset($post->images->first()->filename ?? '') }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                    </video>
                                   
                                   @else
                                     <img src="{{ asset($post->images->first()->filename) }}" alt="" style="height: 50px">
                                   @endif
                                
                                @else
                                    @foreach($post->images as $image)
                                        @if($image->isVideo())
                                            <video  width="100%"  height="100%" controls>
                                                    <source src="{{ asset($image->filename ?? '') }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                            </video>
                                        @else
                                           <img src="{{ asset($image->filename ?? '') }}" alt="" style="height: 50px">
                                        @endif
                                    @endforeach
                                @endif
                               
                            </div>

    
                            {{-- <div class="form-group col-md-12">
                                <label>{{ trans('words.image') }}</label>
                                <input type="file" name="images[]" class="form-control"
                                    placeholder="{{ trans('words.image') }}"  multiple>
                            </div> --}}

                            <div class="form-group col-md-12">
                                <label for="media">{{ trans('words.files') }}</label>
                                <input type="file" id="mediaInput" name="images[]" accept="video/* ,image/*" class="form-control inputstyle" multiple>
                            </div>
    
                             {{-- for display thumnail created from video --}}
                            <div id="thumbnailPreview" style="display: none;"></div>

                        
                            <div class="form-group col-md-12">
                                <label>{{ trans('words.status') }}</label>
                                <select name="category_id" id="" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option  @selected($post->category_id == $category->id) value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
 

                        <div class="card">
                            <div class="card-header">
                                <strong>{{ trans('words.translations') }}</strong>
                            </div>
                            <div class="card-block">
                             
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    @foreach (config('app.languages') as $key => $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->index == 0) active @endif"
                                                id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                                aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            <br>
                                            <div class="form-group mt-3 col-md-12">
                                                <label>{{ trans('words.title') }} - {{ $lang }}</label>
                                                <input type="text" name="{{ $key }}[title]" class="form-control"
                                                    placeholder="{{ trans('words.title') }}" value="{{$post->translate($key)->title}}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.content') }}</label>
                                                <textarea name="{{ $key }}[content]" class="form-control" id="editor" cols="50" rows="10" data-lang="{{ $key }}" > {{$post->translate($key)->content}}</textarea>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.smallDesc') }}</label>
                                                <textarea name="{{ $key }}[smallDesc]" class="form-control" id="editor" cols="50" rows="10" data-lang="{{ $key }}"> {{$post->translate($key)->smallDesc}}</textarea>
                                            </div>
                                            

                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.tags') }}</label>
                                                <textarea name="{{ $key }}[tags]" class="form-control" id="" >{{$post->translate($key)->tags}}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                Submit</button>

                        </div>



                    </div>
            </form>
        </div>
    </div>
@endsection
