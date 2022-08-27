@extends('Dashboard.layout')


@section('content')

<style>
    .message    {
    margin-left: 250px;
    margin-bottom: 200px;
    }
    .edit {
    background-color: transparent;
    border:transparent;
    color: rgb(255, 238, 0);

    }
    body {
  font-family: 'Roboto', sans-serif;
  background-repeat: no-repeat;
  background-size: cover;
  font-family: 'Varela Round', sans-serif;
  font-size: 13px;
}

    .col-md-7{
        margin-top: 100px;
        margin-left: 520px;
    }

    .col-md-8{
        margin-top: 100px;
        margin-left: 0px;
    }

    .col-md-5{
        margin-top: 100px;
        margin-left: 450px;
    }





}
</style>




<div class="main-content">
    <div class="section bg-gray">
      <div class="container">
        <div class="row">
            <div class="col-md-7 col-xl-20">
                <div class="row gap-x">
                    @forelse($admins as $admin)
                        <div class="col-md-6">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                            <div class="p-6 text-center">
                                <p>
                                <a class="small-5 text-lighter text-uppercase ls-2 fw-400">
                                    <p>Admin: {{ $admin->fname }}</p>
                                    <p>Email: {{ $admin->email  }}</p>
                                    <p>Role: {{ $admin->role }}</p>
                                    <p>
                                        <a href="{{ route('admin.edit', $admin->id)}}" title="Edit" class="edit"><span class="material-icons">edit</span></a>
                                    </form>
                                    <p>
                                </a>
                                </p>
                            </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">

                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>



    
    <div class="row">
        <div  class="col-sm-5 col-md-5">
            <h2>Adopted Animals Per Month Demographics</h2>
                @if(empty($adoptChart))
                    <div id="app2"></div>
                @else
                    <div id="app2">{!! $adoptChart->container() !!}</div>
                    {!! $adoptChart->script() !!}
                @endif   
        </div>
    </div>

    <div class="row">
        <div  class="col-sm-5 col-md-5">
            <h2>Adopted Animals Per Month Demographics</h2>
                @if(empty($rescueChart))
                    <div id="app2"></div>
                @else
                    <div id="app2">{!! $rescueChart->container() !!}</div>
                    {!! $rescueChart->script() !!}
                @endif   
        </div>
    </div>

    <div class="row">
        <div  class="col-sm-5 col-md-5">
            <h2>Common Sickness Demographics</h2>
                @if(empty($healthChart))
                    <div id="app2"></div>
                @else
                    <div id="app2">{!! $healthChart->container() !!}</div>
                    {!! $healthChart->script() !!}
                @endif   
        </div>
    </div>
  </div>
@endsection


  
