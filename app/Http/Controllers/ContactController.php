<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'company' => 'nullable|string|max:100',
            'message' => 'required|string|max:1000',
            'source'  => 'nullable|string|max:50',
        ], [
            'name.required'  => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.email'    => 'Please enter a valid email',
            'message.required'    => 'Please enter a message',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            Contact::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'company'    => $request->company,
                'message'    => $request->message,
                'source'     => $request->source ?? 'website',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_read'    => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! We\'ll get back to you soon.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
}
