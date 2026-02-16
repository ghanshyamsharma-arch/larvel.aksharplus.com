<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function index(Request $request)
    {

        $query = Media::query();

        if ($request->type) {

            $query->where('type', $request->type);
        }

        $media = $query->latest()->paginate(10);

        return view('admin.media.index', compact('media'));
    }



    public function create()
    {

        return view('admin.media.create');
    }



    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'type' => 'required',

            'file' => 'nullable|file',

            'thumbnail' => 'nullable|image',

        ]);


        $filePath = null;
        $thumbPath = null;



        if ($request->file('file')) {

            $file = $request->file('file');

            $filePath =
                $file->store('media', 'public');

            $size = $file->getSize();
        }


        if ($request->file('thumbnail')) {

            $thumbPath =
                $request->file('thumbnail')
                ->store('media/thumb', 'public');
        }


        Media::create([

            'title' => $request->title,

            'type' => $request->type,

            'file' => $filePath,

            'link' => $request->link,

            'thumbnail' => $thumbPath,

            'size' => $request->size

        ]);


        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Media Created');
    }



    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }



    public function update(Request $request, Media $media)
    {

        $filePath = $media->file;
        $thumbPath = $media->thumbnail;



        if ($request->file('file')) {

            if ($media->file) {
                // Storage::disk('public')->delete($media->file);
            }
            $file = $request->file('file');

            $filePath =
                $file->store('media', 'public');
        }


        if ($request->file('thumbnail')) {

            // Storage::disk('public')->delete($media->thumbnail);

            $thumbPath =
                $request->file('thumbnail')
                ->store('media/thumb', 'public');
        }


        $media->update([

            'title' => $request->title,

            // 'type' => $request->type,

            'file' => $filePath,

            'link' => $request->link,

            'thumbnail' => $thumbPath,

            'size' =>  $request->size

        ]);


        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Updated');
    }



    public function destroy(Media $media)
    {

        if ($media->file) {
            Storage::disk('public')->delete($media->file);
        }

        if ($media->thumbnail) {
            Storage::disk('public')->delete($media->thumbnail);
        }

        $media->delete();

        return back()->with('success', 'Deleted');
    }
}
