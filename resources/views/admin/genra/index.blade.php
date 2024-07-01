@extends('admin.layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('admin.genra')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">genra</a></li>
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
                @if(auth()->user()->hasPermission('genra-delete'))
            <button disabled  type='sumbit'  data-toggle="modal" data-target="#exampleModalBDelete" class='btn btn-danger bulckDelete'>Bulck Delete <i class='fas fa-trash'></i></button>

            <div class="modal fade" id="exampleModalBDelete" tabindex="-1" genra="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" genra="document">
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
                      <form action="{{ route('admin.genra.bulckDelete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" class='buclkDeleteInput' name='buclkDelete[]'>
                        <button type="submit" class="btn btn-danger bulckDeleteEnd" >Delete <i class='fas fa-trash'></i></button>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>

                    <th> <input class='allCheckbox' type="checkbox"></th>
                    <th>id</th>
                    <th>e_id</th>
                    <th>name</th>
                    <th>create_at</th>
                    <th>update_at</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>




        <!-- Info boxes -->

      </div><!--/. container-fluid -->
    </section>


@endsection

@push('scripts')


    <script>


         $(document).on('change','.allCheckbox',function(){
           $('.record_select').prop('checked',this.checked);
           getRecordSelect();


         });

         $(document).on('change','.genra',function(){
            var allChecked = $('.genra:checked').length === $('.genra').length;
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

            if ($('.genra:checked').length >= 2) {
            $('.bulckDelete').removeAttr('disabled');
            } else {
                $('.bulckDelete').attr('disabled', 'disabled');
            }

        }

        $(document).ready( function () {
            $('#myTable').DataTable({
                // dom:'tiplr' ,
                serverSide:true,
                processing:true,
                ajax:{
                    url:"{{ route('admin.genra.data') }}"
                } ,

                columns:[
                    {data:'checkbox',checkbox:'checkbox' , searchable:false,sortable:false},
                    {data:'id',id:'id' , searchable:true},
                    {data:'e_id',e_id:'e_id' , searchable:true},
                    {data:'name',name:'name' , searchable:true},
                    {data:'created_at',created_at:'created_at' , searchable:false},
                    {data:'updated_at',updated_at:'updated_at' , searchable:false},
                    {data:'action',action:'action' , searchable:false},
                ]
            });
        } );


    </script>

@endpush
