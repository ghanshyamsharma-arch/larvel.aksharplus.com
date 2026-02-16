<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|unique:subscribers,email'
            ],
            [
                'email.unique' => 'This email is already subscribed.'
            ]
        );

        Subscriber::create([
            'email' => $request->email
        ]);

        return back()->with('success', 'Subscribed successfully!');
    }

    public function index()
    {

        $subscribers =
            Subscriber::latest()->paginate(10);

        return view(
            'admin.subscribers.index',
            compact('subscribers')
        );
    }
}
