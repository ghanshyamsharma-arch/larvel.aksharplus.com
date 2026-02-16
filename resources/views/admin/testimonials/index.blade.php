@extends('layouts.admin')
@section('title', 'Testimonials / Reviews')

@section('content')

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;">
    <div>
        <h2 style="font-family:sans-serif;font-size:1.4rem;font-weight:800;color:var(--text-h);">Testimonials</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-top:3px;">{{ $testimonials->total() }} total reviews</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Add Testimonial</a>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:20px;padding:16px 24px;">
    <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
        <div style="flex:1;min-width:200px;">
            <div class="search-bar">
                <span>🔍</span>
                <input type="text" name="name" placeholder="Search by name…" value="{{ request('name') }}">
            </div>
        </div>
        <select name="status" class="form-control" style="padding:10px 14px;min-width:130px;">
            <option value="">All Status</option>
            <option value="1" {{ request('status')==='1' ? 'selected':'' }}>✅ Active</option>
            <option value="0" {{ request('status')==='0' ? 'selected':'' }}>⛔ Inactive</option>
        </select>
        <!-- <select name="rating" class="form-control" style="padding:10px 14px;min-width:130px;">
            <option value="">All Ratings</option>
            @for($r=5;$r>=1;$r--)
            <option value="{{ $r }}" {{ request('rating')==$r ? 'selected':'' }}>{{ str_repeat('★',$r) }} {{ $r }} Star</option>
            @endfor
        </select> -->
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        @if(request()->hasAny(['name','status','rating']))
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline btn-sm">Clear</a>
        @endif
    </form>
</div>

{{-- Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;">
    @forelse($testimonials as $item)
    <div class="card" style="padding:22px;display:flex;flex-direction:column;gap:0;transition:all .25s;position:relative;"
        onmouseover="this.style.boxShadow='0 8px 32px rgba(80,40,180,.13)';this.style.transform='translateY(-3px)'"
        onmouseout="this.style.boxShadow='';this.style.transform=''">

        {{-- Status badge --}}
        <div style="position:absolute;top:14px;right:14px;">
            @if(isset($item->is_active))
            <span style="font-size:.65rem;font-weight:700;padding:3px 9px;border-radius:20px;background:{{ $item->is_active ? 'rgba(34,197,94,.12)':'rgba(239,68,68,.1)' }};
          color:{{ $item->is_active ? '#15803d':'#dc2626' }};">
                {{ $item->is_active ? '✅ Active':'⛔ Inactive' }}
            </span>
            @endif
        </div>

        {{-- Stars --}}
        <div style="margin-bottom:12px;display:flex;align-items:center;gap:3px;">
            @for($i=1;$i<=5;$i++)
                <span style="font-size:1rem;color:{{ $i<=$item->rating ? '#f59e0b':'#e5e7eb' }};">★</span>
                @endfor
                <span style="font-size:.75rem;color:var(--muted2);margin-left:6px;">{{ $item->rating }}/5</span>
        </div>

        {{-- Quote --}}
        <div style="position:relative;flex:1;">
            <span style="position:absolute;top:-8px;left:-4px;font-size:2.5rem;color:rgba(124,58,237,.12);font-family:Georgia,serif;line-height:1;">"</span>
            <p style="font-size:.875rem;color:var(--muted);line-height:1.65;padding-left:14px;margin-bottom:16px;min-height:64px;">
                {{ Str::limit($item->content, 160) }}
            </p>
        </div>

        {{-- Divider --}}
        <div style="height:1px;background:var(--border);margin-bottom:14px;"></div>

        {{-- Author --}}
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;">
            {{-- Avatar --}}
            @if(isset($item->avatar) && $item->avatar)
            <img src="{{ asset('storage/'.$item->avatar) }}" style="width:38px;height:38px;border-radius:50%;object-fit:cover;flex-shrink:0;" alt="">
            @else
            <div style="width:38px;height:38px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:800;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr($item->name,0,2)) }}
            </div>
            @endif
            <div style="min-width:0;">
                <div style="font-weight:700;font-size:.88rem;color:var(--text-h);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->name }}</div>
                <div style="font-size:.75rem;color:var(--muted2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $item->designation }}@if($item->company) · {{ $item->company }}@endif
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.testimonials.edit', $item) }}"
                class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">✏️ Edit</a>

            <form method="POST" action="{{ route('admin.testimonials.destroy', $item) }}"
                style="flex:1;" onsubmit="return confirm('Delete this testimonial?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" style="width:100%;justify-content:center;">🗑️ Delete</button>
            </form>
        </div>

    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:64px 20px;color:var(--muted);">
        <div style="font-size:3rem;margin-bottom:14px;">💬</div>
        <p style="font-size:1rem;font-weight:600;color:var(--text-h);margin-bottom:6px;">No testimonials yet</p>
        <p style="font-size:.85rem;margin-bottom:18px;">Add your first customer review.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Add Testimonial</a>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($testimonials->hasPages())
<div style="margin-top:24px;">{{ $testimonials->links() }}</div>
@endif

@endsection