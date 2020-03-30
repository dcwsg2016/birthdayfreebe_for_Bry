<?php //home_freebes.blade.php ?>

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center"><!-- did have: ../img/bflogo.png-->
  <h3 class="margin">Birthday Freebe</h3>
  <img src="{{asset('img/bflogo.png')}}" class="img-responsive img-circle margin" style="display:inline" alt="birthday_freebe" width="350" height="350">
  <h3>Freebe List</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-2"> 
  </div>
  <div class="col-sm-8">
    <h3 class="margin">The Freebes for this Business:  </h3>
    @if(isset($details))
    <table class="table table-striped" style="background-color: tan;">
        <thead style="text-shadow: 1px 1px white;">
          <tr>
            <th>freebe Name</th>
            <th>Details</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
        </thead>
        <tbody style="color:white;">
          
          @foreach($details as $freebe)
          <tr>
            <td>{{$freebe->name}}</td>
            <td>{{$freebe->details}}</td>
            <td>{{$freebe->start_date}}</td>
            <td>{{$freebe->end_date}}
          </tr>
          @endforeach
        </tbody>
      </table>
      @elseif(isset($message))
      <p>{{$message}}
      @endif
   @csrf
   
  </div>
  <div class="col-sm-2">
  </div>
</div><!-- end row div-->
</div>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">What can you get?</h3><br>
  <div class="row">
    <div class="col-sm-4"> 
      <p>Free Pizza!</p>
      <img src="{{asset('img/pizzaRESIZED.png')}}" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4">
      <p>Free Tacos!</p>
      <img src="{{asset('img/tacosRESIZED.png')}}" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Free Burgers!</p>
      <img src="{{asset('img/burgerRESIZED.png')}}" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection

