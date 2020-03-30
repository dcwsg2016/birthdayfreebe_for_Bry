<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Main / page route: 
Route::get('/', function () {
    return view('home');
});

//Auth route: 
Auth::routes();

//About page route: 
Route::get('/about', function(){
  return view('about');
});

//Contact page routes: 
Route::get('contact', 'ContactFormController@create');
Route::post('contact', 'ContactFormController@business');

//Home Controller routes(for non-logged-in users to search for businesses and freebes): 
Route::get('/home', 'HomeController@index')->name('home');

Route::post('home-locations', 'HomeController@home_locations')->name('home-locations');

Route::get('home-freebes/{business_id}', 'HomeController@home_freebes')->name('home-freebes');

Route::get('home-businesses/{zip_code}', 'HomeController@home_businesses')->name('home-businesses');

//Businesses: Add_Your_Business routes (must be logged-in): 
Route::get('/add-your-business', function(){
  return view('add-your-business');
})->middleware(['auth']);

Route::post('add-your-business-details', 'BusinessController@add_your_business_details')->name('add-your-business-details')->middleware(['auth']);

//Freebes - add freebes routes (must be logged-in): 
Route::get('/add-your-freebe-details/{business_id}','FreebeController@add_your_freebe_details')->name('add-your-freebe-details')->middleware(['auth']); 

Route::get('/freebe-details', 'FreebeController@freebe_details')->name('freebe-details')->middleware(['auth']);

Route::post('freebe-details', 'FreebeController@add_your_freebe_details_post')->name('freebe-details')->middleware(['auth']);

//Businesses - Update and Delete businesses (must be logged-in): 
Route::get('/update-your-business', 'BusinessController@update_your_business')->name('update-your-business')->middleware(['auth']);

Route::get('/update-modal/{business_id}', 'BusinessController@update_modal')->name('update-modal')->middleware(['auth']);

Route::post('/update-your-business-details/{business_id}', 'BusinessController@update_your_business_details')->name('update-your-business-details')->middleware(['auth']);

Route::post('/delete-business/{business_id}', 'BusinessController@delete_business')->name('delete-business')->middleware(['auth']);

Route::get('/update-your-business-details/{business_id}', 'BusinessController@update_your_business_details')->name('update-your-business-details')->middleware(['auth']); 

//Freebes - Updates and Deletes freebes (must be logged-in): 
Route::get('/update-your-freebe/{business_id}', 'FreebeController@update_your_freebe')->name('update-your-freebe')->middleware(['auth']);

Route::get('/update-freebe-modal/{freebe_id}', 'FreebeController@update_freebe_modal')->name('update-freebe-modal')->middleware(['auth']);

Route::post('/update-your-freebe-details/{freebe_id}', 'FreebeController@update_your_freebe_details')->name('update-your-freebe-details')->middleware(['auth']);

Route::post('/delete-freebe/{freebe_id}', 'FreebeController@delete_freebe')->name('delete-freebe')->middleware(['auth']);

Route::get('/show-freebes', 'FreebeController@show-freebes')->name('show-freebes')->middleware(['auth']);


//USER PAGE - routes: 

Route::get('/user/{user_id}', 'UserController@user_page')->name('user')->middleware(['auth']);

Route::get('/delete-user-business/{business_id}', 'UserController@delete_user_business')->name('delete-user-business')->middleware(['auth']);

Route::post('/delete-user-business/{business_id}', 'UserController@delete_user_business')->name('delete-user-business')->middleware(['auth']);

Route::post('/delete-user-freebe/{freebe_id}', 'UserController@delete_user_freebe')->name('delete-user-freebe')->middleware(['auth']);

Route::get('/update-user-business-modal/{business_id}', 'UserController@update_user_business_modal')->name('update-user-business-modal')->middleware(['auth']); 

Route::post('/update-user-business-details/{business_id}', 'UserController@update_user_business_details')->name('update-user-business-details')->middleware(['auth']);

Route::get('/update-user-freebe-modal/{freebe_id}', 'UserController@update_user_freebe_modal')->name('update-user-freebe-modal')->middleware(['auth']);

Route::post('/update-user-freebe-details/{freebe_id}', 'UserController@update_user_freebe_details')->name('update-user-freebe-details')->middleware(['auth']);

Route::post('/add-user-business', 'UserController@add_user_business')->name('add-user-business')->middleware(['auth']);

Route::post('/add-user-freebe/{business_id}', 'UserController@add_user_freebe')->name('add-user-freebe')->middleware(['auth']); 

Route::get('/add-user-freebe-modal/{business_id}', 'UserController@add_user_freebe_modal')->name('add-user-freebe-modal')->middleware(['auth']);

Route::get('/user-add-freebe/{business_id}', 'UserController@user_add_freebe')->name('user-add-freebe')->middleware(['auth']); 


//Autocomplete Test:
Route::get('/autocomplete', 'AutocompleteController@index');

Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');


