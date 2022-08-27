<form action="{{ route('Animal.destroy',$id) }}" method="POST">
    <a href="{{ route('Animal.edit', $id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
        @csrf
        @method('DELETE')
    <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
</form>