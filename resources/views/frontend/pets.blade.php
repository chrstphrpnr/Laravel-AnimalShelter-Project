@extends('frontend.layout')
@section('content')
<style>
      .container{
        margin-right: 180px;
    }

    .main-content{
    margin-top: 200px;
    margin-left:100px;
    }

.card-img-top{
    height: 200px;
    width: 300px;
    margin-left: 150px;
    margin-top: 50px;
}

.input-group{
    margin-bottom: 20px;
}
</style>


<div class="main-content">
    <div class="col-md-4 col-xl-3">
        <h6 class="sidebar-title">Search</h6>
      
        <form class="navbar-form navbar-left" method="POST" role="search" action="{{route('search')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
          </form>
        </form>
    </div>
    <div class="section bg-gray">
      <div class="container">
        <div class="row">
            <div class="col-md-10 col-xl-20">
                <div class="row gap-x">

                    @forelse($animals as $animal)
                        <div class="col-md-6">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                            <a href="{{ route('animal.show', $animal->id) }}"><img class="card-img-top" src="{{ Storage::url($animal->image) }}"></a>
                            <div class="p-6 text-center">
                                <p>
                                <a class="small-5 text-lighter text-uppercase ls-2 fw-400">
                                    <p>{{ $animal->Name }}</p>
                                    <p>Status: {{ $animal->HealthStatus }}</p>
                                    <p>Status: {{ $animal->AdaptionStatus }}</p>

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
  </div>





@endsection
