<?php //add_your_freebe_details.blade.php ?>

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script> 

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

<script>
  $(document).ready(function(){
    $("#myModal").modal('show');
  });
</script>

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="../img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Tell us about a birthday freebe business in your area!</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
    <div class="col-sm-4">
    </div>

    <div class="col-sm-4">

    <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Open Form to Fill Out Freebe Details
        </button>

        
  	<!-- MODAL AREA -->
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              
            @if(session()->has('message'))
              <div class="alert alert-success" role="alert">
                <strong>Success!</strong>{{session()->get('message')}}
              </div>
            @endif
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title" style="color:black;">Your Birthday Freebe Details</h4>
                @if(isset($details))
                  @foreach($details as $store)
                    <p>Store ID: {{request()->route('business_id')}}</p>
                  @endforeach
                @endif

                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body" style="color:black;"> 
                <form action="{{route('freebe-details')}}" method="POST"><!--add_your_freebe_details_post --><!--save-freebe-details -->
                  @csrf
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                        <label for="freebe_business_id">Business ID</label>
                        <p>{{request()->route('business_id')}}</p>
                        <input type="hidden" class="form-control" id="freebe_business_id" name="freebe_business_id" value="{{request()->route('business_id')}}">
                      </div>
                  </div>
                  <div class="col-sm-10">
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group text-left">
                        <label for="freebe_name">Freebe Name <span>(like Free Lunch, Free Pizza, etc.)</span></label>
                        <input type="text" class="form-control" id="freebe_name" name="freebe_name" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group text-left">
                        <label for="freebe_type">Freebe Type </label>
                        <select class="form-control" id="freebe_type" name="freebe_type">
                          <option>Free Food</option>
                          <option>Free Gifts</option>
                          <option>Other Free Option</option>
                        </select>

                      </div> 
                    </div><!-- end col sm 6 -->
                    
                </div><!-- end first row-->

                <div class="row"><!-- 2nd row-->
                  
                  <div class="col-sm-12">
                    <div class="form-group text-left">
                      <!--
                        <label for="freebe_details">Freebe Details (like present your driver's license as proof, full list of items in the offer, time of day available, etc.)
                        </label>
                        <input type="text" class="form-control" id="freebe_details" name="freebe_details" required>-->
                        <label for="freebe_d">Freebe Details </label>
                        <select class="form-control" id="freebe_d" name="freebe_d">
                          <option>present drivers license</option>
                          <option>present our proof coupon</option>
                          <option>limit to one person per transaction</option>
                        </select>
                      </div>
                  </div>
                </div><!-- end 2nd row -->

                <div class="row"><!-- 3rd row-->
                  <div class="col-sm-6">
                    <div class="form-group text-left">
                      <label for="freebe_start_date">Freebe Start Date
                      </label>
                      <input type="date" class="form-control" id="freebe_start_date" name="freebe_start_date" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group text-left">
                      <label for="freebe_end_date">Freebe End Date</label>
                      <input type="date" class="form-control" id="freebe_end_date" name="freebe_end_date" required>
                    </div>
                  </div>
                </div><!-- end 3rd row-->
                
                <div class="row">
                  <div class="col-sm-4">
                
                    
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" name="freebe_details">Submit Freebe Details</button>
                  </div>
                  <div class="col-sm-4">
                  </div>
                </div><!-- end row -->
                
              </form>
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div><!-- end of class="modal fade" id="myModal"-->

        <!-- END MODAL AREA --> 


    

    </div><!-- end class col sm 4 before modal-->

    <div class="col-sm-4">
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

