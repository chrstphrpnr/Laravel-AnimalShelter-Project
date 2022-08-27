@extends('Adopter.layoutprofile')

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

    form .Gender-details .Gender-title{
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
        {!! Form::model($adopter,['method'=>'POST','route' => ['adopter.update', $adopter->id]]) !!}
        @csrf

        <div class="user-details">

            <div class="input-box">
                {{ Form::label('First Name') }}
                {{ Form::text('adopter_fname', $adopter->adopter_fname, ['class' => 'form-control']) }}
            </div>


            <div class="input-box">
                {{ Form::label('Last Name') }}
                {{ Form::text('Lname', $adopter->Lname, ['class' => 'form-control']) }}
            </div>

            <div class="input-box">
                {{ Form::label('Age') }}
                {{ Form::text('Age', $adopter->Age, ['class' => 'form-control']) }}
            </div>


            <div class="input-box">
                {{ Form::label('Address') }}
                {{ Form::text('Address', $adopter->Address, ['class' => 'form-control']) }}
            </div>

            <div class="input-box">
                {{ Form::label('Contact') }}
                {{ Form::text('Contact', $adopter->Contact, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="Gender-details">
            <span class="Gender-title">Gender</span>
            @if($adopter->Gender == 'Male')
                <input type="radio" value ="Male"  name="Gender" id="dot-1"checked>
                <input type="radio"  value ="Female" name="Gender" id="dot-2">

                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="Gender">Male</span>
                             </label>

                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="Gender">Female</span>
                            </label>
                        </div>
            @else
                <input type="radio" value ="Male"  name="Gender" id="dot-1">
                <input type="radio"  value ="Female" name="Gender" id="dot-2"checked>

                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="Gender">Male</span>
                         </label>

                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="Gender">Female</span>
                        </label>
                    </div>
                    @endif
        </div>

    

            <div class="button">
                {{ Form::submit('Edit Record',['class'=>'btn btn-primary']) }}
            </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection


