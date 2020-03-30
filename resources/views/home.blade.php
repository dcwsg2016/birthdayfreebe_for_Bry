<?php //home.blade.php ?>

@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 

@section('customcss')

  <link rel="stylesheet" text="text/css" href="css/main.css">

@stop

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--You are logged in!--}}
                </div>
            </div>
        </div>
    </div>
{{--</div>--}}
<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Birthday Freebe</h3>
  <img src="img/bflogo.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Find free food and other things on your birthday!</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <div class="row">
  <div class="col-sm-4"> 
  </div>
  <div class="col-sm-4">
    <h3 class="margin">Check your location here by zip code </h3>
    @if(session()->has('message'))
      <div class="alert alert-success" role="alert">
          <strong>Success!</strong> {{session()->get('message')}}
      </div>
    @endif

    <form action="{{route('home-locations')}}" method="POST">

      <div class="form-group">
        <label for="pwd">Zip Code:</label>
        <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{old('zipcode')}}" required>
        @if($errors->has('zipcode'))
            <div class="alert alert-danger">
                {{ $errors->first('zipcode')}}
            </div>
        @endif
        <!--trying out autocomplete here -->
      <div id="zip_code_list" style="color:green;">
      </div></br>
     
      @csrf
      <button type="submit" class="btn btn-primary" name="form1">Submit Zipcode</button>
    </form>
  </br>
  </br>
    <h3>Or here by city and state </h3>
   
    <form action="{{route('home-locations')}}" method="POST">
      <div class="form-group">
        <label for="pwd">City:</label>
        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
        @if($errors->has('city'))
            <div class="alert alert-danger">
                {{ $errors->first('city')}}
            </div> 
        @endif
      </div></br>
      <div class="form-group">
        <label for="pwd">State:</label>
        <select class="form-control" id="state" name="state" value="{{old('state')}}" required>
            <option value="AL">AL</option>
            <option value="AK">AK</option>
            <option value="AR">AR</option>  
            <option value="AZ">AZ</option>
            <option value="CA">CA</option>
            <option value="CO">CO</option>
            <option value="CT">CT</option>
            <option value="DC">DC</option>
            <option value="DE">DE</option>
            <option value="FL">FL</option>
            <option value="GA">GA</option>
            <option value="HI">HI</option>
            <option value="IA">IA</option>  
            <option value="ID">ID</option>
            <option value="IL">IL</option>
            <option value="IN">IN</option>
            <option value="KS">KS</option>
            <option value="KY">KY</option>
            <option value="LA">LA</option>
            <option value="MA">MA</option>
            <option value="MD">MD</option>
            <option value="ME">ME</option>
            <option value="MI">MI</option>
            <option value="MN">MN</option>
            <option value="MO">MO</option>  
            <option value="MS">MS</option>
            <option value="MT">MT</option>
            <option value="NC">NC</option>  
            <option value="NE">NE</option>
            <option value="NH">NH</option>
            <option value="NJ">NJ</option>
            <option value="NM">NM</option>    
            <option value="NV">NV</option>
            <option value="NY">NY</option>
            <option value="ND">ND</option>
            <option value="OH">OH</option>
            <option value="OK">OK</option>
            <option value="OR">OR</option>
            <option value="PA">PA</option>
            <option value="RI">RI</option>
            <option value="SC">SC</option>
            <option value="SD">SD</option>
            <option value="TN">TN</option>
            <option value="TX">TX</option>
            <option value="UT">UT</option>
            <option value="VT">VT</option>
            <option value="VA">VA</option>
            <option value="WA">WA</option>
            <option value="WI">WI</option>  
            <option value="WV">WV</option>
            <option value="WY">WY</option>
      </select>
        <!--
        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">-->
        @if($errors->has('state'))
            <div class="alert alert-danger">
                {{ $errors->first('state')}}
            </div>
        @endif
      </div></br>
      @csrf
      <button type="submit" class="btn btn-primary" name="form2">Submit City and State</button>
    </form>
    
  </div>
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

 //$('#zip_code').keyup(function(){
 $('#zipcode').keyup(function(){ 
 //alert("in keyup statement"); 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();

         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
          
           $('#zip_code_list').fadeIn();  
           $('#zip_code_list').html(data);
           //$('#zip_code').fadeIn();  
           //$('#zip_code').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        //$('#zip_code').val($(this).text());
        $('zipcode').val($(this).text());  
        $('#zip_code_list').fadeOut(); 
        //$('#zip_code').fadeOut(); 
    });  

});
</script>

@section('footer')
    @include('includes.footer')
@endsection
