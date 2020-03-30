<?php //announce_a_business ?>

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>

@extends('layouts.app')

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

<!--
<script src="js/jquery-3.4.1.js"></script>-->

<script type="text/javascript">
  @if (count($errors) > 0)
      //$('#myModal').modal('show');
      $(document).ready(function(){
        $("#myModal").modal('show');
    });
  @endif
</script>

@section('content')
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Tell us about your birthday freebe business!</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
    <div class="container">
        <h4>We are always looking to add more Birthday Freebe businesses to our database</h4>
        <p>However, please note you must be a registered user to do this.</p>

        

        
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Open Form to Fill Out Details
        </button>

        <!-- MODAL AREA -->
        
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

         <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title" style="color:black;">Your Business Information</h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>


        <!-- Modal body --> 
        <div class="modal-body" style="color:black;">
        <form action="{{route('add-your-business-details')}}" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group text-left">
                        <label for="business_name">Business Name</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{old('business_name')}}" required>
                         @if($errors->has('business_name'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_name')}}
                            </p>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group text-left">
                        <label for="business_type">Business Type</label>
                        <select class="form-control" id="business_type" name="business_type">
                          <option>Restaurant</option>
                          <option>Convenience Store</option>
                          <option>Other Business</option>
                        </select>

                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group text-left">
                          <label for="business_type">Business Email</label>
                          <input type="text" class="form-control" id="business_email" name="business_email" value="{{old('business_email')}}">
                          @if($errors->has('business_email'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_email')}}
                            </p>
                        @endif
                      </div>
                    </div>
                </div><!-- end first row-->
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group text-left">
                      <label for="business_address">Business Address
                      </label>
                      <input type="text" class="form-control" id="business_address"name="business_address" value="{{old('business_address')}}" required>
                      @if($errors->has('business_address'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_address')}}
                            </p>
                        @endif
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group text-left">
                      <label for="business_phone">Business Phone Number</label>
                      <input type="text" class="form-control" id="business_phone" name="business_phone" value="{{old('business_phone')}}" required>
                      @if($errors->has('business_phone'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_phone')}}
                            </p>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group text-left">
                      <label for="business_city">Business City
                      </label>
                      <input type="text" class="form-control" id="business_city" name="business_city" value="{{old('business_city')}}" required>
                      @if($errors->has('business_city'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_city')}}
                            </p>
                        @endif
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <label for="business_state">Business State</label>
                      @include('includes.USStates')
                      
                    </div>
                    
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <label for="business_zip">Business Zip</label>
                      <input type="text" class="form-control" id="business_zip" name="business_zip" value="{{old('business_zip')}}" required>
                      @if($errors->has('business_zip'))
                            <p class="alert alert-danger">
                                {{ $errors->first('business_zip')}}
                            </p>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                
                    <p>(*Note that once you hit submit button you will be taken to another page to input more information about the free birthday options you would like to provide.)</p>
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" name="business_details">Submit Business Information</button>
                  </div>
                  <div class="col-sm-4">
                  </div>
                </div>
                @csrf
              </form>
               </div><!-- end modal body -->

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>


              </div><!-- end modal-content -->
          </div><!--end modal-dialog modal-xl -->
        </div><!-- end of class="modal fade" id="myModal"-->

        <!-- END MODAL AREA -->
   
    </div><!--end of class="container" -->
  </div><!-- end row div-->
</div><!-- end container-fluid bg-2 text-center-->

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



