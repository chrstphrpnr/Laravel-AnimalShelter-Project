@extends('InjuryDisease.layout')


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

    table.table tr , table.table tr td {
  border-color: #e9e9e9;
  padding: 20px 150px;
  vertical-align: middle;

  
}

</style>


<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Injury & Diseases</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="{{ route('InjuryDisease.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Create New Record</span></a>
					</div>
				</div>
			</div>
            <table id="injury-table" class="table table-bordered table-responsive table-striped" style="text-align:center">
				<thead>
					<tr>
                        <th>Injury Diseases Id</th>
                        <th>Injury Diseases Name</th>
                        <th>Action</th>
					</tr>
				</thead>
				{{-- <tbody>
                    @foreach($injurydiseases as $injurydisease )
                    	<tr>
                            <td>{{ $injurydisease->id }}</td>
                            <td>{{ $injurydisease->health_problem }}</td>
						<td>
							<form action="{{ route('InjuryDisease.destroy',$injurydisease->id) }}" method="POST">
                                <a href="{{ route('InjuryDisease.edit', $injurydisease->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
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
				<ul class="pagination">
                    {{ $injurydiseases->links()}}
				</ul>
			</div> --}}
		</div>
	</div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      $('#injury-table').DataTable({
        processing:true,
        serverSide:true,
        ajax: '{!! route('injury.getInjury') !!}',
        columns: [
        
         { data: 'id', name: 'id' },
        { data: 'health_problem', name: 'health_problem' },
        {data: 'action', name: 'action', orderable: false},
       
        ]
      });
    });

  </script>
  @endsection

  


  
