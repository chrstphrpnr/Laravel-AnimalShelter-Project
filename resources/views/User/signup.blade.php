@extends('User.layout')
@section('content')

<div class = "SignUpForm">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            
            @if (session('error'))
            <div class="alert alert-danger">
                 {{ session('error') }}
            </div>
         @endif
            <form class="SignUpForm" action="{{ route('user.signup') }}" method="post">
                @csrf
                <h1>Sign Up</h1>

                <div class="form-group">
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="age">Age: </label>
                    <input type="text" name="age" id="age" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gender">Gender: </label>
                    <input type="text" name="gender" id="gender" class="form-control">
                </div>

                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>

                <div class="form-group">
                    <label for="contact">Contact: </label>
                    <input type="text" name="contact" id="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role">Role: </label>
                    <input type="text" name="role" id="role" class="form-control">
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