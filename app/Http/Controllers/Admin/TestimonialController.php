<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function index(Request $request)
    {

        $query = Testimonial::query();

        if ($request->name)
            $query->where('name', 'like', '%' . $request->name . '%');

        if ($request->status !== null)
            $query->where('status', $request->status);

        $testimonials = $query
            ->latest()
            ->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }



    public function create()
    {
        return view('admin.testimonials.create');
    }



    public function store(Request $request)
    {

        Testimonial::create($request->all());

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Created Successfully');
    }



    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }



    public function update(Request $request, Testimonial $testimonial)
    {

        $testimonial->update($request->all());

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Updated Successfully');
    }



    public function destroy(Testimonial $testimonial)
    {

        $testimonial->delete();

        return back()
            ->with('success', 'Deleted Successfully');
    }
}
