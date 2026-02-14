<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\HeroSection;
use App\Models\Page;
use App\Models\Service;
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


        $services = Service::where('status', 'active')
            ->get();
        $stats = [
            'users'     => User::where('status', 'active')->count() ?: 50000,
            'companies' => Company::where('status', 'active')->count() ?: 2000,
        ];

        $testimonials = [
            ['name' => 'Sonia Rao',    'role' => 'Creative Director · Pixelcraft',   'initials' => 'SR', 'grad' => 'linear-gradient(135deg,#e91e8c,#7c3aed)', 'text' => 'The multi-company workspace is a game-changer. We manage 6 client accounts from one login and the isolation between workspaces is flawless.', 'stars' => 5],
            ['name' => 'Arjun Mehta',  'role' => 'CTO · NovaByte Technologies',      'initials' => 'AM', 'grad' => 'linear-gradient(135deg,#2563eb,#06b6d4)', 'text' => 'We replaced 4 tools with just Akshar Plus. The media library alone saved us hours of file hunting every week.', 'stars' => 5],
            ['name' => 'Priya Kapoor', 'role' => 'Head of Ops · LaunchPad HQ',       'initials' => 'PK', 'grad' => 'linear-gradient(135deg,#f97316,#fbbf24)', 'text' => 'Pinned messages and scheduled broadcasts have transformed how we run company-wide communications.', 'stars' => 5],
            ['name' => 'Vikram Bose',  'role' => 'Engineering Lead · CloudScale',    'initials' => 'VB', 'grad' => 'linear-gradient(135deg,#7c3aed,#06b6d4)', 'text' => 'Video call quality is outstanding and the noise cancellation is exceptional. Our remote team feels more connected than ever.', 'stars' => 5],
            ['name' => 'Neha Joshi',   'role' => 'Product Manager · MarketPulse',    'initials' => 'NJ', 'grad' => 'linear-gradient(135deg,#e91e8c,#f97316)', 'text' => 'Scheduled messages have made our global async communication effortless. I draft messages in the evening and they send at the right local time.', 'stars' => 5],
            ['name' => 'Rohan Sharma', 'role' => 'Podcast Producer · WaveCast',      'initials' => 'RS', 'grad' => 'linear-gradient(135deg,#06b6d4,#2563eb)', 'text' => 'The audio file organisation is incredible. Every voice note and recording is right there in the media library — searchable and ready to replay instantly.', 'stars' => 5],
        ];

        return view('frontend.home', compact('stats', 'testimonials', 'heroes', 'services', 'included', 'video', 'multi'));
    }
}
