<?php //save-freebe-details.blade.php ?> 

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Tell us about a birthday freebe business in your area!</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">

    <div class="col-sm-2">  
      </div>
      <div class="col-sm-8">
        <h4>Here are the Freebe details you entered:</h4>
        {{--@if(isset($details))--}}
        @if(isset($message))
        <div class="container">
        <div class="card bg-light text-dark">
          <div class="card-header"></div>
            <div class="card-body" style="color:red;">
              <p>{{$message}}</p>
              <p>
              @if(isset($show_freebe_details))
                @foreach($show_freebe_details as $freebe)
                 <a href="{{route('update-your-freebe',$freebe->business_id)}}" class="btn btn-info" role="button">Update Your Freebe Info</a>
                @endforeach
              @endif
              </p>
              
              
            </div>
            <div class="card-footer"></div>
          <!--</div>-->
        </div><!--end card bg-light text-dark -->
        </div><!-- end of class container -->
        </br></br>
        <table class="table table-responsive table-striped" style="background-color: tan;">
            <thead style="text-shadow: 1px 1px white;">
              <tr>
                <th>Freebe Name</th>
                <th>Freebe Details</th>
                <th>Freebe Start Date</th>
                <th>Freebe End Date</th>
              </tr>
            </thead>
            <tbody style="color:white;">
              
              {{--@foreach($details as $freebe)--}}

            @if(isset($show_freebe_details))  
              @foreach($show_freebe_details as $freebe)
              <tr>
                <td>{{$freebe->name}}</td>
                <td>{{$freebe->details}}</td>
                <td>{{$freebe->start_date}}</td>
                <td>{{$freebe->end_date}}</td>  
              </tr>
              @endforeach
            @endif
            </tbody>
          </table>
        
        @elseif(isset($message))
          <p>{{$message}}</p>
        @endif

      </div><!-- end div col sm 8 --> 
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

