<?php //home_locations.blade.php ?>

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="../img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>List of Businesses at Your Location</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-2">  
  </div>
  <div class="col-sm-8">
    <h3 class="margin">Results of Your Search:  </h3>
   {{--@if(isset($details))--}}
   @if(isset($locations))
    <table class="table table-striped" style="background-color: tan;">
        <thead style="text-shadow: 1px 1px white;">
          <tr>
            <th>City</th>
            <th>State</th>
            <th>Zip code</th>
            <th>Number of Businesses</th>
          </tr>
        </thead>
        <tbody style="color:white;">
          
          {{--@foreach($details as $location)--}}
          @foreach($locations as $location)
          <tr>
            <td>{{$location->city}}</td>
            <td>{{$location->state}}</td>
            <td>{{$location->zip_code}}</td>
            {{--
            <td><a href="{{route('home-businesses', $location->zip_code)}}">{{$location->number_of_businesses}}</a></td>--}}
            @if($number_businesses_in_location > 0)
              <td><a href="{{route('home-businesses', $location->zip_code)}}">{{$number_businesses_in_location}}</a></td>
            @else
              <td>{{$number_businesses_in_location}}</td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      @elseif(isset($message))
      <p>{{$message}}</p>
      <a href="{{route('home')}}" class="btn btn-primary" role="button">Try Your Search Again</a>
      @endif
   
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
      <img src="../img/pizzaRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4">
      <p>Free Tacos!</p>
      <img src="../img/tacosRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Free Burgers!</p>
      <img src="../img/burgerRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection



