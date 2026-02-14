@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div style="margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
  <div>
    <h2 style="font-size:1.6rem;font-weight:800;color:var(--text-h);">
      Welcome back, {{ auth()->user()->name }}! 👋
    </h2>
    <p style="color:var(--muted);font-size:.9rem;margin-top:4px;">
      {{ now()->format('l, d F Y') }} · Here's what's happening on Akshar Plus
    </p>
  </div>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
    ➕ Add User
  </a>
</div>

{{-- Stats Grid --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(233,30,140,.1);">👥</div>
    <div class="stat-num">{{ number_format($stats['total_users']) }}</div>
    <div class="stat-label">Total Users</div>
    <div class="stat-change stat-up">↑ {{ $stats['online_users'] }} online now</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(37,99,235,.1);">🏢</div>
    <div class="stat-num">{{ number_format($stats['total_companies']) }}</div>
    <div class="stat-label">Companies</div>
    <div class="stat-change stat-up">↑ {{ $stats['active_companies'] }} active</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(249,115,22,.1);">💬</div>
    <div class="stat-num">{{ number_format($stats['total_messages']) }}</div>
    <div class="stat-label">Messages Sent</div>
    <div class="stat-change stat-up">↑ {{ $stats['messages_today'] }} today</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="background:rgba(124,58,237,.1);">🗂️</div>
    <div class="stat-num">{{ number_format($stats['total_files']) }}</div>
    <div class="stat-label">Shared Files</div>
    <div class="stat-change" style="color:var(--muted);">{{ $stats['scheduled_pending'] }} msgs scheduled</div>
  </div>
</div>

{{-- Second row --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:20px;">

  {{-- Recent Messages --}}
  <div class="card">
    <div class="card-title">
      Recent Messages
      <a href="#" class="btn btn-outline btn-sm">View all</a>
    </div>
    @forelse($recentMessages as $msg)
    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid rgba(100,80,200,.05);">
      <div class="av" style="background:var(--grad);">{{ $msg->sender->initials ?? '?' }}</div>
      <div style="flex:1;min-width:0;">
        <p style="font-size:.84rem;font-weight:600;color:var(--text-h);">{{ $msg->sender->name ?? 'Unknown' }}</p>
        <p style="font-size:.8rem;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:300px;">
          {{ Str::limit($msg->body, 60) }}
        </p>
      </div>
      <div style="text-align:right;flex-shrink:0;">
        <div style="font-size:.72rem;color:var(--muted2);">{{ $msg->created_at->diffForHumans() }}</div>
        <div style="font-size:.72rem;color:var(--muted2);">#{{ $msg->channel->name ?? '?' }}</div>
      </div>
    </div>
    @empty
    <p style="color:var(--muted);font-size:.88rem;text-align:center;padding:24px 0;">No messages yet.</p>
    @endforelse
  </div>

  {{-- File Stats --}}
  <div class="card">
    <div class="card-title">Media Library</div>
    <div style="display:flex;flex-direction:column;gap:14px;">
      @php
        $fileTypes = [
          ['label'=>'Images','count'=>$stats['files_images'],'icon'=>'🖼️','color'=>'#e91e8c'],
          ['label'=>'Videos','count'=>$stats['files_videos'],'icon'=>'🎬','color'=>'#2563eb'],
          ['label'=>'Audio','count'=>\App\Models\SharedFile::audio()->count(),'icon'=>'🎵','color'=>'#7c3aed'],
          ['label'=>'Documents','count'=>\App\Models\SharedFile::documents()->count(),'icon'=>'📄','color'=>'#f97316'],
          ['label'=>'Links','count'=>\App\Models\SharedFile::links()->count(),'icon'=>'🔗','color'=>'#06b6d4'],
        ];
        $total = max($stats['total_files'], 1);
      @endphp
      @foreach($fileTypes as $ft)
      <div>
        <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
          <span style="font-size:.82rem;">{{ $ft['icon'] }} {{ $ft['label'] }}</span>
          <span style="font-size:.82rem;font-weight:600;color:var(--text-h);">{{ $ft['count'] }}</span>
        </div>
        <div style="height:6px;background:rgba(100,80,200,.1);border-radius:4px;overflow:hidden;">
          <div style="height:100%;width:{{ $total > 0 ? round($ft['count']/$total*100) : 0 }}%;background:{{ $ft['color'] }};border-radius:4px;transition:width .5s;"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- Bottom row --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

  {{-- Recent Users --}}
  <div class="card">
    <div class="card-title">
      Recent Users
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">View all</a>
    </div>
    @forelse($recentUsers as $user)
    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid rgba(100,80,200,.05);">
      <div class="av" style="background:var(--grad);">{{ $user->initials }}</div>
      <div style="flex:1;">
        <p style="font-size:.85rem;font-weight:600;color:var(--text-h);">{{ $user->name }}</p>
        <p style="font-size:.78rem;color:var(--muted);">{{ $user->email }}</p>
      </div>
      <span class="badge {{ $user->status === 'active' ? 'badge-green' : 'badge-red' }}">
        {{ ucfirst($user->status) }}
      </span>
    </div>
    @empty
    <p style="color:var(--muted);text-align:center;padding:24px 0;font-size:.88rem;">No users yet.</p>
    @endforelse
  </div>

  {{-- Recent Companies --}}
  <div class="card">
    <div class="card-title">
      Recent Companies
      <a href="{{ route('admin.companies.index') }}" class="btn btn-outline btn-sm">View all</a>
    </div>
    @forelse($recentCompanies as $company)
    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid rgba(100,80,200,.05);">
      <div class="av" style="background:var(--grad);border-radius:10px;">
        {{ strtoupper(substr($company->name, 0, 2)) }}
      </div>
      <div style="flex:1;">
        <p style="font-size:.85rem;font-weight:600;color:var(--text-h);">{{ $company->name }}</p>
        <p style="font-size:.78rem;color:var(--muted);">{{ $company->member_count }} members · {{ ucfirst($company->plan) }}</p>
      </div>
      <span class="badge {{ $company->status === 'active' ? 'badge-green' : 'badge-yellow' }}">
        {{ ucfirst($company->status) }}
      </span>
    </div>
    @empty
    <p style="color:var(--muted);text-align:center;padding:24px 0;font-size:.88rem;">No companies yet.</p>
    @endforelse
  </div>

</div>
@endsection
