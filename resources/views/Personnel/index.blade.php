@extends('Personnel.layout')

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
                        <h2>Manage <b>Personnels</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('Personnel.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                    </div>
                </div>
            </div>
            <table id="table-personnel"class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Personnel Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        
                      
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach($personnels as $personnel )
                        <tr>
                            <td>{{ $personnel->id }}</td>
                            <td>{{ $personnel->personnel_fname. ' ' . $personnel->Lname }}</td>
                            <td>{{ $personnel->Gender }}</td>
                            <td>{{ $personnel->Role }}</td>
                            <td>{{ $personnel->Email }}</td>
                        <td>
                            <form action="{{ route('Personnel.destroy',$personnel->id) }}" method="POST">
                                <a href="{{ route('Personnel.edit', $personnel->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
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
                    {{ $personnels->links()}}
                </ul> --}}
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
  <script>
    $(document).ready(function(){
      $('#table-personnel').DataTable({
        processing:true,
        serverSide:true,
        ajax: '{!! route('personnel.getPersonnel') !!}',
        columns: [
        
         { data: 'id', name: 'id' },
         { data: 'personnel_fname', name: 'personnel_fname' },
        { data: 'Lname',   name: 'Lname' },
        { data: 'Gender', name: 'Gender' },
        { data: 'Role', name: 'Role' },
        { data: 'Email', name: 'Email' },
        {data: 'action', name: 'action', orderable: false},
       
        ]
      });
    });

  </script>

  
  @endsection



