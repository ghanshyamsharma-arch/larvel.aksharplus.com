<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform'   => 'required|string|max:50',
            'label'      => 'required|string|max:100',
            'url'        => 'required|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        SocialLink::create([
            'platform'   => $request->platform,
            'label'      => $request->label,
            'url'        => $request->url,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link added!');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'platform'   => 'required|string|max:50',
            'label'      => 'required|string|max:100',
            'url'        => 'required|url|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $socialLink->update([
            'platform'   => $request->platform,
            'label'      => $request->label,
            'url'        => $request->url,
            'is_active'  => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link updated!');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link deleted!');
    }

    public function toggleStatus(SocialLink $socialLink)
    {
        $socialLink->update(['is_active' => !$socialLink->is_active]);
        return back()->with('success', 'Status updated!');
    }

    // Drag-drop sort order save
    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $i => $id) {
            SocialLink::where('id', $id)->update(['sort_order' => $i + 1]);
        }
        return response()->json(['success' => true]);
    }
}
