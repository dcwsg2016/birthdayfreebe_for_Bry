<?php

namespace BirthdayFreebe\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use BirthdayFreebe\Freebe;
use BirthdayFreebe\Location;
use BirthdayFreebe\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    //
    public function add_your_business_details(Request $request){

        
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
            return redirect('add_your_business')
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

        $locationzip = DB::table('locations')->where('zip_code', $business->zip_code)->first();

        //$location = Location::where('zip_code', '=', $business->zip_code)->get();

        if($locationzip){//zip code already in location table
            $business->location_id = $locationzip->id;
            if(Business::where('name', '=', Input::get('business_name'))->count() == 0){
                $locationzip->number_of_businesses = $locationzip->number_of_businesses + 1;
                DB::table('locations')->where('id', $locationzip->id)->update(['number_of_businesses' => $locationzip->number_of_businesses]);
                //DB::table('locations')->insert(['number_of_businesses' => $locationzip->number_of_businesses]);
            }
            
        }else{//zip code NOT already in location table, so create new location row in location table
            $newLocation = new Location();
            $newLocation->city = $business->city;
            $newLocation->state = $business->state;
            $newLocation->zip_code = $business->zip_code; 
            $newLocation->number_of_businesses = 1;
            $newLocation->save();
        
        }

        //SO, because $newLocation was just created, and i don't know how to get the assigned id, i did the Location query below so to add the id to $business->save()
        $searchLocationID = Location::where('zip_code', '=', $business->zip_code)->first();
        if($searchLocationID){
            $business->location_id = $searchLocationID->id;
        }else{
            $business->location_id = 0;
        }


        $message = "";
        //$business = 
        if(Business::where('name', '=', Input::get('business_name'))->where('address', '=', Input::get('business_address'))->where('zip_code', '=', Input::get('business_zip'))->count() == 0){
            $message = "Yay! Your business information has been saved. Now, add your business freebes! (click the button below)";
            $business->save();
            //return redirect()->route('add_your_business_details')->withInput();
            //return redirect()->route('add_your_business_details')->with('success', [$message])->withInput();
        }else{
            $message = "NOTE: You have already entered the business information below at a previous time.";
            //return redirect()->route('add_your_business_details')->withInput();
            //return redirect()->route('add_your_business_details'')->withErrors($message)->withInput();
        } 

        //search businesses to get business details so can send back to user to verify they entered it right
        $show_business_details = Business::where('user_id', '=', $business->user_id)->where('name','=', $business->name)->where('address', '=',$business->address )->get();
        //$show_business_details = DB::table('businesses')->where('user_id', $business->user_id)->first();
        if(count($show_business_details) >= 1){
        //if($show_business_details){
            //dd("in if to return view");
            return view('add-your-business-details')->withMessage($message)->withDetails($show_business_details)->withQuery($business->user_id); 
        }else{
            return view('add-your-business-details')->withMessage('Sorry. No business details found.');
        }
    }//end add_your_business_details

    public function update_your_business(){//this function shows all the businesses associated with the user, so its a SHOW function

        $message = " ";

        $user_id = Auth::user()->id;

        $businesses_to_update = Business::where('user_id', '=', $user_id)->orderBy('name', 'ASC')->get();

        //dd($businesses_to_update);
        if(count($businesses_to_update) == 0){
            $message = "No businesses were found.";
            return view('update-your-business')->withMessage($message);
        }else{
            $message = "Here are your businesses to update:";
            //dd($message);
            return view('update-your-business')->withMessage($message)->withDetails($businesses_to_update)->withQuery($user_id);
        }
        //return view('update-your-business');
        
    }//end function update_your_business

    public function update_modal($business_id){//this is a SHOW function too
        
        $business = Business::findOrfail($business_id);
        return $business;
    }

    /*
    //This function below is simply to access the page while working on it:
    public function update_your_business_details2(){
        return view('update-your-business-details');
    }*/

    public function update_your_business_details(Request $request, $business_id){
        //NOTE THIS FUNCTION IS NOT COMPLETED YET AND WON'T WORK RIGHT YET - YES, ITS DONE NOW

        $message_2 = " ";
        
        $validatedData = $request->validate([
            'business_name' => 'required',
            'business_type',
            'business_email',
            'business_address' => 'required',
            'business_phone' => 'required',
            'business_city' => 'required',
            'business_state',
            'business_zip' => 'required'

        ]);

        /*
        $business_zip_code_hidden below is in case the user had originally inputted the wrong zip code or city, but mainly it's about the wrong zip code - and then user updated 
        to a new zip code, the code below $business_zip_code_hidden takes care of that
        */

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
        /*
        $business->save();
        $message_2 = "It worked!";*/
        //dd($message);
        if($business->zip_code == $business_zip_code_hidden){//same zip code for both original and updated one, no need to update anything in locations table
            $business->save(); 
        }else{
            //find the updated zip_code in locations table:
            $locationzip = DB::table('locations')->where('zip_code', $business->zip_code)->first();
            $locationzip_original = DB::table('locations')->where('zip_code', $business_zip_code_hidden)->first();

                if($locationzip_original){//this only updates the old location number_of_businesses
                    $newNumBusineses = $locationzip_original->number_of_busineses;
                    $newNumBusinesses--;

                    DB::table('locations')->where('zip_code', $business_zip_code_hidden)->update(['number_of_businesss' => $newNumBusineses]);
                }
            
                if($locationzip){//zip code already in location table
                    $business->location_id = $locationzip->id;//business location_id gets this new location id
                    $num = $locationzip->number_of_busineses;
                    $num++;
                    //$locationzip->number_of_busineses++;
                    DB::table('locations')->where('id', $business->location_id)->update(['number_of_busineses' => $num]);

                    $business->save();
                        
                }else{//zip code NOT already in location table, so create new location row in location table
                        $newLocation = new Location();
                        $newLocation->city = $business->city;
                        $newLocation->state = $business->state;
                        $newLocation->zip_code = $business->zip_code; 
                        $newLocation->number_of_busineses = 1;
                        $newLocation->save();

                        $insertedID = $newLocation->id;

                        $business->location_id = $insertedID;
                        $business->save();

                }
        }

        $message = "You have successfully updated your business! Check below to see if everything looks okay.";

        return redirect()->back()->withMessage($message);
        //return redirect()->back()->with('success', 'You have successfully updated your business! Check below to see if everything looks okay.');

    }


    public function delete_business($business_id){

        $business = Business::findOrFail($business_id);
        //dd($store);
        $business->delete($business_id);
        //dd("after delete store");
        $update_location_amount = Location::where('id', '=', $business->location_id)->first();

        if($update_location_amount){
            if($update_location_amount->number_of_businesses > 0){
                $update_location_amount->number_of_businesses--;
                $update_location_amount->save();
            }
          //dd("number of stores now:" . $update_location_amount->number_of_stores);
          
        }else{
            //nothing for now
            dd("We are sorry. We could not update the location data for this store.");
        }

        $update_promotion_amount = Freebe::where('business_id', '=', $business->id)->delete();//i think this deletes all promotions with the same store id
        //$update_location = Location::where()

        return redirect()->back()->with('success', 'You have successfully deleted your business from the database.');

    }


}
