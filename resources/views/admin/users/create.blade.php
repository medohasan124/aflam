@extends('admin.layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('admin.roles')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Role</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

                    <!-- general form elements disabled -->
                    <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title">Roles</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p class='alert alert-danger'>{{$error}}</p>
                                @endforeach
                            @endif
                            <form  action="{{ route('admin.roles.store') }}" method='POST'>
                                @csrf
                            <label for="name">@lang('admin.name')</label>
                            <input type='text' id='name' name='name' value='{{old("name",$fakeData) }}' class='form-control'>
                            <div class="row">
                              <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group ">


                                    <label >@lang('admin.permission')</label>
                                  <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input allCheckbox"  id="customCheckbox1" type="checkbox" >
                                    <label for="customCheckbox1" class="custom-control-label">@lang('admin.all')</label>
                                  </div>


                                  <?php

                                    $roles = ['create' ,'read','update','delete'];

                                    ?>

                                    @foreach ($roles as $index => $role)
                                        <div class="custom-control custom-checkbox ">
                                            <input class="custom-control-input record_select role" id="customCheckbox{{ $role}}" name='role[]'  value='{{ $role}}' type="checkbox">
                                            <label for="customCheckbox{{ $role }}" class="custom-control-label">@lang('admin.'.$role)</label>
                                      </div>
                                    @endforeach

                                </div>
                              </div>

                            </div>
                            <button class='btn btn-primary'>SAVE</button>
                          </form>
                        </div>
                    </div>
      <!--/. container-fluid -->
    </section>


@endsection



@push('scripts')
    <script>



         $(document).on('change','.allCheckbox',function(){
           $('.record_select').prop('checked',this.checked);
        //    getRecordSelect();
         });

         $(document).on('change','.role',function(){
            var allChecked = $('.role:checked').length === $('.role').length;
            $('.allCheckbox').prop('checked', allChecked);

         });

        //   function getRecordSelect(){
        //      var recordsId = [] ;
        //      $.each($('.record_select:checked'),function(){
        //           recordsId.push(this.val());
        //      })
        //  }


    </script>

@endpush
