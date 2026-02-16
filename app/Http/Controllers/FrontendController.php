<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\HeroSection;
use App\Models\Media;
use App\Models\Page;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;

class FrontendController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::get();
        $services = Service::where('status', 'active')
            ->get();
        $included = Page::where('id', 1)->first();
        $video = Page::where('id', 2)->first();
        $multi = Page::where('id', 3)->first();
        $smartMessage = Page::where('id', 4)->first();
        $reviewSec = Page::where('id', 5)->first();
        //Media
        $images = Media::where('type', 'image')->get();

        $videos = Media::where('type', 'video')->get();

        $audio = Media::where('type', 'audio')->get();

        $docs = Media::where('type', 'document')->get();

        $links = Media::where('type', 'link')->get();


        $services = Service::where('status', 'active')
            ->get();
        $stats = [
            'users'     => User::where('status', 'active')->count() ?: 50000,
            'companies' => Company::where('status', 'active')->count() ?: 2000,
        ];
        $testimonials = Testimonial::where('status', true)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('frontend.home', compact('stats', 'testimonials', 'heroes', 'services', 'included', 'video', 'multi', 'smartMessage', 'images', 'videos', 'audio', 'docs', 'links', 'reviewSec'));
    }
}
