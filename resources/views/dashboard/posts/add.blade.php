@extends('dashboard.layout2.master')

@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item"> <a href="{{route('dashboard.index')}}">{{ trans('words.dashboard') }}</a> </li>
        <li class="breadcrumb-item"><a href="#">{{ trans('words.posts') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('words.add post') }}</li>

    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.posts.store') }}" method="post" id="mediaForm" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                  
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ trans('words.add post') }}</strong>
                        </div>
                        <div class="card-block">

                            {{-- <div class="form-group col-md-12">
                                <label for="media">{{ trans('words.image') }}</label>
                                <input type="file" id="media" name="images[]" accept="video/*,image/*" class="form-control inputstyle" 
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
                                <select name="category_id" id="" class="form-control inputstyle"  required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
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

                                 @if ($errors->any())
                                  <div class="alert alert-danger mt-1">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                  </div>
                                  @endif

                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            <br>
                                            <div class="form-group mt-3 col-md-12">
                                                <label>{{ trans('words.title') }} - {{ $lang }}</label>
                                                <input type="text" name="{{ $key }}[title]" class="form-control inputstyle @error('title') is-invalid @enderror " 
                                                    placeholder="{{ trans('words.title') }}"  >
                                                    @error('title')
                                                    <span class="invalid-feedback alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.content') }}</label>
                                                <textarea name="{{ $key }}[content]" class="form-control inputstyle @error('content') is-invalid @enderror" id="editor" cols="50" rows="10" data-lang="{{ $key }}" > {{ old('content') }}</textarea>
                                                @error('content')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.smallDesc') }}</label>
                                                <textarea name="{{ $key }}[smallDesc]" class="form-control" id="editor" cols="50" rows="10" dir="rtl" data-lang="{{ $key }}" ></textarea>
                                            </div> 
                                            

                                            <div class="form-group col-md-12">
                                                <label>{{ trans('words.tags') }}</label>
                                                <textarea name="{{ $key }}[tags]" class="form-control" id="" > </textarea>
                                            </div>

                                            {{-- <div class="form-group col-md-12">
                                                <label>{{ trans('words.slug') }}</label>
                                                <textarea name="{{ $key }}[slug]" class="form-control" id="" ></textarea>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-dot-circle-o"></i>
                                 {{ trans('words.submit') }}</button>

                        </div>

                    </div>
            </form>
        </div>
    </div>
@endsection
