<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }


    public function create()
    {
        return view('admin.announcements.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'announcement_date' => 'nullable|date',
            'status' => 'required'
        ]);

        Announcement::create($request->all());

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully');
    }


    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $announcement = Announcement::findOrFail($id);

        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated');
    }


    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
