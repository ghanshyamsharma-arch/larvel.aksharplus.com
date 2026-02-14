@extends('layouts.admin')
@section('title', 'Create User')

@section('content')
<div style="max-width:680px;">
  <div style="margin-bottom:24px;">
    <a href="{{ route('admin.users.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Users</a>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);margin-top:8px;">Create New User</h2>
  </div>

  <div class="card">
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
          @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Email Address *</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="john@example.com" required>
          @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Password *</label>
          <input type="password" name="password" class="form-control" placeholder="Min 8 characters" required>
          @error('password')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+91 00000 00000">
        </div>
        <div class="form-group">
          <label class="form-label">Role *</label>
          <select name="role" class="form-control" required>
            <option value="user"  {{ old('role')=='user'  ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active"   {{ old('status','active')=='active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status')=='inactive'           ? 'selected' : '' }}>Inactive</option>
            <option value="banned"   {{ old('status')=='banned'             ? 'selected' : '' }}>Banned</option>
          </select>
          @error('status')<div class="form-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Bio</label>
        <textarea name="bio" class="form-control" rows="3" placeholder="Brief bio about the user…">{{ old('bio') }}</textarea>
      </div>
      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary">✅ Create User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
