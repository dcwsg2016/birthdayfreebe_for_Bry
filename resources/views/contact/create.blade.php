<?php //contact.blade.php ?>

@extends('layouts.app')

@section('customcss')

  <link rel="stylesheet" text="text/css" href="css/main.css">
  <style>
   #errors{
       color:red; 
    }
  </style>
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
    @if(session()->has('message'))
      <div class="alert alert-success">
          <strong>Success. </strong>{{ session()->get('message') }}
      </div>
    @endif

    <!-- This is if endif below will hide the form once the contact message has been sent, since it is not needed to be there anymore
      If session does not have message, dont show form
    -->
    @if(!session()->has('message'))
    <form action="/contact" method="POST" class="text-left">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter name" name="name">
      <div><p style="color:red;">{{$errors->first('name')}}</p></div>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" value="{{old('email')}}"placeholder="Enter email" name="email">
      <div id="errors"><p style="color:red;">{{$errors->first('email')}}</p></div>
    </div>
    <div class="form-group">
    	<label for="message">Message:</label>
      <textarea class="form-control" id="message" rows="10" placeholder="Enter your message here" name="message">{{old('message')}}</textarea>
      <div id="errors"><p style="color:red;">{{$errors->first('message')}}</p></div>
      <!--
    	<input type="text" class="form-control" id="msg" placeholder="Enter your message here" name="msg" style="height: 300px;">-->
    </div>
   <div class="text-center"> 
    <button type="submit" class="btn btn-primary">Submit Contact Form</button>
  </div>
  @csrf
  </form>
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

