<?php //update-your-business-details.blade.php ?>

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="../img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Where you can find free stuff on your birthday!</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-3"> 
  </div>
  <div class="col-sm-6">
    <h3 class="margin">Your Updated Business Details:  </h3>
    @if(isset($message))
      <p>{{$message}}</p>
    @endif
    @if(isset($details))
        <table class="table table-responsive table-striped" style="background-color: tan;">
            <thead style="text-shadow: 1px 1px white;">
              <tr>
                <th>Business Name</th>
                <th>Business Freebe ID</th>
                <th>Business Type</th>
                <th>Business Email</th>
                <th>Business Address</th>
                <th>Business Phone</th>
                <th>Business City</th>
                <th>Business State</th>
                <th>Business Zip</th>
              </tr>
            </thead>
            <tbody style="color:white;">
              
              @foreach($details as $business)
              <tr>
                
                <td>{{$business->name}}</td> 
                
                <td>{{$business->type_name}}</td>
                
                <!-- did have: locations.locationbusinesses', $location->zip_code --> 
                
              </tr>
              @endforeach
            </tbody>
          </table>
        
        @elseif(isset($message))
          <p>{{$message}}</p>
        @endif
       
  </div>
  <div class="col-sm-3">
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
