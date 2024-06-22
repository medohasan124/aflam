
<div>
    @if(auth()->user()->hasPermission('user-update'))

    {{-- @permission('users_read') --}}
    <label>
      <a href='{{ route("admin.users.edit",$id) }}' class='btn btn-primary'>@lang('admin.edit') <i class='fas fa-edit'></i></a>

    </label>
    @endif
    @if (auth()->user()->hasPermission('user-delete'))

    {{-- @endpermission --}}
    <label>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $id }}">
            Delete <i class='fas fa-trash'></i>
        </button>
    </label>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" user="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" user="document">
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

           <form action="{{ route('admin.users.destroy', $id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button  class='btn btn-danger'>@lang('admin.delete') <i class='fas fa-trash'></i></button>
            </form>
        </div>
      </div>
    </div>
  </div>

  @endif
</div>
