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

        <div class='row'>
            <div class='col-md-2'>
                <a href='{{ route("admin.roles.create") }}' class='btn btn-primary'>@lang('admin.c_role') <i class='fas fa-plus'></i></a>
                 <!-- Modal -->

            </div>
            <div class='col-md-2'>

            <button disabled  type='sumbit'  data-toggle="modal" data-target="#exampleModalBDelete" class='btn btn-danger bulckDelete'>Bulck Delete <i class='fas fa-trash'></i></button>

            <div class="modal fade" id="exampleModalBDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       هل انت متأكد من الحذف ؟
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('admin.roles.bulckDelete') }}" method="POST">
                        @csrf
                        @method('post')
                        <input type="hidden" class='buclkDeleteInput' name='buclkDelete[]'>
                        <button type="submit" class="btn btn-danger bulckDeleteEnd" >Delete <i class='fas fa-trash'></i></button>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>




        <!-- Info boxes -->
        {{ $dataTable->table() }}
      </div><!--/. container-fluid -->
    </section>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>


         $(document).on('change','.allCheckbox',function(){
           $('.record_select').prop('checked',this.checked);
           getRecordSelect();


         });

         $(document).on('change','.role',function(){
            var allChecked = $('.role:checked').length === $('.role').length;
            $('.allCheckbox').prop('checked', allChecked);
            getRecordSelect();

         });

         $('.bulckDeleteEnd').on('click',function(){

            var recordsId = [] ;
            $.each($('.record_select:checked'),function(){
                 recordsId.push($(this).val());
            });

            $('.buclkDeleteInput').val(recordsId);


         })

        function getRecordSelect(){

            if ($('.role:checked').length >= 2) {
            $('.bulckDelete').removeAttr('disabled');
            } else {
                $('.bulckDelete').attr('disabled', 'disabled');
            }

        }


    </script>

@endpush
