@extends('layouts.admin')
@section('title', $company->name)

@section('content')
<div style="margin-bottom:20px;">
  <a href="{{ route('admin.companies.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Companies</a>
</div>

<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start;">

  {{-- Left: company profile --}}
  <div>
    <div class="card" style="text-align:center;padding:32px 24px;">
      <div style="width:72px;height:72px;border-radius:20px;background:var(--grad);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.6rem;color:#fff;margin:0 auto 16px;">
        {{ strtoupper(substr($company->name,0,2)) }}
      </div>
      <h3 style="font-size:1.2rem;font-weight:800;color:var(--text-h);">{{ $company->name }}</h3>
      <p style="color:var(--muted);font-size:.85rem;margin:6px 0 16px;">{{ $company->description ?? 'No description' }}</p>

      <div style="display:flex;justify-content:center;gap:10px;margin-bottom:20px;">
        <span class="badge {{ $company->plan==='enterprise' ? 'badge-purple' : ($company->plan==='pro' ? 'badge-blue' : 'badge-gray') }}">
          {{ ucfirst($company->plan) }}
        </span>
        <span class="badge {{ $company->status==='active' ? 'badge-green' : 'badge-red' }}">
          {{ ucfirst($company->status) }}
        </span>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px;">
        <div style="background:var(--bg3);border-radius:10px;padding:12px;">
          <div style="font-size:1.4rem;font-weight:800;color:var(--text-h);">{{ $company->members->count() }}</div>
          <div style="font-size:.72rem;color:var(--muted2);">Members</div>
        </div>
        <div style="background:var(--bg3);border-radius:10px;padding:12px;">
          <div style="font-size:1.4rem;font-weight:800;color:var(--text-h);">{{ $company->channels->count() }}</div>
          <div style="font-size:.72rem;color:var(--muted2);">Channels</div>
        </div>
      </div>

      <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-primary" style="width:100%;justify-content:center;">✏️ Edit Company</a>
    </div>
  </div>

  {{-- Right: details --}}
  <div style="display:flex;flex-direction:column;gap:16px;">

    {{-- Members --}}
    <div class="card">
      <div class="card-title">Members ({{ $company->members->count() }})</div>
      <div style="display:flex;flex-direction:column;gap:8px;">
        @foreach($company->members->take(8) as $member)
        <div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--border);">
          <div class="av" style="background:var(--grad);">{{ $member->initials }}</div>
          <div style="flex:1;">
            <p style="font-size:.85rem;font-weight:600;color:var(--text-h);">{{ $member->name }}</p>
            <p style="font-size:.75rem;color:var(--muted);">{{ $member->email }}</p>
          </div>
          <span class="badge badge-purple" style="font-size:.68rem;">{{ ucfirst($member->pivot->role) }}</span>
        </div>
        @endforeach
        @if($company->members->count() > 8)
          <p style="text-align:center;font-size:.8rem;color:var(--muted);padding:8px;">+ {{ $company->members->count() - 8 }} more members</p>
        @endif
      </div>
    </div>

    {{-- Channels --}}
    <div class="card">
      <div class="card-title">Channels ({{ $company->channels->count() }})</div>
      <div style="display:flex;flex-wrap:wrap;gap:8px;">
        @foreach($company->channels as $ch)
          <span class="badge {{ $ch->is_private ? 'badge-yellow' : 'badge-blue' }}" style="font-size:.8rem;padding:5px 12px;">
            {{ $ch->is_private ? '🔒' : '#' }} {{ $ch->name }}
          </span>
        @endforeach
        @if($company->channels->isEmpty())
          <p style="color:var(--muted);font-size:.85rem;">No channels yet.</p>
        @endif
      </div>
    </div>

  </div>
</div>
@endsection
