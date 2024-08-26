@extends('dashboard.layout2.master')

@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{trans('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{trans('words.dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">{{trans('words.categories')}}</li>

       
    </ol>

    
    <div class="container-fluid">
        @if (session('success'))
          <div class="alert alert-success alert-block delayed-alert">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>  {{ session('success') }} </strong>
          </div>
        @endif
    </div>


    {{-- {{dd($setting)}} --}}

    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{trans('words.categories')}}
                </div>
                <div class="card-block">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th>{{trans('words.categories')}}</th>
                                <th>Parent</th>
                                <th>{{trans('words.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    {{-- delete --}}
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <form action="{{ Route('dashboard.category.delete') }}" method="POST">
        <div class="modal-content">

            <div class="modal-body">
                @csrf

                <div class="form-group">
                    <p>{{ trans('words.sure delete') }}</p>
                    @csrf
                    <input type="hidden" name="id" id="id">
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('words.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('words.delete') }} </button>
            </div>
        </div>
    </form>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
{{-- delete --}}
@endsection







@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.category.all') }}",
                columns: [
                 
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'parent',
                        name: 'parent'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });

        });

        $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
@endpush
