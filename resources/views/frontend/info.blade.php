@extends('frontend.layout')
@section('content')





<style>

    .navbar-nav {
        margin-right: 1000px;
    }
    .wrapper{
    position: absolute;
    top: 50%;
    left: 53%;
    transform: translate(-50%,-50%);
    width: 1500px;
    height: 700px;
    display: flex;

    }

    .wrapper .left{
    width: 35%;
    background: linear-gradient(to right,#01a9ac,#01dbdf);
    padding: 30px 25px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    text-align: center;
    color: #fff;
    }

    .wrapper .left img{
    border-radius: 5px;
    margin-left: 50px;
    margin-top: 200px;s
    margin-bottom: 10px;
    }

    .wrapper .left h4{
    margin-top: 10px;
    margin-left: 50px;
    }

    .wrapper .left p{
    font-size: 12px;
    }

    .wrapper .right{
    width: 500px;
    background: #fff;
    padding: 50px 25px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    }

    .wrapper .right .info,
    .wrapper .right .projects{
    margin-bottom: 25px;
    }

    .wrapper .right .info h3,
    .wrapper .right .projects h3{
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #e0e0e0;
        color: #353c4e;
    text-transform: uppercase;
    letter-spacing: 5px;
    }

    .wrapper .right .info_data,
    .wrapper .right .projects_data{
    display: flex;
    justify-content: space-between;
    }

    .wrapper .right .info_data .data,
    .wrapper .right .projects_data .data{
    width: 45%;
    }

    .wrapper .right .info_data .data h4,
    .wrapper .right .projects_data .data h4{
        color: #353c4e;
        margin-bottom: 5px;
    }

    .wrapper .right .info_data .data p,
    .wrapper .right .projects_data .data p{
    font-size: 13px;
    margin-bottom: 10px;
    color: #919aa3;
    }

</style>



<div class="wrapper">
    <div class="right">
       
        <img class="card-img-top" alt="user" width="100" src="{{ Storage::url($animals->image) }}">
        
        <h2 class="text-uppercase"style="text-align:center;">Hi! I'm {{$animals->Name}}</h2>
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Name</h4>
                    <p>{{$animals->Name}}</p>
                 </div>
                 <div class="data">
                   <h4>Type</h4>
                   <p>{{$animals->Type}}</p>
                </div>
                <div class="data">
                    <h4>Breed</h4>
                    <p>{{$animals->Breed}}</p>
                 </div>
                 <div class="data">
                    <h4>Sex</h4>
                    <p>{{$animals->Sex}}</p>
                 </div>
                 <div class="data">
                    <h4>Age</h4>
                    <p>{{$animals->Age}}</p>
                 </div>
            </div>

        </div>

      <div class="projects">
            <h3>Status</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Health Status</h4>
                    <p>{{$animals->HealthStatus}}</p>
                 </div>
                 <div class="data">
                    <h4>Adoptation Status</h4>
                    <p>{{$animals->AdaptionStatus}}</p>
              </div>
            </div>
        </div>
    </div>

    <div class="right">
        <h2 class="text-uppercase"style="text-align:center;">ANIMAL COMMENTS HERE</h2>
        <div class="info">
            <div class="info_data">
                 <div class="data">
                    @foreach($comment as $comments)
                    @if($animals->id == $comments->animal_id)
                    <p><strong>Name:</strong>{{ $comments->name }}</p>
                    <p><strong>Comment:</strong><br/>{{ $comments->comment }}</p>
                    @endif
                    @endforeach
                 </div>      
            </div>

        </div>
    </div>
</div>



<div class="wrapper">
    <div class="right">
        <img class="card-img-top" alt="user" width="100" src="{{ Storage::url($animals->image) }}">
        <h2 class="text-uppercase"style="text-align:center;">Hi! I'm {{$animals->Name}}</h2>
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Name</h4>
                    <p>{{$animals->Name}}</p>
                 </div>
                 <div class="data">
                   <h4>Type</h4>
                   <p>{{$animals->Type}}</p>
                </div>
                <div class="data">
                    <h4>Breed</h4>
                    <p>{{$animals->Breed}}</p>
                 </div>
                 <div class="data">
                    <h4>Sex</h4>
                    <p>{{$animals->Sex}}</p>
                 </div>
                 <div class="data">
                    <h4>Age</h4>
                    <p>{{$animals->Age}}</p>
                 </div>
            </div>

        </div>

      <div class="projects">
            <h3>Status</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Health Status</h4>
                    <p>{{$animals->HealthStatus}}</p>
                 </div>
                 <div class="data">
                    <h4>Adoptation Status</h4>
                    <p>{{$animals->AdaptionStatus}}</p>
              </div>
            </div>
        </div>
    </div>

    <div class="right">
        <h2 class="text-uppercase"style="text-align:center;">ANIMAL COMMENTS HERE</h2>
        <div class="info">
            <div class="info_data">
                 <div class="data">
                    @foreach($comment as $comments)
                    @if($animals->id == $comments->animal_id)
                    <p><strong>Name:</strong>{{ $comments->name }}</p>
                    <p><strong>Comment:</strong><br/>{{ $comments->comment }}</p>
                    @endif
                    @endforeach
                 </div>      
            </div>

        </div>
    </div>

    <div class="right">
        <h2 class="text-uppercase"style="text-align:center;">ANIMAL COMMENTS HERE</h2>
        <div class="info">
            <div class="info_data">
                 <div class="data">
                    {!! Form::open(['route' => 'animal.comments', 'method' => 'POST']) !!}

    <div class="row">
      <div class="col-md-50">
          {{ Form::label('animal_id', "Animal ID:") }}
          {!! Form::text('animal_id',$animals->id,array('class' => 'form-control','readonly' => 'true')) !!}
      </div>

      <div class="col-md-50">
          {{ Form::label('name', "Name:") }}
          {{ Form::text('name', null, ['class'=> 'form-control']) }}
      </div>

      <div class="col-md-50">
          {{ Form::label('comment', "Comment:") }}
          @include('frontend.flash-message')
          {{ Form::textarea('comment', null, ['class'=> 'form-control']) }}
          {{ Form::submit('Add Comment',['class'=> 'btn btn-success btn-block','style' => 'margin-top:15px;']) }}
      </div>
      
    </div>
          {{ Form::close() }}  
                 </div>      
            </div>
        </div>
    </div>
</div>




     








@endsection




