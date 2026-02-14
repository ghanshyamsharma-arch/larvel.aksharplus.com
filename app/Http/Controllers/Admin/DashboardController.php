<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Company;
use App\Models\Message;
use App\Models\ScheduledMessage;
use App\Models\SharedFile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'      => User::count(),
            'active_users'     => User::where('status', 'active')->count(),
            'online_users'     => User::where('is_online', true)->count(),
            'total_companies'  => Company::count(),
            'active_companies' => Company::where('status', 'active')->count(),
            'total_channels'   => Channel::count(),
            'total_messages'   => Message::count(),
            'messages_today'   => Message::whereDate('created_at', today())->count(),
            'scheduled_pending'=> ScheduledMessage::pending()->count(),
            'total_files'      => SharedFile::count(),
            'files_images'     => SharedFile::images()->count(),
            'files_videos'     => SharedFile::videos()->count(),
        ];

        $recentUsers     = User::latest()->limit(5)->get();
        $recentCompanies = Company::with('owner')->latest()->limit(5)->get();
        $recentMessages  = Message::with(['sender', 'channel'])->latest()->limit(10)->get();

        // Chart data — messages per day (last 7 days)
        $chartData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return [
                'date'  => $date->format('M d'),
                'count' => Message::whereDate('created_at', $date->toDateString())->count(),
            ];
        });

        return view('admin.dashboard', compact(
            'stats', 'recentUsers', 'recentCompanies', 'recentMessages', 'chartData'
        ));
    }
}
