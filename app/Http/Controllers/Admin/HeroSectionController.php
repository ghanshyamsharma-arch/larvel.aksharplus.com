<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{

    public function index()
    {
        $data = HeroSection::latest()->get();
        return view('admin.hero.index', compact('data'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('hero', 'public');
        }

        HeroSection::create([
            'tagline' => $request->tagline,
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $image,
        ]);

        return redirect()->route('admin.hero.index');
    }

    public function edit(HeroSection $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroSection $hero)
    {

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('hero', 'public');

            $hero->image = $image;
        }

        $hero->update($request->except('image'));

        return redirect()->route('admin.hero.index');
    }

    public function destroy(HeroSection $hero)
    {
        $hero->delete();

        return back();
    }
}
