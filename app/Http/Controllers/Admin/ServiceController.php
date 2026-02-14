<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index(Request $request)
    {

        $query = Service::query();

        // Filter Name
        if ($request->name)
        {
            $query->where('name','like','%'.$request->name.'%');
        }

        // Filter Status
        if ($request->status)
        {
            $query->where('status',$request->status);
        }

        $services = $query->latest()->paginate(10);

        return view('admin.services.index',compact('services'));

    }



    public function create()
    {

        return view('admin.services.create');

    }



    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',

            'description'=>'nullable',

            'file'=>'required|file',

            'status'=>'required'

        ]);


       $file = null;

    if ($request->hasFile('file')) {

        $file = $request->file('file')->store('services', 'public');

    }

        Service::create([

            'name'=>$request->name,

            'description'=>$request->description,

            'file'=>$file,

            'status'=>$request->status

        ]);


        return redirect()
->route('admin.services.index')
->with('success', 'Service Created');

    }



    public function edit($id)
    {

        $service = Service::findOrFail($id);

        return view('admin.services.edit',compact('service'));

    }



    public function update(Request $request,$id)
    {

        $service = Service::findOrFail($id);


        if ($request->hasFile('file')) {

        $file = $request->file('file')->store('services', 'public');

        $service->file = $file;

    }

        $service->update([

            'name'=>$request->name,

            'description'=>$request->description,

            'status'=>$request->status

        ]);


        return redirect()
->route('admin.services.index')
->with('success','Service Updated');

    }



    public function destroy($id)
    {

        Service::destroy($id);

        return back()->with('success','Deleted');

    }


}
