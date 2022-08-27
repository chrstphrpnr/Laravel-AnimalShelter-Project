@extends('Adopter.layout')

@section('content')

<style>


    .message    {
    margin-left: 250px;
    margin-bottom: 200px;
    }


    .delete {
    background-color: transparent;
    border:transparent;
    color: red;

    }


    .edit {
    background-color: transparent;
    border:transparent;
    color: rgb(255, 238, 0);

    }

    .pagination{
        background-color: transparent;
    }


</style>


<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Adopters</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('Adopter.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                    </div>
                </div>
            </div>
            <table id="adopter-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Adopter ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach($adopters as $adopter )
                        <tr>
                            <td>{{ $adopter->id }}</td>
                            <td>{{ $adopter->adopter_fname. ' ' . $adopter->Lname }}</td>
                            <td>{{ $adopter->Age }}</td>
                            <td>{{ $adopter->Gender }}</td>
                            <td>{{ $adopter->Address }}</td>
                            <td>{{ $adopter->Contact }}</td>
                            <td>
                                @foreach($adopter->animals as $animal)
                                {{$animal->Name}}
                                  @endforeach
                            </td>
                        </td>
                        <td>
                            <form action="{{ route('Adopter.destroy',$adopter->id) }}" method="POST">
                                <a href="{{ route('Adopter.edit', $adopter->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
                                    @csrf
                                    @method('DELETE')
                                <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody> --}}
            </table>
            <div class="clearfix">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                     @endif
                {{-- <ul class="pagination">
                    {{ $adopters->links()}}
                </ul> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      $('#adopter-table').DataTable({
        processing:true,
        serverSide:true,
        ajax: '{!! route('adopter.getAdopter') !!}',
        columns: [
            
        { data: 'id',   name: 'id' },
        { data: 'adopter_fname', name: 'adopter_fname' },
        { data: 'Lname',   name: 'Lname' },
        { data: 'Age', name: 'Age' },
        { data: 'Gender', name: 'Gender' },
        { data: 'Address', name: 'Address' },
        { data: 'Contact', name: 'Contact' },
        {data: 'action', name: 'action', orderable: false},
       
        ]
      });
    });

  </script>
  @endsection

