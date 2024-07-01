@extends('admin.layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('admin.settings')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('admin.settings')</a></li>
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
          <div class="row">


            <!-- /.col -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
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

                    <div class="tab-pane" id="settings">

                      <form class="form-horizontal" action="{{ route('admin.setting.update',auth()->user()->id) }}" method='POST' enctype="multipart/form-data">
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
                            <input type="email" value='{{ $setting->email }}' class="form-control" name="email" id="inputEmail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="description" class="col-sm-2 col-form-label">@lang('admin.description')</label>
                          <div class="col-sm-10">
                            <input type="text"  value='{{ $setting->desc }}' class="form-control" name='desc' id="description" placeholder="description">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="keyword" class="col-sm-2 col-form-label">keyword</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="keyword" name='keyword' placeholder="keyword">{{ $setting->keyword }}</textarea>
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
