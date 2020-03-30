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

class FreebeController extends Controller
{
    //
    public function businessFreebes($business_id){

        $promotions = Freebe::where('business_id', '=', $business_id)->get();
        if(count($promotions) > 0){
            return view('promotions.index')->withDetails($promotions)->withQuery($business_id);
        }else{
            return view('promotions.index')->withMessage('Sorry. No promotions found.');
        } 
    }

    /*
    public function add_your_freebe($business_id){
        //
    }*/
    public function add_your_freebe_details($business_id){
        //$this->business_id = $business_id; 
        return view('add-your-freebe-details')->with('business_id', $business_id);
    }

    /*
    public function save_freebe_details(){
        return view('save-freebe-details');
    }*/

    public function freebe_details(){
        return view('freebe-details');
    }

    public function add_your_freebe_details_post(Request $request){

        $validator = Validator::make($request->all(),[ 
                'freebe_d' => 'required', 
                'freebe_business_id', 
                'freebe_name' => 'required',
                'freebe_type' => 'required',
                'freebe_start_date' => 'required',
                'freebe_end_date' => 'required'             
      ]);
        //dd($validator);
        
        if($validator->fails()){
            return redirect('freebe-details')
                ->withErrors($validator)
                ->withInput();
        }
        
        $freebe = new Freebe();
        $freebe->business_id = request('freebe_business_id');
        //dd($freebe->business_id);
        $freebe->user_id = Auth::user()->id;
        $freebe->name = request('freebe_name');
        $freebe->type_name = request('freebe_type');
        $freebe->details = request('freebe_d');
        $freebe->start_date = request('freebe_start_date');
        $freebe->end_date = request('freebe_end_date');
        
        

        $business_locationID = DB::table('businesses')->where('id', '=', $freebe->business_id)->first();
        
        //dd($freebe->business_id);
        $message = "";
        
        
        if($business_locationID){
            $freebe->location_id = $business_locationID->location_id;
            
            if(Freebe::where('business_id', '=', $business_locationID->id )->where('name', '=', Input::get('freebe_name'))->where('start_date','=', Input::get('freebe_start_date'))->where('end_date','=', Input::get('freebe_end_date'))->where('type_name', '=', Input::get('freebe_type'))->count() == 0){
                
                $business_locationID->number_of_freebes++;
                
               DB::table('businesses')->where('id', $business_locationID->id)->update(['number_of_freebes' => $business_locationID->number_of_freebes ]);
               
                $freebe->save();
                
                $message = "Yay! Your Freebe information has been saved. Click on the button below if you need to edit anything.";

            }else{ 
                $message = "It appears your business already added this Freebe to our database. But click on the button below if you need to edit anything."; 
            }

        } 
        //dd($message);
        
        $show_freebe_details = Freebe::where('name', '=', $freebe->name)->where('user_id', '=', $freebe->user_id)->where('start_date', '=', $freebe->start_date)->where('end_date', '=', $freebe->end_date)->get();
        

        if(count($show_freebe_details) >=1){
            
            //dd($message);
            //var_dump($message);

            return view('freebe-details', compact('show_freebe_details'))->withMessage($message);

            //return view('save-freebe-details')->withMessage($message)->withDetails($show_freebe_details)->withQuery($freebe->name);
        }else{
            return view('freebe-details')->withMessage('No Freebe details found');
        }
    }


    public function update_your_freebe($business_id){

        //$message = "";
        $message = " ";

        //$user_id = Auth::user()->id;

        $freebes_to_update = Freebe::where('business_id','=', $business_id)->orderBy('name', 'ASC')->get();

        //$businesses_to_update = business::where('user_id', '=', $user_id)->orderBy('name', 'ASC')->get();

        //dd($businesses_to_update);
        if(count($freebes_to_update) == 0){
            $message = "No freebes were found.";
            return view('update-your-freebe')->withMessage($message);//was view('show-freebes')->withMessage($message);
        }else{
            $message = "Here are your freebes to update:";
            //dd($message);
            return view('update-your-freebe')->withMessage($message)->withDetails($freebes_to_update)->withQuery($business_id);
        }


    }

    public function update_freebe_modal($freebe_id){

        $freebe = Freebe::findOrfail($freebe_id);

        return $freebe;
    }

    public function update_your_freebe_details(Request $request, $freebe_id){

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
        //$message = "It worked"

        $message = "You have successfully updated your freebe! Check below to see if everything looks okay.";

        return redirect()->back()->withMessage($message);

        //return redirect()->back()->with('success', 'You have successfully updated your freebe! Check below to see if everything looks okay.');
    }

    public function delete_freebe($freebe_id){

        $freebe = Freebe::findOrfail($freebe_id);

        $freebe->delete($freebe_id);

        $update_freebe_amount = Business::where('id', '=', $freebe->business_id)->first();

        if($update_freebe_amount){
            $update_freebe_amount->number_of_freebes--;
            $update_freebe_amount->save();
        }else{
            dd("We are sorry. We could not update the business data for this freebe (freebe).");
        }

        return redirect()->back()->with('success', 'You have successfully deleted your freebe from the database.');

    }
}
