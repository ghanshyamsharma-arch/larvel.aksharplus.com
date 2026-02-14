@extends('layouts.admin')
@section('title', 'Create Company')

@section('content')
<div style="max-width:700px;">
  <div style="margin-bottom:24px;">
    <a href="{{ route('admin.companies.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Companies</a>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);margin-top:8px;">Create New Company</h2>
  </div>

  <div class="card">
    <form method="POST" action="{{ route('admin.companies.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">Company Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Akshar Plus HQ" required>
          @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Owner *</label>
          <select name="owner_id" class="form-control" required>
            <option value="">Select owner…</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ old('owner_id')==$user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
              </option>
            @endforeach
          </select>
          @error('owner_id')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Plan *</label>
          <select name="plan" class="form-control" required>
            <option value="free"       {{ old('plan')=='free'       ? 'selected':'' }}>🆓 Free</option>
            <option value="pro"        {{ old('plan')=='pro'        ? 'selected':'' }}>⭐ Pro</option>
            <option value="enterprise" {{ old('plan')=='enterprise' ? 'selected':'' }}>💎 Enterprise</option>
          </select>
          @error('plan')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Max Members *</label>
          <input type="number" name="max_members" class="form-control" value="{{ old('max_members', 10) }}" min="2" required>
          @error('max_members')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active"    {{ old('status','active')=='active'    ? 'selected':'' }}>Active</option>
            <option value="inactive"  {{ old('status')=='inactive'            ? 'selected':'' }}>Inactive</option>
            <option value="suspended" {{ old('status')=='suspended'           ? 'selected':'' }}>Suspended</option>
          </select>
          @error('status')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Company Logo</label>
          <input type="file" name="logo" class="form-control" accept="image/*">
          @error('logo')<div class="form-error">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the company…">{{ old('description') }}</textarea>
      </div>
      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary">✅ Create Company</button>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
