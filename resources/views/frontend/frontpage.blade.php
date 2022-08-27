@extends('frontend.layout')
@section('content')
<style>
    .container{
        margin-right: 200px;
    }
    .btn-adopt {
        margin-top: 30px;
        background-color:#9c5a28;
        border-radius:28px;
        border:1px solid #d1791b;
        display:inline-block;
        color:#fafafa;
        font-family:Arial;
        font-size:17px;
        font-weight:bold;
        padding:18px 37px;
        text-decoration:none;
        text-shadow:0px 1px 0px #bd9a66;
    }
    .btn-adopt:hover {
        text-decoration:none;
        color:#fafafa;
        background-color:#d49463;
        border:1px solid #d49463;
    }
    .btn-adopt:active {
        position:relative;
        top:1px;
    }



</style>
<div class="container py-5" style="text-align: center; margin-top: 80px; margin-right: 150px; color: rgb(46, 39, 39);">
    <h1 class="display-4 font-weight-bold mb-4">ADOPT YOUR PETS HERE</h1>
    <p>Shaw Shelter is a non-profit organization that rescues stray dogs and cats.</p>
    <a href="/pets" class="btn-adopt">ADOPT HERE</a>
</div>




<div id="slideshow">
    <div class="slide-wrapper">
        @forelse($animals as $animal)
      <div class="slide">
        <img  stlye= "width = 728;" height="510;" src="{{ Storage::url($animal->image) }}"></a>
      </div>
      @empty
      <p class="text-center">

      </p>
      @endforelse
    </div>
</div>
@endsection






