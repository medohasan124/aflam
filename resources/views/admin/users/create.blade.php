@extends('admin.layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('admin.users')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">user</a></li>
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
                          <h3 class="card-title">users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p class='alert alert-danger'>{{$error}}</p>
                                @endforeach
                            @endif
                            <form  action="{{ route('admin.users.store') }}" method='POST'>
                                @csrf

                            <div class='form-group'>
                                <label for="name">@lang('admin.name')</label>
                                <input type='text' id='name' name='name' value='{{old("name",$fakeDataName) }}' class='form-control'>
                            </div>

                            <div class='form-group'>
                                <label for="email">@lang('admin.email')</label>
                                <input type='email' id='email' name='email' value='{{old("email",$fakeDataemail) }}' class='form-control'>
                            </div>
                            <div class='form-group'>
                                <label for="password">@lang('admin.password')</label>
                                <input type='password' id='password' name='password' value='{{old("password",$fakeDataPassword) }}' class='form-control'>
                            </div>
                            <div class='form-group'>
                                <label for="repreatPassword">@lang('admin.repeatPassword')</label>
                                <input type='password' id='repreatPassword' name='password_confirmation' value='{{old("repreatPassword",$fakeDataPassword) }}' class='form-control'>
                            </div>
                            <div class='form-group'>
                                <label for="roles">@lang('admin.roles')</label>
                                <select class='form-control' name='role'>

                                    @foreach ($roles as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>

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

         $(document).on('change','.user',function(){
            var allChecked = $('.user:checked').length === $('.user').length;
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
