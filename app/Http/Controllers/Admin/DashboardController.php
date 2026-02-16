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

        ];

        $recentUsers     = User::latest()->limit(5)->get();
        $recentCompanies = Company::with('owner')->latest()->limit(5)->get();

        $chartData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return [
                'date'  => $date->format('M d'),

            ];
        });

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentCompanies',
            'chartData',
        ));
    }
}
