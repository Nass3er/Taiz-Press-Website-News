<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;


class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:subscribers', // Ensure a valid and unique email
        ]);
        // Create a new subscriber instance
        $subscriber = new Subscriber([
            'email' => $request->email,
        ]);
        // Save the subscriber to the database
        $subscriber->save();
          return redirect()->back();
    }

}
