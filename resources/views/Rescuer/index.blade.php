@extends('Rescuer.layout')

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
                            <h2>Manage <b>Rescuers</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('Rescuer.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                        </div>
                    </div>
                </div>
                <table  id="rescuer-table"  class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Rescuer ID</th>
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
                        @foreach($rescuers as $rescuer )
                            <tr>
                                <td>{{ $rescuer->id }}</td>
                                <td>{{ $rescuer->rescuer_fname. ' ' . $rescuer->Lname }}</td>
                                <td>{{ $rescuer->Age }}</td>
                                <td>{{ $rescuer->Gender }}</td>
                                <td>{{ $rescuer->Address }}</td>
                                <td>{{ $rescuer->Contact }}</td>
                                <td>
                                    @foreach($rescuer->animals as $animal)
                                     {{$animal->Name}}
                                      @endforeach
                                </td>
                            <td>
                                <form action="{{ route('Rescuer.destroy',$rescuer->id) }}" method="POST">
                                    <a href="{{ route('Rescuer.edit', $rescuer->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
                                        @csrf
                                        @method('DELETE')
                                    <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
  <script>
    $(document).ready(function(){
      $('#rescuer-table').DataTable({
        processing:true,
        serverSide:true,
        ajax: '{!! route('rescuer.getRescuer') !!}',
        columns: [
            
        { data: 'id',   name: 'id' },
        { data: 'rescuer_fname', name: 'rescuer_fname' },
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

