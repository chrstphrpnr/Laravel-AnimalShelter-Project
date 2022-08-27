@extends('User.layout')
@section('content')
<style>
    .Login{
  margin-top: 50px;
}
</style>

    <div class = "SignUpForm">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if (session('error'))
   <div class="alert alert-danger">
        {{ session('error') }}
   </div>
@endif
            <form class="Login" action="{{ route('user.signin') }}" method="post">
                @csrf
                <h1>Login</h1>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                    <input type="submit"  class="btn btn-primary">
             </form>
        </div>
    </div>
</div>
@endsection   