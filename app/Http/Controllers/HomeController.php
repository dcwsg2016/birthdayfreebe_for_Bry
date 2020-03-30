<?php

namespace BirthdayFreebe\Http\Controllers;

use Illuminate\Http\Request;
use BirthdayFreebe\Freebe;
use BirthdayFreebe\Location;
use BirthdayFreebe\Business;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home-businesses', 'home', 'home-locations', 'home-freebes', '/', '/home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function home_freebes($business_id){

        $freebes = Freebe::where('business_id', '=', $business_id )->get();
        if(count($freebes) > 0){
            return view('home-freebes')->withDetails($freebes)->withQuery($business_id);
        }else{
            return view('home-freebes')->withMessage('Sorry. No freebes found');
        }
    
    }

    //note: this function was called locationbusinesses in LocationController
    public function home_businesses($zip_code){
        //
        $number_freebes_for_business = 0;
        $businesses = Business::where('zip_code', 'LIKE', $zip_code)->get();
        //$count_businesses = Business::where('zip_code', 'LIKE', $zip_code)->count();
        foreach($businesses as $business){
            $number_freebes_for_business = Freebe::where('business_id', '=', $business->id)->count();
        }   
        //$number_freebes_for_business = Freebe::where('business_id', '=', $businesses->id)->count();
        
        if(count($businesses) > 0){
            //return view('home_businesses')->withDetails($businesses)->withQuery($zip_code);
            //return view('home_businesses', compact('businesses'));
            return view('home-businesses', compact('businesses', 'number_freebes_for_business'));
        }else{
            //return view()->withMessage('No businesses found.');
            return view('home-businesses')->withMessage('Sorry. No businesses found.');
            //return view('locations.businesses');
        }

    }

    public function home_locations(Request $request){

        if($request->has('form1')){

            $validator = Validator::make($request->all(), [
                    'zipcode' => 'required',
             ]);

            if($validator->fails()){
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $enteredZipcode = Input::get('zipcode');

            $locations = Location::where('zip_code', 'LIKE', $enteredZipcode)->get();
            $number_businesses_in_location = Business::where('zip_code', $enteredZipcode)->count();
            if(count($locations) > 0){
                //had view('locations.index')
                return view('home-locations', compact('locations', 'number_businesses_in_location'));
                //return view('home-locations')->withDetails($locations)->withQuery($enteredZipcode);
            }else{
                //return abort(404);
                //had view('locations.index')
                return view('home-locations')->withMessage('No locations found. Try your search again.');
            }
        }else if($request->has('form2')){

            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'state' => 'required',
            ]);

            if($validator->fails()){
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            /*
            $name = explode('-', $id);

        $location = Location::where('city', $name[0])->where('state', $name[1])->orWhere('city', $name[1])->where('state', $name[0])->first();

            */

            $enteredCity = Input::get('city');
            $enteredState = Input::get('state');

            $locations = Location::where('city', 'LIKE', $enteredCity)->where('state', 'LIKE', $enteredState)->get();
            $number_businesses_in_location = Business::where('city', $enteredCity)->where('state', $enteredState)->count();
            if(count($locations) > 0){
                //had view ('locations.index')
                /*
                return view('home-locations')->withDetails($locations2)->withQuery($enteredCity)->
                    withQuery($enteredState);*/

                return view('home-locations', compact('locations', 'number_businesses_in_location'));
            }else{
                //had view('locations.index')
                return view('home-locations')->withMessage('No locations found. Try your search again');
            }
        } 
    
    }
}
