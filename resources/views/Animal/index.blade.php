@extends('Animal.layout')

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
                        <h2>Manage <b>Animals</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('Animal.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
                    </div>
                </div>
            </div>
            <table id="animal-table" class="table table-striped table-hover">
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
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach($animals as $animal)
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
                                 {{-- {{$disease->health_problem}} --}}
                                 {{-- <br>
                                 @endif --}}
                                  {{-- @endforeach --}}
                            {{-- </td>
                            <td>{{ $animal->HealthStatus }}</td>
                            <td>{{ $animal->AdaptionStatus }}</td>
                            <td>
                            <form action="{{ route('Animal.destroy',$animal->id) }}" method="POST">
                                <a href="{{ route('Animal.edit', $animal->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
                                    @csrf
                                    @method('DELETE')
                                <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody> --}} 
            </table>
            {{-- <div class="clearfix">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                     @endif
                {{-- <ul class="pagination">
                    {{ $animals->links()}}
                </ul> --}}
            {{-- </div> --}} 


            @auth
       <form action="{{route('logout') }}" method = "POST">
                @csrf
                @method('POST')
                <button> <a>LOGOUT</a></button>
        </form>
    @endauth
        </div>
        {{-- {{ $animals->links()}} --}}
    </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      $('#animal-table').DataTable({
        processing:true,
        serverSide:true,
        ajax: '{!! route('animal.getAnimal') !!}',
        columns: [
            
        { data: 'id',   name: 'id' },
        { data: 'Name', name: 'Name' },
        { data: 'image',name: 'image', render: function(data, type, full, meta)
        { return "<img src={{ URL::to('/storage') }}/Images/" + data + " width='70' class='img-thumbnail' />";},orderable: false},
        { data: 'Type', name: 'Type' },
        { data: 'Breed', name: 'Breed' },
        { data: 'Sex', name: 'Sex' },
        { data: 'Age', name: 'Age' },
        { data: 'health_problem', name: 'health_problem' },
        { data: 'HealthStatus', name: 'HealthStatus' },
        { data: 'AdaptionStatus', name: 'AdaptionStatus' },
        {data: 'action', name: 'action', orderable: false},
       
        ]
      });
    });

  </script>
  @endsection


