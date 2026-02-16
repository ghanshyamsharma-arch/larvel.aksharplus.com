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


</div>

{{-- Second row --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:20px;">



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