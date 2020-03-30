
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
                      <script>$('#business_state').val('{$store->state}');</script>-->
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



<!-- ADD USER FREEBE MODAL in  user.blade.php -->

 <!-- The Modal -->
        <div class="modal fade" id="modalAddFreebe">
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
              <form action="{{route('add-user-freebe', $store->id)}}" method="POST" id="formID2">
                <div id="modal_form">
                    <div class='row'>
                      <div class='col-sm-2'>
                        <div class='form-group text-left'>
                          <label for='freebe_name'>Freebe Store ID</label>
                          <input type="text" class="form-control" id="freebe_store_id" name="freebe_store_id" value="{{$store->id}}">
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