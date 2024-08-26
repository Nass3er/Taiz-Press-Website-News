@extends('dashboard.layout2.master')

@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('dashboard.index')}}">{{ trans('words.dashboard') }}</a> </li>
        <li class="breadcrumb-item"><a href="#">{{ trans('words.users') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ trans('words.add user') }}</li>

      
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.users.store') }}" method="post">
                @csrf
                @method('POST')
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
                            <strong>{{ trans('words.users') }}</strong>
                        </div>
                        <div class="card-block">




                            <div class="form-group col-md-12">
                                <label>{{ trans('words.name') }}</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ trans('words.name') }}"
                                   >
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ trans('words.email') }}</label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="{{ trans('words.email') }}" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ trans('words.status') }}</label>
                                <select name="status" id="" class="form-control">
                                  
                                    <option value="admin">Admin</option>
                                    <option value="writer" >Writer</option>
                                    <option value="">غير مفعل </option>
                                </select>
                               
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>{{ trans('words.password') }}</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="{{ trans('words.password') }}" >
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
