<?php //contact.blade.php ?>

@extends('layouts.app')

@section('customcss')

  <link rel="stylesheet" text="text/css" href="css/main.css">

@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Contact</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-3"> 
  </div>
  <div class="col-sm-6">
    <h3 class="margin"> Contact us for any questions! </h3>
    <form action="#">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="form-group">
    	<label for="msg">Message:</label>
    	<input type="text" class="form-control" id="msg" placeholder="Enter your message here" name="msg" style="height: 300px;">
    </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

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
      <img src="img/pizzaRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4">
      <p>Free Tacos!</p>
      <img src="img/tacosRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Free Burgers!</p>
      <img src="img/burgerRESIZED.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection

