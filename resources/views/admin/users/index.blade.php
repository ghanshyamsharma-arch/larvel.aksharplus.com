@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;">
  <div>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);">Users Management</h2>
    <p style="color:var(--muted);font-size:.85rem;margin-top:3px;">{{ $users->total() }} total users registered</p>
  </div>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Add New User</a>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom:20px;padding:18px 24px;">
  <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
    <div style="flex:1;min-width:200px;">
      <div class="search-bar">
        <span>🔍</span>
        <input type="text" name="search" placeholder="Search name or email…" value="{{ request('search') }}">
      </div>
    </div>
    <div>
      <select name="status" class="form-control" style="padding:10px 14px;min-width:130px;">
        <option value="">All Status</option>
        <option value="active"   {{ request('status')=='active'   ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="banned"   {{ request('status')=='banned'   ? 'selected' : '' }}>Banned</option>
      </select>
    </div>
    <div>
      <select name="role" class="form-control" style="padding:10px 14px;min-width:120px;">
        <option value="">All Roles</option>
        <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
        <option value="user"  {{ request('role')=='user'  ? 'selected' : '' }}>User</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    @if(request()->hasAny(['search','status','role']))
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">Clear</a>
    @endif
  </form>
</div>

{{-- Table --}}
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>User</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Online</th>
        <th>Joined</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <td style="color:var(--muted2);font-size:.78rem;">{{ $user->id }}</td>
        <td>
          <div style="display:flex;align-items:center;gap:10px;">
            <div class="av" style="background:var(--grad);">{{ $user->initials }}</div>
            <span style="font-weight:600;color:var(--text-h);">{{ $user->name }}</span>
          </div>
        </td>
        <td style="color:var(--muted);">{{ $user->email }}</td>
        <td>
          <span class="badge {{ $user->hasRole('admin') ? 'badge-purple' : 'badge-blue' }}">
            {{ $user->hasRole('admin') ? '👑 Admin' : '👤 User' }}
          </span>
        </td>
        <td>
          <span class="badge {{ $user->status==='active' ? 'badge-green' : ($user->status==='banned' ? 'badge-red' : 'badge-yellow') }}">
            {{ ucfirst($user->status) }}
          </span>
        </td>
        <td>
          @if($user->is_online)
            <span style="display:inline-flex;align-items:center;gap:5px;font-size:.8rem;color:#16a34a;">
              <span style="width:8px;height:8px;border-radius:50%;background:#22c55e;"></span> Online
            </span>
          @else
            <span style="font-size:.8rem;color:var(--muted2);">Offline</span>
          @endif
        </td>
        <td style="color:var(--muted);font-size:.82rem;">{{ $user->created_at->format('d M Y') }}</td>
        <td>
          <div style="display:flex;gap:6px;">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
            @if($user->id !== auth()->id())
            <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" style="display:inline;">
              @csrf @method('PATCH')
              <button type="submit" class="btn btn-sm" style="background:rgba(251,191,36,.15);color:#b45309;border:1px solid rgba(251,191,36,.3);">
                {{ $user->status==='active' ? '🔒 Disable' : '✅ Enable' }}
              </button>
            </form>
            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Delete this user?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
            </form>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="8" style="text-align:center;padding:48px;color:var(--muted);">
          No users found. <a href="{{ route('admin.users.create') }}" style="color:var(--violet);">Create one?</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Pagination --}}
<div class="pagination">
  {{ $users->links() }}
</div>
@endsection
