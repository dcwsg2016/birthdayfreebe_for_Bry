<?php //user.blade.php ?> 

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>

@extends('layouts.app') 

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

<script>
/*deleteData and formSubmit are for deleting businesses*/
  function deleteData(id)//this function is called when user clicks delete business
     {
         var id = id;
         
         var url = "{{ route('delete-user-business', ':id') }}";
         
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

 function formSubmit()//this function called when user clicks confirm delete in modal
     {
         $("#deleteForm").submit();
     } 
  
  /*deleteData2 and formSubmit2 are for deleting freebes*/
  function deleteData2(id)
     {
        //alert("in deleteData2");
         var id = id;
         
         var url = "{{ route('delete-user-freebe', ':id') }}";
         
         url = url.replace(':id', id);
         $("#deleteForm2").attr('action', url);
         //alert("url is: " + url);
     }

   function formSubmit2()
       {
            //alert("in formSubmit2");
           $("#deleteForm2").submit();
       }

</script>

@section('content')
{{--
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="../img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>User Page</h3>
</div>--}}

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="container text-center">
  <div class="row">
    <div class="col-sm-12" style="background-color:lightgrey; margin-top: 10px; margin-bottom: 10px; padding:10px;">
      <h4>Hi {{Auth::user()->name}}</h4>
      <p>Use this page to update your businesses, freebes, and acount information.</p>
    </div><!-- end colsm12-->
  </div><!-- end first row -->
  <div class="row" >
    <div class="col-sm-12"style="background-color:lightgrey;margin-top: 10px; margin-bottom: 10px; padding:10px; text-align: left;" >
      <h4> {{Auth::user()->name}} Account Info</h4>
      <h5>User Email:</h5>
      <p>{{Auth::user()->email}}</p>
      <h5>Account Created At:</h5>
      <p>{{Auth::user()->created_at}}</p>
      <h5>Account Updated At:</h5>
      <p>{{Auth::user()->updated_at}}</p>
      <div class="container">
      <div class="table-responsive">           
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>User Email</th>
                    <th>Date Account Created</th>
                    <th>Date Account Updated</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{Auth::user()->email}}</td>
                    <td>{{Auth::user()->created_at}}</td>
                    <td>{{Auth::user()->updated_at}}</td>
                  </tr>
                </tbody>
              </table>
            </div><!-- end div table-responsive -->
            </div><!-- end container for table-->

    </div><!-- end colsm4-->
  </div><!-- end of second row i JUST CREATED -->

  <div class="row">
    <!--
    <div class="col-sm-1">
      <p></p>
    </div>-->

    <div class="col-sm-12">
        <div class="row">
           <div class="col-sm-12" style="background-color:lightgrey;margin-top: 10px; margin-bottom: 10px; padding: 10px;">
            <h4>{{Auth::user()->name}} Businesses</h4>
            {{--
            <p> You do not have any businesses yet. Click on the Add Your Business button to add one.</p>--}}
            

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            {{--
            @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                      <p>{{ $message }}</p>
                  </div>
              @endif--}}


            <div class="container">
              <div class="table-responsive">
            @if(isset($get_user_businesses))
              @if(count($get_user_businesses) > 0)
              {{--
              <h4>{{Auth::user()->name}} Businesses</h4>--}}
                <p>Click on your business or freebe button to update. Click on delete to remove. </p> 

                @foreach($get_user_businesses as $business)
                  <table class="table table-striped">

                <thead><p>{{$business->name}}</p>
                  <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Number of freebes</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><p><a href="{{route('update-user-business-modal',$business->id)}}" class="btn btn-outline-dark btn-sm modal-global" id="business_name">{{$business->name}}</a></p>
                      {{--
                      <form action="{{route('delete-user-business', $business->id)}}" method="POST">
                        <button type="submit" class="btn btn-outline-danger btn-sm" id="delete_business">DELETE</button>
                        @csrf
                        
                      </form>--}}
                      <a href="javascript:;" data-toggle="modal"  onclick="deleteData('{{$business->id}}');"
                      data-target="#DeleteModal" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                    <td>{{$business->id}}</td>
                    <td>{{$business->user_id}}</td>
                    <td>{{$business->address}}</td>
                    <td>{{$business->phone}}</td>
                    <td>{{$business->city}}</td>
                    <td>{{$business->state}}</td>
                    <td>{{$business->zip_code}}</td>
                    <td>{{$business->email}}</td>
                    <td>{{$business->type_name}}</td>
                    <td>{{$business->number_of_freebes}}</td>
                    <td>{{$business->created_at}}</td>
                    <td>{{$business->updated_at}}</td>
                  </tr>

                  <tr>
                 
                    <table class="table table-striped">
                      <p>Freebes for {{$business->name}}:</p>
                      {{--@php ($i = 0)--}}
                      @if($business->number_of_freebes > 0)
                            <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Details</th>
                                  <th>Type</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                </tr>
                            </thead>
                      @else
                      <p>
                      You do not have any freebes for this business yet. Add one now!</p>
                      {{--@include('includes/usermodals')--}}
                      <p>
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('user-add-freebe',$business->id) }}">Add Your Freebe</a>
                        {{--
                      <a href="{{route('add-user-freebe-modal',$business->id)}}" class="btn btn-outline-dark btn-sm modal-global3" id="business_name">Add Your Freebe</a>--}}
                      </p>

                      {{--
                      <a href="javascript:;" data-toggle="modal"  onclick="addFreebe('{{$business->id}}');"data-target="#JSmodalAddFreebe" class="btn btn-sm btn-outline-dark">Add Your Freebe</a>  
                      --}}
                      {{--
                      <p>
                      <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalAddFreebe">Add Your Freebe</button></p>--}}
                    </br>

                      @endif
                      <tbody>

                        @if(isset($get_user_freebes))  
                          @foreach($get_user_freebes as $freebe)

                            @if($freebe->business_id == $business->id)
                              {{--@php ($i++)--}}
                              
                              {{--@if($i > 0)--}} 
                                <tr>
                                  <td><p><a href="{{route('update-user-freebe-modal',$freebe->id)}}" class="btn btn-outline-dark btn-sm modal-global2" id="freebe_name">{{$freebe->name}}</a></p>
                                    <a href="javascript:;" data-toggle="modal"  onclick="deleteData2('{{$freebe->id}}');"
                                    data-target="#DeleteModal2" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                                    {{--
                                  <form action="" method="POST" onsubmit="confirmDelete2()">
                                      <button type="submit" class="btn btn-outline-danger btn-sm" id="delete_business">DELETE</button>
                                      @csrf
                                    </form>--}}
                                  </td>
                                  <td>{{$freebe->details}}</td>
                                  <td>{{$freebe->type_name}}</td>
                                  <td>{{$freebe->start_date}}</td>
                                  <td>{{$freebe->end_date}}</td>
                                  <td>{{$freebe->created_at}}</td>
                                  <td>{{$freebe->updated_at}}</td>
                                </tr>
                              {{--@else--}}
                              
                              {{--@endif--}}
                              

                            @endif

                          @endforeach
                        <!-- endif for if(isse($get_user_freebe)) -->
                        @endif 

                      </tbody>
                    </table>

                    @if($business->number_of_freebes > 0)

                    {{--@include('includes/usermodals')--}}
                        <p>
                          <a class="btn btn-outline-dark btn-sm" href="{{ route('user-add-freebe',$business->id) }}">Add Another Freebe</a>

                          {{--
                        <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalAddFreebe">Add Another Freebe</button>--}}
                        </p>
                    </br>
                    @endif
                  </tr>

                </tbody>
              </table>
              
                @endforeach
                {{--@include('includes/usermodals')--}}
                </br>
                  <p>
                  <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalAddBusiness">Add Another Business</button>
                  </p>
                </br>
              @else
                {{--@include('includes/usermodals')--}}
               
                <p> You do not have any businesses yet. Click on the Add Your Business button to add one.</p>
                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalAddBusiness">Add Your Business</button>

              </br></br>
                
              @endif
          @else
          <p> You do not have any businesses yet. Click on the Add Your Business button to add one.</p>
            <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalAddBusiness">Add Your Business</button>
          </br></br>

          @endif


              </div><!-- end table-responsive -->
            </div><!-- end class container -->
           </div><!-- end colsm12-->
        </div><!-- end 1st row in colsm8-->
        
    </div><!-- end colsm8-->
  </div><!-- end 2nd row-->
</div><!-- end container text-center-->
</div><!-- end container-fluid bg-2 text-center-->
<!-- ALL MODALS FOR THIS PAGE -->

<!-- MODAL CODE BELOW FOR DELETE BUSINESS -->

<div id="DeleteModal" class="modal fade" role="dialog">
   <div class="modal-dialog text-danger">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
         <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title">Delete Confirmation</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button> 
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{--{{ method_field('DELETE') }}--}}
                 <p class="text-center">Are you sure you want to delete this business?</p>
             </div>
             <div class="modal-footer">
                 <center>
                     <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                     <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                 </center>
             </div>
         </div>
     </form>
   </div>
  </div>

<!-- END MODAL CODE FOR DELETE BUSINESSS-->

<!-- MODAL CODE BELOW FOR DELETE FREEBE -->

<div id="DeleteModal2" class="modal fade" role="dialog">
   <div class="modal-dialog text-danger">
     <!-- Modal content-->
     <form action="" id="deleteForm2" method="post">
         <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title">Delete Confirmation</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button> 
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{--{{ method_field('DELETE') }}--}}
                 <p class="text-center">Are you sure you want to delete this freebe?</p>
             </div>
             <div class="modal-footer">
                 <center>
                     <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                     <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit2()">Yes, Delete</button>
                 </center>
             </div>
         </div>
     </form>
   </div>
  </div>

<!-- END MODAL CODE FOR DELETE FREEBE-->

<!-- MODAL AREA FOR UPDATE BUSINESS -->

    <!-- The Modal -->
        <div class="modal fade" id="modal-global">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Your Current Business Information</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              <form action="" method="POST" id="formID">
                <div id="modal_form">
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group text-left'>
                          <label for='business_name'>Business Name</label>
                          <input type='text' class='form-control' id='business_name' name='business_name' value='' required>
                        </div>
                      </div><!-- end col-sm-6-->
                      <script>
                          
                      </script>
                      <div class='col-sm-3'>
                        <div class='form-group text-left'>
                          <label for='business_type'>Business Type</label>
                          <select class='form-control' id='business_type' name='business_type' value=''>
                            <option>Restaurant</option>
                            <option>Convenience Store</option>
                            <option>Other Business</option>
                          </select>
                        </div>
                      </div><!-- end col-sm-3 -->
                       <div class="col-sm-3">
                        <div class="form-group text-left">
                            <label for="business_type">Business Email</label>
                            <input type="text" class="form-control" id="business_email" name="business_email" value="">
                        </div>
                      </div>
                    </div><!-- end first row-->
                    <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group text-left">
                        <label for="business_address">Business Address
                        </label>
                        <input type="text" class="form-control" id="business_address"name="business_address" value="" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group text-left">
                        <label for="business_phone">Business Phone Number</label>
                        <input type="text" class="form-control" id="business_phone" name="business_phone" value="" required>
                      </div>
                    </div>
                  </div><!-- end 2nd row-->
                  <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group text-left">
                      <label for="business_city">Business City
                      </label>
                      <input type="text" class="form-control" id="business_city" name="business_city" value="" required>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <!--
                      <script>$('#business_state').val('{$business->state}');</script>-->
                      <label for="business_state">Business State</label>
                      <!--
                      <input type="text" class="form-control" id="business_state" name="business_state" value="" >-->
                      <select class='form-control' id='business_state' name='business_state' value=''>
                          <option >AL</option>
                          <option >AK</option>
                          <option >AR</option>  
                          <option >AZ</option>
                          <option >CA</option>
                          <option >CO</option>
                          <option >CT</option>
                          <option >DC</option>
                          <option >DE</option>
                          <option >FL</option>
                          <option >GA</option>
                          <option >HI</option>
                          <option >IA</option>  
                          <option >ID</option>
                          <option >IL</option>
                          <option >IN</option>
                          <option >KS</option>
                          <option >KY</option>
                          <option >LA</option>
                          <option >MA</option>
                          <option >MD</option>
                          <option >ME</option>
                          <option >MI</option>
                          <option >MN</option>
                          <option >MO</option>  
                          <option >MS</option>
                          <option >MT</option>
                          <option >NC</option>  
                          <option >NE</option>
                          <option >NH</option>
                          <option >NJ</option>
                          <option >NM</option>    
                          <option >NV</option>
                          <option >NY</option>
                          <option >ND</option>
                          <option >OH</option>
                          <option >OK</option>
                          <option >OR</option>
                          <option >PA</option>
                          <option >RI</option>
                          <option >SC</option>
                          <option >SD</option>
                          <option >TN</option>
                          <option >TX</option>
                          <option >UT</option>
                          <option >VT</option>
                          <option >VA</option>
                          <option >WA</option>
                          <option >WI</option>  
                          <option >WV</option>
                          <option >WY</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <label for="business_zip">Business Zip</label>
                      <input type="text" class="form-control" id="business_zip" name="business_zip" value="" required>
                      <input type="hidden" id="business_zip_hidden" name="business_zip_hidden" value="">
                    </div>
                  </div>
                </div><!-- end row 3 --> 
                </div><!-- end div modal form --> 
                <div class='col-sm-4'>
                <button type='submit' class='btn btn-primary' name='business_details'>Submit Your Updated Business Information</button>
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

<!-- END MODAL FOR UPDATE BUSINESS--> 

<!-- MODAL FOR UPDATE FREEBE -->

    <!-- The Modal -->
        <div class="modal fade" id="modal-global2">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Your Current Freebe Information</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              <form action="" method="POST" id="formID2">
                <div id="modal_form">
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
                          <input type="text" class="form-control" id="freebe_details"name="freebe_details" value="" required>
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
                <button type='submit' class='btn btn-primary' name='business_details'>Submit Your Updated Freebe Information</button>
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

<!-- END MODAL FOR UPDATE FREEBE --> 


<!-- ADD USER BUSINESS MODAL in user.blade.php -->

<!-- The Modal -->
        <div class="modal fade" id="modalAddBusiness">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Your Current Business Information</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              <form action="{{route('add-user-business')}}" method="POST" id="formID">
                <div id="modal_form">
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group text-left'>
                          <label for='business_name'>Business Name</label>
                          <input type='text' class='form-control' id='business_name' name='business_name' value='' required>
                        </div>
                      </div><!-- end col-sm-6-->
                      <script>
                          
                      </script>
                      <div class='col-sm-3'>
                        <div class='form-group text-left'>
                          <label for='business_type'>Business Type</label>
                          <select class='form-control' id='business_type' name='business_type' value=''>
                            <option>Restaurant</option>
                            <option>Convenience Store</option>
                            <option>Other Business</option>
                          </select>
                        </div>
                      </div><!-- end col-sm-3 -->
                       <div class="col-sm-3">
                        <div class="form-group text-left">
                            <label for="business_type">Business Email</label>
                            <input type="text" class="form-control" id="business_email" name="business_email" value="">
                        </div>
                      </div>
                    </div><!-- end first row-->
                    <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group text-left">
                        <label for="business_address">Business Address
                        </label>
                        <input type="text" class="form-control" id="business_address"name="business_address" value="" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group text-left">
                        <label for="business_phone">Business Phone Number</label>
                        <input type="text" class="form-control" id="business_phone" name="business_phone" value="" required>
                      </div>
                    </div>
                  </div><!-- end 2nd row-->
                  <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group text-left">
                      <label for="business_city">Business City
                      </label>
                      <input type="text" class="form-control" id="business_city" name="business_city" value="" required>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <!--
                      <script>$('#business_state').val('{$business->state}');</script>-->
                      <label for="business_state">Business State</label>
                      <!--
                      <input type="text" class="form-control" id="business_state" name="business_state" value="" >-->
                      <select class='form-control' id='business_state' name='business_state' value=''>
                          <option >AL</option>
                          <option >AK</option>
                          <option >AR</option>  
                          <option >AZ</option>
                          <option >CA</option>
                          <option >CO</option>
                          <option >CT</option>
                          <option >DC</option>
                          <option >DE</option>
                          <option >FL</option>
                          <option >GA</option>
                          <option >HI</option>
                          <option >IA</option>  
                          <option >ID</option>
                          <option >IL</option>
                          <option >IN</option>
                          <option >KS</option>
                          <option >KY</option>
                          <option >LA</option>
                          <option >MA</option>
                          <option >MD</option>
                          <option >ME</option>
                          <option >MI</option>
                          <option >MN</option>
                          <option >MO</option>  
                          <option >MS</option>
                          <option >MT</option>
                          <option >NC</option>  
                          <option >NE</option>
                          <option >NH</option>
                          <option >NJ</option>
                          <option >NM</option>    
                          <option >NV</option>
                          <option >NY</option>
                          <option >ND</option>
                          <option >OH</option>
                          <option >OK</option>
                          <option >OR</option>
                          <option >PA</option>
                          <option >RI</option>
                          <option >SC</option>
                          <option >SD</option>
                          <option >TN</option>
                          <option >TX</option>
                          <option >UT</option>
                          <option >VT</option>
                          <option >VA</option>
                          <option >WA</option>
                          <option >WI</option>  
                          <option >WV</option>
                          <option >WY</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group text-left">
                      <label for="business_zip">Business Zip</label>
                      <input type="text" class="form-control" id="business_zip" name="business_zip" value="" required>
                      <input type="hidden" id="business_zip_hidden" name="business_zip_hidden" value="">
                    </div>
                  </div>
                </div><!-- end row 3 --> 
                </div><!-- end div modal form --> 
                <div class='col-sm-4'>
                <button type='submit' class='btn btn-primary' name='business_details'>Submit Your Business Information</button>
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

<!-- END ADD USER BUSINESS MODAL -->



<!-- ADD USER FREEBE MODAL (thinking i dont need this one) in  user.blade.php -->

 
<!-- END ADD USER FREEBE MODAL -->




<!-- ADD ANOTHER FREEBE OR ADD YOUR FREEBE MODAL -->
<!-- okay, need to add the id for this to work-->

<!-- The Modal -->
        <div class="modal fade" id="modal-global3">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Your Current Freebe Information</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              <form action="" id="JSformID" method="POST" >
                
                <div id="modal_form">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class='form-group text-left'>
                          <label for='freebe_business_id'>Freebe Business ID</label>
                          <input type='text' class='form-control' id='freebe_business_id' name='freebe_business_id' value=''>
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
                  <button type='submit' class='btn btn-primary' name='freebe_details'>Submit Your Freebe Information</button>
                  {{--
                 <button type='submit' class='btn btn-primary' name='' onclick='submitJSmodalAddFreebe()'>Submit Your Freebe Information</button>--}}
                 {{ csrf_field() }}
              </form>
              </div><!-- end modal body -->

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>


              </div><!-- end modal-content -->
          </div><!--end modal-dialog modal-xl -->
        </div><!-- end of class="modal fade" id="myModal"-->


<!-- END ADD ANOTHER FREEBE OR ADD YOUR FREEBE MODAL -->


<!-- END ALL MODALS FOR THIS PAGE --> 


<!-- SCRIPTS FOR UPDATING BUSINESS AND FREEBE-->
<script>

$(document).ready(function(){
  $('.modal-global').click(function(event) {
        event.preventDefault();
        //alert("in business update modal function.");

        var url = $(this).attr('href');
        var name = $(this).html();
        //$('#business_name').val(name);
                
        $.ajax({ 
            type: 'GET',
            url: url,
            dataType: 'html',//can't return html, need to return json type to get 
            success: function(response){
              
              var formURL = "/update-user-business-details/"; 
              var responseOBJ = response;
              var modalJSON = JSON.parse(responseOBJ);
              var newURL = formURL + modalJSON.id;
              
              $("#formID").attr("action", newURL);
              $('#business_name').val(modalJSON.name);
              $('#business_type').val(modalJSON.type_name);
              $('#business_email').val(modalJSON.email);
              $('#business_address').val(modalJSON.address);
              $('#business_phone').val(modalJSON.phone);
              $('#business_city').val(modalJSON.city);
              $('#business_state').val(modalJSON.state);
              $('#business_zip').val(modalJSON.zip_code);
              $('#business_zip_hidden').val(modalJSON.zip_code);
              //alert("business_zip_hidden is: " + modalJSON.zip_code )

              $("#modal-global").modal('show');
            }
        });
    });
});

$(document).ready(function(){
  $('.modal-global2').click(function(event) {
        event.preventDefault();
        //alert("in freebe update modal function.");

        var url = $(this).attr('href');
        var name = $(this).html();
        $('#freebe_name').val(name);
      
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            success: function(response){
              //alert("in success and here is response: " + response);
              var formURL = "/update-user-freebe-details/"; 
              var responseOBJ = response;
              var modalJSON = JSON.parse(responseOBJ);
              var newURL = formURL + modalJSON.id;
              //alert("Freebe name is: " + modalJSON.name );


              $("#formID2").attr("action", newURL);
              $("#freebe_name").val(modalJSON.name);
              $('#freebe_type').val(modalJSON.type_name);
              $('#freebe_details').val(modalJSON.details);
              $('#freebe_start_date').val(modalJSON.start_date);
              $('#freebe_end_date').val(modalJSON.end_date);
              //alert("Freebe name is: " + modalJSON.name );
              $("#modal-global2").modal('show');
            }
        });
    });
});

</script>

<!-- END SCRIPTS FOR UPDATING BUSINESSES AND FREEBES-->

@endsection





{{--@include('includes/usermodals')--}}

@section('footer')
    @include('includes.footer')
@endsection