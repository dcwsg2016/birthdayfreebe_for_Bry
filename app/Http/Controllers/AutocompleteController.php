<?php

namespace BirthdayFreebe\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller
{
    //
    function index(){
    	return view ('autocomplete');
    }

    function fetch(Request $request)
    {

    /*NOTE - commented out code below was for trying different ways to display or access the autocomplete values
    */
    
    //dd("in function fetch");
     if($request->get('query'))
     {
      $query = $request->get('query');
      //dd($query);
      $data = DB::table('locations')
        ->where('zip_code', 'LIKE', "%{$query}%")
        ->get();

        //$output = '<a href="#">';
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">'; 

        foreach($data as $row){

        	$output .= '<li><a href="#">'.$row->city.'&nbsp;'.$row->state.'</a></li>';
        	
        	//$output = '<a href="#">'.$row->zip_code.'&nbsp;'.$row->city.'&nbsp;'.$row->state.'</a>';

        	//$output = '<ul class="dropdown-menu" style="display:inline; position:relative"><li><a href="#">'.$row->zip_code.'&nbsp;'.$row->city.'&nbsp;'.$row->state.'</a></li></ul>';

        	//$output = '<ul class="dropdown-menu" style="display:inline; position:relative"><li><a href="#">'.$row->zip_code.'</a></li></ul>';

        	//$output .= $row->zip_code.'&nbsp;'.$row->state;
    	}
    	$output .= '</a>';
        echo $output;
      /*
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->zip_code.'&nbsp;'.$row->city.'&nbsp;'.$row->state.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;*/
     }
    }
}
