@extends('layouts.admin')
@section('title', 'Companies')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;">
  <div>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);">Companies</h2>
    <p style="color:var(--muted);font-size:.85rem;margin-top:3px;">{{ $companies->total() }} total companies</p>
  </div>
  <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">➕ Add Company</a>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom:20px;padding:16px 24px;">
  <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
    <div style="flex:1;min-width:200px;">
      <div class="search-bar">
        <span>🔍</span>
        <input type="text" name="search" placeholder="Search companies…" value="{{ request('search') }}">
      </div>
    </div>
    <select name="status" class="form-control" style="padding:10px 14px;min-width:130px;">
      <option value="">All Status</option>
      <option value="active"    {{ request('status')=='active'    ? 'selected':'' }}>Active</option>
      <option value="inactive"  {{ request('status')=='inactive'  ? 'selected':'' }}>Inactive</option>
      <option value="suspended" {{ request('status')=='suspended' ? 'selected':'' }}>Suspended</option>
    </select>
    <select name="plan" class="form-control" style="padding:10px 14px;min-width:130px;">
      <option value="">All Plans</option>
      <option value="free"       {{ request('plan')=='free'       ? 'selected':'' }}>Free</option>
      <option value="pro"        {{ request('plan')=='pro'        ? 'selected':'' }}>Pro</option>
      <option value="enterprise" {{ request('plan')=='enterprise' ? 'selected':'' }}>Enterprise</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    @if(request()->hasAny(['search','status','plan']))
      <a href="{{ route('admin.companies.index') }}" class="btn btn-outline btn-sm">Clear</a>
    @endif
  </form>
</div>

{{-- Company Cards Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;">
  @forelse($companies as $company)
  <div class="card" style="padding:20px;transition:all .25s;border:1px solid var(--border);" onmouseover="this.style.boxShadow='0 8px 32px rgba(80,40,180,.12)'" onmouseout="this.style.boxShadow='none'">

    {{-- Plan badge on top --}}
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;">
      <span class="badge {{ $company->plan==='enterprise' ? 'badge-purple' : ($company->plan==='pro' ? 'badge-blue' : 'badge-gray') }}">
        {{ $company->plan==='enterprise' ? '💎' : ($company->plan==='pro' ? '⭐' : '🆓') }}
        {{ ucfirst($company->plan) }}
      </span>
      <span class="badge {{ $company->status==='active' ? 'badge-green' : ($company->status==='suspended' ? 'badge-red' : 'badge-yellow') }}">
        {{ ucfirst($company->status) }}
      </span>
    </div>

    {{-- Logo + Name --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:48px;height:48px;border-radius:14px;background:var(--grad);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;color:#fff;flex-shrink:0;">
        {{ strtoupper(substr($company->name,0,2)) }}
      </div>
      <div>
        <p style="font-size:1rem;font-weight:700;color:var(--text-h);">{{ $company->name }}</p>
        <p style="font-size:.75rem;color:var(--muted);">by {{ $company->owner->name ?? 'Unknown' }}</p>
      </div>
    </div>

    @if($company->description)
      <p style="font-size:.82rem;color:var(--muted);line-height:1.6;margin-bottom:14px;">{{ Str::limit($company->description, 80) }}</p>
    @endif

    {{-- Stats row --}}
    <div style="display:flex;gap:16px;background:var(--bg3);border-radius:10px;padding:10px 14px;margin-bottom:16px;">
      <div style="text-align:center;flex:1;">
        <div style="font-weight:700;color:var(--text-h);">{{ $company->members_count }}</div>
        <div style="font-size:.7rem;color:var(--muted2);">Members</div>
      </div>
      <div style="text-align:center;flex:1;border-left:1px solid var(--border);">
        <div style="font-weight:700;color:var(--text-h);">{{ $company->channels->count() }}</div>
        <div style="font-size:.7rem;color:var(--muted2);">Channels</div>
      </div>
      <div style="text-align:center;flex:1;border-left:1px solid var(--border);">
        <div style="font-weight:700;color:var(--text-h);">{{ $company->max_members }}</div>
        <div style="font-size:.7rem;color:var(--muted2);">Max Seats</div>
      </div>
    </div>

    {{-- Actions --}}
    <div style="display:flex;gap:8px;">
      <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">✏️ Edit</a>
      <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline" style="flex:1;justify-content:center;">👁️ View</a>
      <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" onsubmit="return confirm('Delete this company and all its data?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm">🗑️</button>
      </form>
    </div>
  </div>
  @empty
  <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--muted);">
    No companies found. <a href="{{ route('admin.companies.create') }}" style="color:var(--violet);">Create one?</a>
  </div>
  @endforelse
</div>

<div class="pagination">{{ $companies->links() }}</div>
@endsection
