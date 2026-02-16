@extends('layouts.admin')
@section('title', isset($socialLink) ? 'Edit Social Link' : 'Add Social Link')

@section('content')
<style>
.sl-form-wrap { max-width: 600px; }
.sl-back { font-size: .85rem; color: var(--violet); margin-bottom: 20px; display: inline-block; }
.sl-form-title {
    font-family: 'Syne', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--text-h);
    margin-bottom: 24px;
}

/* Platform picker */
.platform-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-bottom: 4px;
}
.platform-option { display: none; }
.platform-option + label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 7px;
    padding: 14px 10px;
    border-radius: 12px;
    border: 1.5px solid var(--border);
    background: var(--white);
    cursor: pointer;
    transition: all .2s;
    font-size: .75rem;
    font-weight: 600;
    color: var(--muted);
}
.platform-option + label svg {
    width: 22px;
    height: 22px;
    color: var(--muted);
    transition: color .2s;
}
.platform-option + label:hover {
    border-color: var(--violet);
    color: var(--violet);
}
.platform-option + label:hover svg { color: var(--violet); }
.platform-option:checked + label {
    border-color: var(--violet);
    background: rgba(124,58,237,.07);
    color: var(--violet);
}
.platform-option:checked + label svg { color: var(--violet); }

/* Active toggle */
.toggle-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    background: var(--bg3);
    border-radius: 12px;
}
.toggle-label { font-size: .88rem; font-weight: 600; color: var(--text-h); }
.toggle-desc  { font-size: .78rem; color: var(--muted); margin-top: 2px; }
input[type="checkbox"].toggle {
    width: 40px; height: 22px;
    appearance: none;
    background: var(--border);
    border-radius: 50px;
    position: relative;
    cursor: pointer;
    transition: background .2s;
    flex-shrink: 0;
}
input[type="checkbox"].toggle::after {
    content: '';
    position: absolute;
    top: 3px; left: 3px;
    width: 16px; height: 16px;
    border-radius: 50%;
    background: #fff;
    transition: left .2s;
    box-shadow: 0 1px 4px rgba(0,0,0,.2);
}
input[type="checkbox"].toggle:checked { background: var(--violet); }
input[type="checkbox"].toggle:checked::after { left: 21px; }
</style>

<div class="sl-form-wrap">
    <a href="{{ route('admin.social-links.index') }}" class="sl-back">← Back to Social Links</a>
    <h2 class="sl-form-title">{{ isset($socialLink) ? 'Edit Social Link' : 'Add New Social Link' }}</h2>

    <form method="POST"
          action="{{ isset($socialLink) ? route('admin.social-links.update', $socialLink) : route('admin.social-links.store') }}">
        @csrf
        @if(isset($socialLink)) @method('PUT') @endif

        {{-- Platform Picker --}}
        <div class="card" style="padding:22px;margin-bottom:16px;">
            <div class="form-label" style="margin-bottom:14px;">Choose Platform *</div>

            <div class="platform-grid">
                @php
                  $platforms = [
                    'x'         => ['label' => 'X / Twitter', 'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'],
                    'linkedin'  => ['label' => 'LinkedIn',    'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>'],
                    'instagram' => ['label' => 'Instagram',   'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>'],
                    'youtube'   => ['label' => 'YouTube',     'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>'],
                    'facebook'  => ['label' => 'Facebook',    'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'],
                    'github'    => ['label' => 'GitHub',      'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>'],
                    'tiktok'    => ['label' => 'TikTok',      'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.55V6.79a4.85 4.85 0 01-1.07-.1z"/></svg>'],
                    'custom'    => ['label' => 'Custom',      'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>'],
                  ];
                @endphp

                @foreach($platforms as $key => $p)
                <div>
                    <input type="radio" name="platform" id="pl_{{ $key }}"
                           value="{{ $key }}" class="platform-option"
                           {{ old('platform', $socialLink->platform ?? '') === $key ? 'checked' : '' }}>
                    <label for="pl_{{ $key }}">
                        {!! $p['svg'] !!}
                        {{ $p['label'] }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('platform')<div class="form-error" style="margin-top:8px;">{{ $message }}</div>@enderror
        </div>

        {{-- Details --}}
        <div class="card" style="padding:22px;margin-bottom:16px;">
            <div class="form-group">
                <label class="form-label">Display Label *</label>
                <input type="text" name="label" class="form-control"
                       value="{{ old('label', $socialLink->label ?? '') }}"
                       placeholder="e.g. Follow us on X">
                @error('label')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">URL *</label>
                <input type="url" name="url" class="form-control"
                       value="{{ old('url', $socialLink->url ?? '') }}"
                       placeholder="https://x.com/yourhandle">
                @error('url')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="{{ old('sort_order', $socialLink->sort_order ?? 0) }}"
                       min="0" style="max-width:120px;">
                <p style="font-size:.75rem;color:var(--muted2);margin-top:5px;">Lower number = shown first. You can also drag-reorder from the list.</p>
            </div>
        </div>

        {{-- Active toggle --}}
        <div class="card" style="padding:16px 22px;margin-bottom:20px;">
            <div class="toggle-row">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="toggle"
                       {{ old('is_active', $socialLink->is_active ?? true) ? 'checked' : '' }}>
                <div>
                    <div class="toggle-label">Show in Footer</div>
                    <div class="toggle-desc">When enabled, this link will appear in the site footer.</div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">
                {{ isset($socialLink) ? '💾 Save Changes' : '+ Add Link' }}
            </button>
            <a href="{{ route('admin.social-links.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
