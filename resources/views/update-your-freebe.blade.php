<?php //update-your-freebe.blade.php ?>

@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@section('customcss')
  <link rel="stylesheet" text="text/css" href="css/main.css">
@stop

<script>
  
  function confirmDelete(){
    alert("Are you sure you want to delete this freebe?");
  }

  /*deleteData and formSubmit are for deleting freebes*/
  function deleteData(id)
     {
         var id = id;
         
         var url = "{{ route('delete-freebe', ':id') }}";
         
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

 function formSubmit()
     {
         $("#deleteForm").submit();
     } 
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

    <div class="col-sm-2">  
      </div>
      <div class="col-sm-8">
        <h4>Here are all your Freebes in our Birthday Freebe database:</h4>

        {{--
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        --}}

        <!-- this is the success message i'm currenlty using -->
        @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
        @endif

        @if(isset($details))
        <div class="container">
        <div class="card bg-light text-dark">
          <div class="card-header"></div>
            <div class="card-body" style="color:red;">
              <p>{{$message}}</p>
              <p>  
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
                <th>Freebe Type</th>
                <th>Freebe Details</th>
                <th>Freebe Start Date</th>
                <th>Freebe End Date</th>
              </tr>
            </thead>
            <tbody style="color:white;">
              
              @foreach($details as $freebe)
              <tr>
                <td><a href="{{route('update-freebe-modal', $freebe->id)}}" class="btn btn-primary modal-global" id="">{{$freebe->name}}</a></br></br>
                  <a href="javascript:;" data-toggle="modal"  onclick="deleteData('{{$freebe->id}}');"
                      data-target="#DeleteModal" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                  {{--
                  <form action="{{route('delete-freebe', $freebe->id)}}" method="POST" onsubmit="confirmDelete()">
                    <button type="submit" class="btn btn-danger btn-sm" id="delete_store">DELETE freebe</button>
                    @csrf
                  </form>--}}
                </td>
                <td>{{$freebe->details}}</td>
                <td>{{$freebe->type_name}}
                <td>{{$freebe->start_date}}</td>
                <td>{{$freebe->end_date}}</td>  
              </tr>
              @endforeach
            </tbody>
          </table>
        
        @elseif(isset($message))
          <p>{{$message}}</p>
        @endif

        <!-- Button to Open the Modal -->
     
     {{--
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-global">
          Open Form to Update Your Freebe Info
        </button>--}}</br></div>

        
    <!-- MODAL AREA -->

    <!-- The Modal -->
        <div class="modal fade" id="modal-global">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">

               <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title" style="color:black;">Your Current Freebe Information</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

<!-- NEED TO CONTINUE INPUTTING DATA HERE LIKE FOR update-your-business.blade.php --> 
              <!-- Modal body --> 
              <div class="modal-body" style="color:black;">
              <!-- controller return code from ajax would go here-->
              <form action="" method="POST" id="formID">
                <div id="modal_form">
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group text-left'>
                          <label for='freebe_name'>Freebe Name</label>
                          <input type='text' class='form-control' id='freebe_name' name='freebe_name' value='' required>
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

    <!-- END MODAL AREA --> 


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
      <img src="../img/pizzaRESIZED.png" class="../img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4">
      <p>Free Tacos!</p>
      <img src="../img/tacosRESIZED.png" class="../img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Free Burgers!</p>
      <img src="../img/burgerRESIZED.png" class="../img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>


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
                 <p class="text-center">Are you sure you want to delete this freebe?</p>
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

@endsection

<script>
$(document).ready(function(){
  $('.modal-global').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var name = $(this).html();
        
        $('#freebe_name').val(name);

        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',//can't return html, need to return json type to get 
            //dataType: 'json',
            success: function(response){
              
              var formURL = "/update-your-freebe-details/"; 
              var responseOBJ = response;
              var modalJSON = JSON.parse(responseOBJ);
              var newURL = formURL + modalJSON.id;
              
              $("#formID").attr("action", newURL);
              $('#freebe_name').val(modalJSON.name);
              $('#freebe_type').val(modalJSON.type_name);
              $('#freebe_details').val(modalJSON.details);
              $('#freebe_start_date').val(modalJSON.start_date);
              $('#freebe_end_date').val(modalJSON.end_date);
              
              $("#modal-global").modal('show');
            }
        });
        

    });
});
</script>

@section('footer')
    @include('includes.footer')
@endsection

