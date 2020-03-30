<?php

$locations = Location::where('city', 'LIKE', $enteredCity)->where('state', 'LIKE', $enteredState)->get();
            $number_businesses_in_location = Business::where('city', $enteredCity)->where('state', $enteredState)->count();
            if(count($locations) > 0){
                //had view ('locations.index')
                /*
                return view('home_locations')->withDetails($locations2)->withQuery($enteredCity)->
                    withQuery($enteredState);*/

                return view('home_locations', compact('locations', 'number_businesses_in_location'));
            }else{
                //had view('locations.index')
                return view('home_locations')->withMessage('No locations found. Try your search again');
            }

?>