@extends('contacts.layout')


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
						<h2>Manage <b>Mails</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mail</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
                    @foreach($message as $messages )
                    	<tr>
                            <td>{{ $messages->name }}</td>
                            <td>{{ $messages->email }}</td>
                            <td>{{ $messages->message }}</td>
						<td>
							<form action="{{ route('Contact.destroy',$messages->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>

                            </form>

						</td>
					</tr>
                    @endforeach
				</tbody>
			</table>
			<div class="clearfix">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                     @endif
				{{-- <ul class="pagination">
                    {{ $injurydiseases->links()}}
				</ul> --}}
			</div>
		</div>
	</div>
</div>
@endsection

