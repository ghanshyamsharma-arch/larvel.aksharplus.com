@extends('layouts.admin')
@section('title', 'Edit Company')

@section('content')
<div style="max-width:700px;">
  <div style="margin-bottom:24px;">
    <a href="{{ route('admin.companies.index') }}" style="color:var(--violet);text-decoration:none;font-size:.85rem;">← Back to Companies</a>
    <h2 style="font-size:1.4rem;font-weight:800;color:var(--text-h);margin-top:8px;">Edit — {{ $company->name }}</h2>
  </div>

  <div class="card">
    <form method="POST" action="{{ route('admin.companies.update', $company) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">Company Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
          @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Owner *</label>
          <select name="owner_id" class="form-control" required>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ $company->owner_id==$user->id ? 'selected':'' }}>
                {{ $user->name }} ({{ $user->email }})
              </option>
            @endforeach
          </select>
          @error('owner_id')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Plan *</label>
          <select name="plan" class="form-control" required>
            <option value="free"       {{ $company->plan=='free'       ? 'selected':'' }}>🆓 Free</option>
            <option value="pro"        {{ $company->plan=='pro'        ? 'selected':'' }}>⭐ Pro</option>
            <option value="enterprise" {{ $company->plan=='enterprise' ? 'selected':'' }}>💎 Enterprise</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Max Members *</label>
          <input type="number" name="max_members" class="form-control" value="{{ old('max_members', $company->max_members) }}" min="2" required>
        </div>
        <div class="form-group">
          <label class="form-label">Status *</label>
          <select name="status" class="form-control" required>
            <option value="active"    {{ $company->status=='active'    ? 'selected':'' }}>Active</option>
            <option value="inactive"  {{ $company->status=='inactive'  ? 'selected':'' }}>Inactive</option>
            <option value="suspended" {{ $company->status=='suspended' ? 'selected':'' }}>Suspended</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">New Logo <span style="color:var(--muted2);font-weight:400;">(leave blank to keep)</span></label>
          <input type="file" name="logo" class="form-control" accept="image/*">
          @if($company->logo)
            <p style="font-size:.75rem;color:var(--muted2);margin-top:5px;">Current: {{ basename($company->logo) }}</p>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $company->description) }}</textarea>
      </div>

      {{-- Info Strip --}}
      <div style="background:var(--bg3);border-radius:12px;padding:14px;margin-bottom:20px;display:flex;gap:20px;flex-wrap:wrap;">
        <div><span style="font-size:.72rem;color:var(--muted2);">SLUG</span><br><code style="font-size:.8rem;">{{ $company->slug }}</code></div>
        <div><span style="font-size:.72rem;color:var(--muted2);">CREATED</span><br><strong style="font-size:.85rem;">{{ $company->created_at->format('d M Y') }}</strong></div>
        <div><span style="font-size:.72rem;color:var(--muted2);">MEMBERS</span><br><strong style="font-size:.85rem;">{{ $company->member_count }}</strong></div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
        <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-outline">👁️ View Details</a>
        <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" style="margin-left:auto;" onsubmit="return confirm('Delete this company?')">
          @csrf @method('DELETE')
          <button class="btn btn-danger">🗑️ Delete</button>
        </form>
      </div>
    </form>
  </div>
</div>
@endsection
