<?php

namespace BirthdayFreebe\Http\Controllers;

use Illuminate\Http\Request;
use BirthdayFreebe\Freebe;
//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use BirthdayFreebe\Location;
use BirthdayFreebe\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function user_page($user_id)
    {
        $message = "";

        $get_user_businesses = Business::where('user_id', '=', $user_id)->orderBy('name', 'ASC')->get();
        $get_user_freebes = Freebe::where('user_id', '=', $user_id)->orderBy('name', 'ASC')->get();
        //dd($get_user_freebes);

        if(count($get_user_businesses) == 0){
            $message = "No businesses found.";
            return view('user')->with($message);
        }else if(count($get_user_businesses) > 0){
            $message = "Here are your businesses ";
            if(count($get_user_freebes) == 0){
                $message = $message . "and no freebes found:";
                return view('user', compact('get_user_businesses', 'message'));
            }else if(count($get_user_freebes) > 0){
                $message = $message . "and your freebes:";
                //dd($get_user_businesses);
                return view('user', compact('get_user_businesses','get_user_freebes', 'message' ));
            }
        }
    }//end function user_page()

    public function update_user_business_modal($business_id){//this is a SHOW function too
        
        $business = Business::findOrfail($business_id);
        return $business;
    }//end function update_user_business_modal


    public function update_user_business_details(Request $request, $business_id){
        
        //$message_2 = " ";
        
        $validatedData = $request->validate([
            'business_name' => 'required',
            'business_type',
            'business_email',
            'business_address' => 'required',
            'business_phone' => 'required',
            'business_city' => 'required',
            'business_state',
            'business_zip' => 'required',
            'business_zip_hidden'

        ]);

        $business = Business::findOrfail($business_id);

        $business->name      = $request->input('business_name');
        $business->type_name = $request->input('business_type');
        $business->email     = $request->input('business_email');
        $business->address   = $request->input('business_address');
        $business->phone     = $request->input('business_phone');
        $business->city      = $request->input('business_city');
        $business->state     = $request->input('business_state');
        $business->zip_code  = $request->input('business_zip');
        $business_zip_code_hidden = $request->input('business_zip_hidden');
        //dd("hidden zip is: " . $business->zip_code_hidden);
        if($business->zip_code == $business_zip_code_hidden){//same zip code for both original and updated one, no need to update anything in locations table
            $business->save();
        }else{
            //find the updated zip_code in locations table:
            $locationzip = DB::table('locations')->where('zip_code', $business->zip_code)->first();
            $locationzip_original = DB::table('locations')->where('zip_code', $business_zip_code_hidden)->first();

                if($locationzip_original){//this only updates the old location number_of_businesses
                    $newNumBusinesses = $locationzip_original->number_of_businesses;
                    $newNumBusinesses--;

                    DB::table('locations')->where('zip_code', $business_zip_code_hidden)->update(['number_of_businesses' => $newNumBusinesses]);
                }

                if($locationzip){//zip code already in location table
                    $business->location_id = $locationzip->id;//business location_id gets this new location id
                    $num = $locationzip->number_of_businesses;
                    $num++;
                    //$locationzip->number_of_businesses++;
                    DB::table('locations')->where('id', $business->location_id)->update(['number_of_businesses' => $num]);
                $business->save();
                }else{//zip code NOT already in location table, so create new location row in location table
                        $newLocation = new Location();
                        $newLocation->city = $business->city;
                        $newLocation->state = $business->state;
                        $newLocation->zip_code = $business->zip_code; 
                        $newLocation->number_of_businesses = 1;
                        $newLocation->save();

                        $insertedID = $newLocation->id;

                        $business->location_id = $insertedID;
                        $business->save();

                }
        }
        $message = "You have successfully updated your business! Check below to see if everything looks okay.";
        return redirect()->back()->withMessage($message);

  	}//end function update_user_business_details

  	public function update_user_freebe_modal($freebe_id){

        $freebe = Freebe::findOrfail($freebe_id);

        return $freebe;
    }//end function update_user_freebe_modal

    public function update_user_freebe_details(Request $request, $freebe_id){

        //$message = " ";

        $validatedData = $request->validate([
            'freebe_name' => 'required',
            'freebe_type' => 'required', 
            'freebe_details' => 'required',
            'freebe_start_date' => 'required',
            'freebe_end_date' => 'required'
        ]);

        $freebe = Freebe::findOrfail($freebe_id);

        $freebe->name = $request->input('freebe_name');
        $freebe->details = $request->input('freebe_details');
        $freebe->type_name = $request->input('freebe_type');
        $freebe->start_date = $request->input('freebe_start_date');
        $freebe->end_date = $request->input('freebe_end_date');

        $freebe->save();
        
        $message = "You have successfully updated your freebe! Check below to see if everything looks okay.";

        return redirect()->back()->withMessage($message); 
    }//end function update_user_freebe_details


    public function add_user_business(Request $request){

        $message = "";

         $validator = Validator::make($request->all(),[  
                'business_name' => 'required',
                'business_type',
                'business_email',
                'business_address' => 'required', 
                //'business_phone' => 'required|regex:/(01)[0-9]{9}/',
                'business_phone' => 'required',
                //'business_phone',
                'business_city' => 'required', 
                'business_state' => 'required',
            'business_zip' => 'required|regex:/\b\d{5}\b/'
      ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        //note - maybe shouldn't increase number_of_businesses in locations table until we approve it first? 
        //or, could increase it, but then decrease it if business doesn't seem legit
        
        $business = new Business();

        $business->user_id = Auth::user()->id;
        $business->name = request('business_name');
        $business->type_name = request('business_type');
        $business->email = request('business_email');
        $business->address = request('business_address');
        $business->phone = request('business_phone');
        $business->city = request('business_city');
        $business->state = request('business_state');
        $business->zip_code = request('business_zip');

        //$business = 
        if(Business::where('name', '=', Input::get('business_name'))->where('address', '=', Input::get('business_address'))->count() == 0){
            $message = "Yay! Your business " . $business->name . " has been saved. Now, add the freebes for " .$business->name . "!";
            //$business->save();   
        }else{
            $message = "NOTE: You have already entered the business information for " . $business->name . ", below, at a previous time.";   
        } 

        $locationzip = DB::table('locations')->where('zip_code', $business->zip_code)->first();

        if($locationzip){//zip code already in location table
            $business->location_id = $locationzip->id;
            if(Business::where('name', '=', Input::get('business_name'))->count() == 0){
                $locationzip->number_of_businesses = $locationzip->number_of_businesses + 1;
                DB::table('locations')->where('id', $locationzip->id)->update(['number_of_businesses' => $locationzip->number_of_businesses]);
                
                $business->save();
            }
            
        }else{//zip code NOT already in location table, so create new location row in location table
            $newLocation = new Location();
            $newLocation->city = $business->city;
            $newLocation->state = $business->state;
            $newLocation->zip_code = $business->zip_code; 
            $newLocation->number_of_businesses = 1;
            $newLocation->save();

            $insertedID = $newLocation->id;

            $business->location_id = $insertedID;
            $business->save();
        
        }

        return redirect()->back()->withMessage($message);
    }//end function add_user_business

    public function add_user_freebe_modal($business_id){
        //dd("in add_user_freebe_modal function");
        $business = Business::findOrFail($business_id);
        return $business;
    }//end function add_user_freebe_modal

    public function user_add_freebe($business_id){

        $business = Business::where('id', $business_id)->firstOrFail();

        return view('user-add-freebe', compact('business'));
    }//end function user_add_freebe


    public function add_user_freebe(Request $request, $business_id){

        //dd("in add_user_freebe");

        $validator = Validator::make($request->all(),[ 
                'freebe_name' => 'required',
                'freebe_type',
                'freebe_details',
                'freebe_start_date' => 'required',
                'freebe_end_date' => 'required'             
      ]);
        //dd($validator);
        //dd("freebe details is: " . request('freebe_details'));
        
        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $freebe = new Freebe();
        $freebe->business_id = $business_id; //request('freebe_business_id');
        $freebe->user_id = Auth::user()->id;
        $freebe->name = request('freebe_name');
        $freebe->type_name = request('freebe_type');
        $freebe->details = request('freebe_details');
        $freebe->start_date = request('freebe_start_date');
        $freebe->end_date = request('freebe_end_date');
        
        //dd($freebe->details);

        $business_locationID = DB::table('businesses')->where('id', $freebe->business_id)->first();
        
        $message = "";
        
        
            if($business_locationID){
                $freebe->location_id = $business_locationID->location_id;
                
                if(Freebe::where('business_id', '=', $business_locationID->id )->where('name', '=', Input::get('freebe_name'))->where('start_date','=', Input::get('freebe_start_date'))->where('end_date','=', Input::get('freebe_end_date'))->where('type_name', '=', Input::get('freebe_type'))->count() == 0){
                    
                    $business_locationID->number_of_freebes++;
                    
                   DB::table('businesses')->where('id', $business_locationID->id)->update(['number_of_freebes' => $business_locationID->number_of_freebes ]);
                   
                    $freebe->save();
                    
                    $message = "Yay! Your Freebe ".$freebe->name." has been saved. Click on the button below corresponding to ".$freebe->name." if you need to edit anything.";

                }else{ 
                    $message = "It appears your Freebe, " . $freebe->name . " has already been added to our database. But click on your Freebe's button name below if you need to edit anything."; 
                }
            }
            $user_id = Auth::user()->id;
            
            return redirect()->route('user', $user_id)->withMessage($message);

    }//end function add_user_freebe


    public function delete_user_business($business_id){

        $business = Business::findOrFail($business_id);
        $message = "You have successfully deleted " .$business->name  . " from the database.";
        //dd($business);
        $business->delete($business_id);
        //dd("after delete business");
        $update_location_amount = Location::where('id', '=', $business->location_id)->first();

        if($update_location_amount){
          $update_location_amount->number_of_businesses--;
          //dd("number of businesses now:" . $update_location_amount->number_of_businesses);
          $update_location_amount->save();
        }else{
            //nothing for now
            dd("We are sorry. We could not update the location data for this business.");
        }

        $update_freebe_amount = Freebe::where('business_id', '=', $business->id)->delete();//i think this deletes all freebes with the same business id
        return redirect()->back()->withMessage($message);

    }//end function delete_user_business


    public function delete_user_freebe($freebe_id){

        $freebe = Freebe::findOrFail($freebe_id);
        $message = "You have successfully deleted " .$freebe->name  . " from the database.";

        $freebe->delete($freebe_id);

        $update_freebe_amount = Business::where('id', '=', $freebe->business_id)->first();

        if($update_freebe_amount){
            $update_freebe_amount->number_of_freebes--;
            $update_freebe_amount->save();
        }else{
            dd("We are sorry. We could not update the freebe data for this freebe.");
        }
        return redirect()->back()->withMessage($message);

    }//end function delete_user_freebe


}//end UserController class
