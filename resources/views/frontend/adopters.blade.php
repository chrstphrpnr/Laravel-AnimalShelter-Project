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
</style>
<div class="main-content">
    <div class="section bg-gray">
      <div class="container">
        <div class="row">
            <div class="col-md-10 col-xl-20">
                <div class="row gap-x">

                    @forelse($adopters as $adopter)
                        <div class="col-md-6">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                            <img class="card-img-top" src="{{ Storage::url($adopter->image) }}"></a>

                            <div class="p-6 text-center">
                                <p>
                                <a class="small-5 text-lighter text-uppercase ls-2 fw-400">
                                    <p>Adoptee: {{ $adopter->Name }}</p>
                                    <p>Adopted By: {{ $adopter->adopter_fname }}</p>
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






