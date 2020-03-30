<?php //user.blade.php ?> 

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>

@extends('layouts.app') 

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
  <style>
  	body {
  background-color: red;
}

  </style>
@stop

<script>
	$(window).on('load',function(){
        $('#myModal').modal('show');
    });

</script>

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-5">
		</div>
		<div class="col-sm-2 text-center">
		</br>
			<p>{{--
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				    Back To User Page
				  </button>--}}
				  <a class="btn btn-primary" href="{{ route('user',Auth::user()->id) }}">Back To User Page</a>
			</p></br>
			<p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				    Add Your Freebe
				  </button>
			</p>
		</div>
		<div class="col-sm-5">
		</div>
	</div>
 </div>

<!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Add Another Freebe</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              {{--
              <form action="{{route('add-user-freebe', $business->id)}}" method="POST" id="formID2">--}}
              	<form action="{{route('add-user-freebe', $business->id)}}" method="POST" id="formID2">
                <div id="modal_form">
                	
                    <div class='row'>
                      <div class='col-sm-3'>
                        <div class='form-group text-left'>
                          <label for='freebe_name'>Freebe Business ID: {{$business->id}}</label>
                          {{--
                          <input type="text" class="form-control" id="freebe_business_id" name="freebe_business_id" value="{{$business->id}}">--}}
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group text-left'>
                          <label for='freebe_name'>Freebe Name</label>
                          <input type="text" class="form-control" id="freebe_name" name="freebe_name" value="" required>
                        </div>
                      </div><!-- end col-sm-6-->
                      <script>
                          
                      </script>
                      <div class='col-sm-6'>
                        <div class='form-group text-left'>
                          <label for='freebe_type'>Freebe Type</label>
                          <select class='form-control' id='freebe_type' name='freebe_type' value=''>
                            <option>Free Food</option>
                            <option>Free Gifts</option>
                            <option>Other Free Option</option>
                          </select>
                        </div>
                      </div><!-- end col-sm-6 -->
                    </div><!-- end first row-->
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group text-left">
                          <label for="freebe_details">Freebe Details
                          </label>
                          <input type="text" class="form-control" id="freebe_details" name="freebe_details" value="" required>
                        </div>
                      </div>
                  </div><!-- end 2nd row-->
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
                </div><!-- end div modal form --> 
                <div class='col-sm-4'>
                <button type='submit' class='btn btn-primary' name='business_details'>Submit Your Freebe Information</button>
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

<!-- END ADD USER FREEBE MODAL -->


@endsection




