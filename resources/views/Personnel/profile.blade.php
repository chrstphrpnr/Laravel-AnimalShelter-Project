@extends('Personnel.layoutprofile')

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
                            <h2>Personnel <b>Profile</b></h2>
                        </div>
                        {{-- <div class="col-sm-6">
                            <a href="{{ route('Rescuer.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                        </div> --}}
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Personnel Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $personnel->id }}</td>
                                <td>{{ $personnel->personnel_fname. ' ' . $personnel->Lname }}</td>
                                <td>{{ $personnel->Gender }}</td>
                                <td>{{ $personnel->Role }}</td>
                                <td>{{ $personnel->status }}</td>
                                <td>{{ $personnel->Email }}</td>
                            <td>
                            <a href="{{ route('personnel.editprofile', $personnel->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                <div class="clearfix">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                         @endif
                    {{-- <ul class="pagination">
                        {{ $rescuers->links()}}
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Animal <b>Taken Care</b></h2>
                        </div>
                        {{-- <div class="col-sm-6">
                            <a href="{{ route('Rescuer.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                        </div> --}}
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Animal ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Type</th>
                        <th scope="col">Breed</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Age</th>
                        <th scope="col">Injuries</th>
                        <th scope="col">Health Status</th>
                        <th scope="col">Adaptation Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personnel->animals as $animal)
                        <tr>
                            <td>{{ $animal->id }}</td>
                            <td>{{ $animal->Name }}</td>
                            <td><img src="{{ Storage::url($animal->image) }}" height="75" width="75" alt="" /></td>
                            <td>{{ $animal->Type }}</td>
                            <td>{{ $animal->Breed }}</td>
                            <td>{{ $animal->Sex }}</td>
                            <td>{{ $animal->Age }}</td>
                            <td>
                                @foreach($animal->injuryDisease as $disease)
                                 {{-- @if($animal->id == $disease->animal_id) --}}
                                 {{$disease->health_problem}}
                                 {{-- <br>
                                 @endif --}}
                                  @endforeach
                            </td>
                            <td>{{ $animal->HealthStatus }}</td>
                            <td>{{ $animal->AdaptionStatus }}</td>
                            <td>

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <form action="{{route('logout') }}" method = "POST">
                    @csrf
                    @method('POST')
                    <button> <a>LOGOUT</a></button>
            </form>
            </div>
        </div>
    </div>
@endsection

