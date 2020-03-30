<?php //add_your_business ?>

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
        <h3 class="margin">Here is the business information you entered:  </h3>
        @if(isset($message))
        <div class="container">
        <div class="card bg-light text-dark">
          <div class="card-header"></div>
            <div class="card-body" style="color:red;">
              <p>{{$message}}</p>
              <p hidden> 
              @if(isset($details))
                @foreach($details as $business)
                  {{$business->id}}
                @endforeach
              @endif
              </p>
              <a href="{{route('add-your-freebe-details', $business->id)}}" class="btn btn-info" role="button">Add Your Freebes!</a>
              </br></br>
              <p>If you would like to change or update any of your business information, please click the button here.</p>
              
              <a href="{{route('update-your-business')}}" class="btn btn-info" role="button">Update Your Business Info</a>
            </div>
            <div class="card-footer"></div>
          <!--</div>-->
        </div>
        </div>
        </br></br>
        @endif


        

         
        @if(isset($details))
        <table class="table table-responsive table-striped" style="background-color: tan;">
            <thead style="text-shadow: 1px 1px white;">
              <tr>
                <th>Business Name</th>
                <th>Business ID</th>
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
                <td>{{$business->id}}</td>
                <td>{{$business->type_name}}</td>
                <td>{{$business->email}}</td>
                <td>{{$business->address}}</td>
                <td>{{$business->phone}}</td>
                <td>{{$business->city}}</td>
                <td>{{$business->state}}</td>
                <td>{{$business->zip_code}}</td>
                <!-- did have: locations.locationStores', $location->zip_code --> 
                
              </tr>
              @endforeach
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

