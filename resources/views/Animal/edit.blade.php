@extends('Animal.layout')
@section('content')


<style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    .array{
        margin-left: 50px;
        display:inline;
        text-align: middle;
        vertical-align: middle;

    }

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
        height: 50px;
        margin: 5px;
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

    img{
        margin-top: 5px;
        margin-left: 230px;
    }

    image{
        margin-left: 1px;
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
    <div class="title">Edit Record</div>
    <div class="content">
        {{ Form::model($animal,['method'=>'PATCH','route' => ['Animal.update', $animals->id], 'files' => true]) }}
        @method('PATCH')

        <div class="user-details">
            <img src="{{ Storage::url($animals->image) }}" height="100" width="100" alt="" />
          <div class="input-box">
            {{ Form::label('Animal Name') }}
            {{ Form::text('Name', $animals->Name, ['class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Type') }}
            {{ Form::text('Type', $animals->Type, ['class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Breed') }}
            {{ Form::text('Breed', $animals->Breed, ['class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Animal Age') }}
            {{ Form::text('Age', $animals->Age, ['class' => 'form-control']) }}
          </div>

          {{-- <div class="input-box">
            {{ Form::label('Rescuer Name') }}
            {{ Form::select('RescuerId',$rescuers, $animals->RescuerId,['class' => 'form-control']) }}
          </div>

          <div class="input-box">
            {{ Form::label('Rescued Date') }}
            {{ Form::date('RescuedDate',$animals->RescuedDate, ['class' => 'form-control']) }}
          </div>--}}
{{--
          <div class="input-box">
            {{ Form::label('Health Status') }}
            {{ Form::text('HealthStatus',$animals->HealthStatus, ['class' => 'form-control']) }}
        </div>

        <div class="input-box">
            {{ Form::label('Adaptation Status') }}
            {{ Form::text('AdaptionStatus',$animals->AdaptionStatus, ['class' => 'form-control']) }}
          </div> --}}

        <div class="input-box">
            {{ Form::label('Upload Image Here') }}
            {{-- {{Form::file('image',null,array('class'=>'form-control', 'id' => 'image'))}} --}}
            <input type="file" class="form-control" id="image" name="image" value="image">
        </div>

        </div>

    <div class="gender-details">
        <span class="gender-title">Gender</span>

        @if($animals->Sex == 'Male')
        <input type="radio" value ="Male"  name="Sex" id="dot-1" checked>
        <input type="radio"  value ="Female" name="Sex" id="dot-2">
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

        @else
            <input type="radio" value ="Male"  name="Sex" id="dot-1" >
            <input type="radio"  value ="Female" name="Sex" id="dot-2" checked>
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
        @endif
    </div>

        {{ Form::label('Injury/Disease: ') }}
        @foreach ($injurydieases as $injurydisease_id => $injurydiease)
        <div class="array">
        @if(in_array($injurydisease_id, $animalinjuries))
        {!! Form::checkbox('injurydisease_id[]',$injurydisease_id, true, array('class'=>'form-check-input','id'=>'injurydiease')) !!}
        {!! Form::label('injurydiease', $injurydiease, array('class'=>'form-check-label')) !!}
        @else
        {!! Form::checkbox('injurydisease_id[]',$injurydisease_id, null, array('class'=>'form-check-input','id'=>'injurydiease')) !!}
        {!!Form::label('injurydiease', $injurydiease, array('class'=>'form-check-label')) !!}
        @endif
        </div>
        @endforeach

    <div class="button">
        {{ Form::submit('Edit Record',['class'=>'btn btn-primary']) }}
    </div>

        {!! Form::close() !!}
      </form>
    </div>
  </div>
@endsection


