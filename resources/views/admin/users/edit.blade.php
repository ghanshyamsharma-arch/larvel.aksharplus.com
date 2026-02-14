@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div style="max-width:680px;">
  <div style="margin-bottom:24px;">
    <a href="{{ route('admin.users.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Users</a>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);margin-top:8px;">Edit User — {{ $user->name }}</h2>
  </div>

  <div class="card">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Email Address *</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">New Password <span style="color:var(--muted2);font-weight:400;">(leave blank to keep)</span></label>
          <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
          @error('password')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>
        <div class="form-group">
          <label class="form-label">Role *</label>
          <select name="role" class="form-control" required>
            <option value="user"  {{ $user->hasRole('user')  ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active"   {{ $user->status=='active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $user->status=='inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="banned"   {{ $user->status=='banned'   ? 'selected' : '' }}>Banned</option>
          </select>
          @error('status')<div class="form-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Bio</label>
        <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
      </div>

      {{-- User Info Strip --}}
      <div style="background:var(--bg3);border-radius:12px;padding:14px;margin-bottom:20px;display:flex;gap:16px;flex-wrap:wrap;">
        <div><span style="font-size:.75rem;color:var(--muted2);">USER ID</span><br><strong>#{{ $user->id }}</strong></div>
        <div><span style="font-size:.75rem;color:var(--muted2);">JOINED</span><br><strong>{{ $user->created_at->format('d M Y') }}</strong></div>
        <div><span style="font-size:.75rem;color:var(--muted2);">LAST SEEN</span><br><strong>{{ $user->last_seen_at?->diffForHumans() ?? 'Never' }}</strong></div>
        <div><span style="font-size:.75rem;color:var(--muted2);">COMPANIES</span><br><strong>{{ $user->companies->count() }}</strong></div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
        @if($user->id !== auth()->id())
        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="margin-left:auto;" onsubmit="return confirm('Permanently delete this user?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger">🗑️ Delete User</button>
        </form>
        @endif
      </div>
    </form>
  </div>
</div>
@endsection
