<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function showContact()
    {
        return view('contact');
    }

    public function storeContact(ContactRequest $request, ContactService $service)
    {
        try{
            $service->sendEmail($request);
            return back()->with('success', 'Thanks for contacting us!'); 
        }catch(Exception $e){
            \Log::error('Send email error - '.$e);
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }
    }
}
