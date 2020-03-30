<?php //about.blade.php ?>

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>About Us</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-3"> 
  </div>
  <div class="col-sm-6">
    <h3 class="margin">Why did we create this website?  </h3>
    <p>
    	We created this site because we always have been intrigued by local businesses around our town that offered free food, drinks, and other goodies on a person's birthday. As long as you can prove your birthday, by presenting your license to a business, you will get these freebies! So that was our inspiration. 
    </p>
    <p>
    	Our goal is to have as many businesses nation-wide contribute their free giveaways on birthdays, so that anyone around the country can find out if their local town or area will accommodate them in this manner. 
    </p>
    <p>
    	So, if you know of a business that offers free goodies on a person's birthday, be sure to let us know! 
    </p>
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



