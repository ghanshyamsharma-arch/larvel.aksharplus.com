<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function index(Request $request)
    {

        $query = Page::query();


        // Filter Title

        if ($request->title) {

            $query->where('title', 'like', '%' . $request->title . '%');
        }


        // Filter Status

        if ($request->status != '') {

            $query->where('status', $request->status);
        }


        $pages = $query->latest()->paginate(10);


        return view('admin.pages.index', compact('pages'));
    }



    public function create()
    {

        return view('admin.pages.create');
    }


    public function store(Request $request)
    {

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('pages', 'public');
        }

        $seo_image = null;

        if ($request->hasFile('seo_image')) {

            $seo_image = $request->file('seo_image')->store('pages', 'public');
        }
        if ($request->hasFile('additional_image')) {
            $additionalImage = $request->file('additional_image')->store('pages', 'public');
        } else {
            $additionalImage = null;
        }

        Page::create([

            'title' => $request->title,

            'description' => $request->description,

            'image' => $image,

            'seo_title' => $request->seo_title,

            'seo_description' => $request->seo_description,

            'seo_keywords' => $request->seo_keywords,

            'seo_image' => $seo_image,

            'status' => $request->status,
            'additional_image' => $additionalImage

        ]);

        return redirect()->route('admin.pages.index');
    }


    public function edit(Page $page)
    {

        return view('admin.pages.edit', compact('page'));
    }


    public function update(Request $request, Page $page)
    {

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('pages', 'public');

            $page->image = $image;
        }

        if ($request->hasFile('seo_image')) {

            $seo_image = $request->file('seo_image')->store('pages', 'public');

            $page->seo_image = $seo_image;
        }
        if ($request->hasFile('additional_image')) {

            if ($page->additional_image) {
                Storage::disk('public')->delete($page->additional_image);
            }

            $page->additional_image = $request->file('additional_image')->store('pages', 'public');
        }

        $page->update([

            'title' => $request->title,

            'description' => $request->description,

            'seo_title' => $request->seo_title,

            'seo_description' => $request->seo_description,

            'seo_keywords' => $request->seo_keywords,

            'status' => $request->status

        ]);

        return redirect()->route('admin.pages.index');
    }


    public function destroy(Page $page)
    {

        $page->delete();

        return back();
    }
}
