<form action="{{ route('Personnel.destroy',$id) }}" method="POST">
    <a href="{{ route('personnel.status', $user_id)}}" title="status" class="status"><span class="material-icons">settings</span></a>
    <a href="{{ route('Personnel.edit', $id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
        @csrf
        @method('DELETE')
    <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
</form>



