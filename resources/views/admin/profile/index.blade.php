@extends('admin.layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('admin.profile')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('admin.profile')</a></li>
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
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        @if($profile->image)
                            src="{{ Storage::url('uploads/'.$profile->image.'') }}"
                        @else
                            src="{{ asset('images/default.jfif') }}"
                        @endif

                             alt="User profile picture">
                      </div>

                      <h3 class="profile-username text-center">{{ $profile->name }}</h3>

                      <p class="text-muted text-center">{{ $profile->email }}</p>

                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                          <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                          <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                      </ul>


                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->


              <!-- /.row -->

          <div class="row">


            <!-- /.col -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#profiles" data-toggle="tab">profiles</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class='alert alert-danger'>{{$error}}</p>
                    @endforeach
                @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                    <div class="tab-pane" id="profiles">

                      <form class="form-horizontal" action="{{ route('admin.profile.update',auth()->user()->id) }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                          <label for="photo" class="col-sm-2 col-form-label">photo</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" name='image' id="photo" placeholder="photo">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">@lang('admin.email')</label>
                          <div class="col-sm-10">
                            <input type="email" value='{{ $profile->email }}' class="form-control" name="email" id="inputEmail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">@lang('admin.name')</label>
                          <div class="col-sm-10">
                            <input type="text"  value='{{ $profile->name }}' class="form-control" name='name' id="name" placeholder="name">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class=' fas fa-edit'></i> @lang('admin.update')</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->


@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>


    </script>

@endpush
