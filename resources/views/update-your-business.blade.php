<?php //update-your-business.blade.php ?>

<?php //add_your_business ?>

@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

<script>
  function confirmDelete(){
    confirm("Are you sure you want to delete this business?");
  }

  /*deleteData and formSubmit are for deleting businesses*/
  function deleteData(id)
     {
         var id = id;
         
         var url = "{{ route('delete-business', ':id') }}";
         
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

 function formSubmit()
     {
         $("#deleteForm").submit();
     } 
</script>

@section('content')
{{--{{dd($message)}}--}}
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
        <h3 class="margin">Here are all your businesses in our Birthday Freebe database:</h3>
        @if(isset($message_2))
            <p>{{$message_2}}</p>
        @endif
         @if (\Session::has('warning'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('warning') !!}</li>
                </ul>
            </div>
        @endif
        
        <!-- one i'm currently using to show success -->
        @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
        @endif

        {{--
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif--}}

        @if(isset($message))
        <div class="container">
        <div class="card bg-light text-dark">
          <div class="card-header"></div>
            <div class="card-body" style="color:red;">
              <p>{{$message}}</p>
              <p>(Click on the button of your business name to update)</p>
              
              
            </div>
            <div class="card-footer"></div>
          <!--</div>-->
        </div><!--end card bg-light text-dark -->
        </div><!-- end of class container -->
        </br></br>
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
                <td><a href="{{route('update-modal',$business->id)}}" class="btn btn-primary modal-global" id="business_name">{{$business->name}}</a></br></br>
                  <a href="javascript:;" data-toggle="modal"  onclick="deleteData('{{$business->id}}');"
                      data-target="#DeleteModal" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                  {{--
                  <form action="{{route('delete-business', $business->id)}}" method="POST" onsubmit="confirmDelete()">
                    <button type="submit" class="btn btn-danger btn-sm" id="delete_business">DELETE business</button>
                    @csrf
                  </form>--}}
                </td>
                <td>{{$business->id}}</td>
                <td>{{$business->type_name}}</td>
                <td class="business_email">{{$business->email}}</td>
                <td>{{$business->address}}</td>
                <td>{{$business->phone}}</td>
                <td>{{$business->city}}</td>
                <td>{{$business->state}}</td>
                <td>{{$business->zip_code}}</td>
                <!-- did have: locations.locationbusinesss', $location->zip_code --> 
                
              </tr>
              @endforeach
            </tbody>
          </table>
        
        @elseif(isset($message))
          <p>{{$message}}</p>
        @endif
       
       <!-- Button to Open the Modal -->
     </br>
     {{--
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-global">
          Open Form to Update Your Business Info
        </button>--}}</br></div>

        
    <!-- MODAL AREA -->

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
                      
                      <label for="business_state">Business State</label>
                      
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

    <!-- END MODAL AREA --> 

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



<script>
$(document).ready(function(){
  $('.modal-global').click(function(event) {
        event.preventDefault();
        //alert("in modal function.");

        var url = $(this).attr('href');
        //var name = $(this).attr('id').html();
        var name = $(this).html();
        
        $('#business_name').val(name);

        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',//can't return html, need to return json type to get 
            success: function(response){
              
              var formURL = "/update-your-business-details/"; 
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
              
              $("#modal-global").modal('show');
            }
        });
        
    });
});
</script>

@section('footer')
    @include('includes.footer')
@endsection



