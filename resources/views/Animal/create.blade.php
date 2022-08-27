@extends('Animal.layout')
@section('content')


<style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }

    body{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #f1f3f0,#26455a);
    }

    .container{
        max-width: 700px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    }

    .container .title{
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before{
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: linear-gradient(135deg, #fdfdfd, #0b6dee);
    }

    .content form .user-details{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box{
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details{
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-details .input-box input{
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid{
        border-color: #446cdb;
    }

    form .Sex-details .Sex-title{
        font-size: 20px;
        font-weight: 500;
    }

    form .category{
        display: flex;
        width: 80%;
        margin: 14px 0 ;
        justify-content: space-between;
    }

    form .category label{
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    form .category label .dot{
        height: 18px;
        width: 18px;
        border-radius: 50%;
        margin-right: 10px;
        background: #d9d9d9;
        border: 5px solid transparent;
        transition: all 0.3s ease;
    }

    #dot-1:checked ~ .category label .one,
    #dot-2:checked ~ .category label .two,
    #dot-3:checked ~ .category label .three{
        background: #4470cf;
        border-color: #d9d9d9;
    }

    form input[type="radio"]{
        display: none;
    }
    form .button{
        height: 45px;
        margin: 35px 0
    }
    form .button input{
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #fdfdfd, #0b6dee);
    }
    form .button input:hover{
        /* transform: scale(0.99); */
        background: linear-gradient(135deg, #81afe4, #0b6dee);
    }
    @media(max-width: 584px){
        .container{
        max-width: 100%;
    }
    form .user-details .input-box{
        margin-bottom: 15px;
        width: 100%;
    }
    form .category{
        width: 100%;
    }
    .content form .user-details{
        max-height: 300px;
        overflow-y: scroll;
    }
    .user-details::-webkit-scrollbar{
        width: 5px;
    }
    }
    @media(max-width: 459px){
    .container .content .category{
        flex-direction: column;
    }
    }

    select.form-control{
        font-size: 15px;
    }


</style>



@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <div class="title">Add New Record</div>
    <div class="content">
        {!! Form::open(['route' => 'Animal.store', 'files' => true]) !!}
        @csrf
        <div class="user-details">

          <div class="input-box">
            {{ Form::label('Animal Name') }}
            {{ Form::text('Name','', ['placeholder' => 'Select Animal Name','class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Type') }}
            {{ Form::text('Type','', ['placeholder' => 'Select Animal Type','class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Breed') }}
            {{ Form::text('Breed','', ['placeholder' => 'Select Animal Breed', 'class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Age') }}
            {{ Form::text('Age','', ['placeholder' => 'Select Animal Age', 'class' => 'form-control']) }}
          </div>


          <div class="input-box">
            {{ Form::label('Upload Image Here') }}
            {{Form::file('image')}}
            @error('image')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
           @enderror
          </div>

        </div>
        <div class="gender-details">
            <input type="radio" value ="Male"  name="Sex" id="dot-1">
            <input type="radio"  value ="Female" name="Sex" id="dot-2" >
            <span class="gender-title">Gender</span>
            <div class="category">
              <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Male</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Female</span>
            </label>
            </div>
        </div>

        {{ Form::label('Injury/Disease: ') }}
        <div>
            @foreach ($InjuriesDieseases as $id => $InjuriesDiesease)
            <div class="form-check form-check-inline">
             {!! Form::checkbox('injurydisease_id[]',$id, null, array('class'=>'form-check-input','id'=>'InjuriesDiesease')) !!}
             {!!Form::label('InjuriesDiesease', $InjuriesDiesease,array('class'=>'form-check-label')) !!}
             </div>
            @endforeach
        </div>



        <div class="button">
            {{ Form::submit('Add Record',['class'=>'btn btn-primary']) }}
        </div>
        {!! Form::close() !!}
    </div>
  </div>
@endsection


