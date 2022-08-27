<form action="{{ route('Rescuer.destroy',$id) }}" method="POST">
    <a href="{{ route('Rescuer.edit', $id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
        @csrf
        @method('DELETE')
    <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
</form>