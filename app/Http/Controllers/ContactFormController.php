<?php

namespace BirthdayFreebe\Http\Controllers;

//use App\Mail\ContactFormMail;
use BirthdayFreebe\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    //
    public function create(){

    	return view('contact.create');
    }

    public function store(){

        $message = "";

    	$data = request()->validate([
    		'name' => 'required',
    		'email' => 'required|email',
    		'message' => 'required'
    	]);


    	//Send an email
    	Mail::to('test@test.com')->send(new ContactFormMail($data));
        $message = "Your message has been successfully sent. We will be in touch with you soon.";

        ///This is another way to do the return message:
        //session()->flash('message', $message);
        //return redirect('contact');

    	return redirect('contact')->withMessage($message);
    	//dd(request()->all());
    }
}
