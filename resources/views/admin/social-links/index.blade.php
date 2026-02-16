@extends('layouts.admin')
@section('title', 'Social Links')

@section('content')
<style>
    .sl-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 24px;
    }

    .sl-header h2 {
        font-family: 'Syne', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-h);
    }

    .sl-header p {
        font-size: .85rem;
        color: var(--muted);
        margin-top: 3px;
    }

    /* Table card */
    .sl-table-wrap {
        overflow-x: auto;
    }

    .sl-table {
        width: 100%;
        border-collapse: collapse;
    }

    .sl-table th {
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted2);
        padding: 10px 16px;
        text-align: left;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .sl-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .sl-table tr:last-child td {
        border-bottom: none;
    }

    .sl-table tr:hover td {
        background: var(--bg3);
    }

    /* Drag handle */
    .drag-handle {
        cursor: grab;
        color: var(--muted2);
        font-size: 1.1rem;
        padding: 0 4px;
        user-select: none;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .sortable-ghost {
        opacity: .35;
        background: rgba(124, 58, 237, .06);
    }

    /* Platform icon */
    .platform-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--bg3);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-h);
        flex-shrink: 0;
    }

    .platform-icon svg {
        width: 18px;
        height: 18px;
    }

    .platform-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .platform-label {
        font-weight: 600;
        font-size: .88rem;
        color: var(--text-h);
    }

    .platform-platform {
        font-size: .72rem;
        color: var(--muted2);
        margin-top: 2px;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    /* URL */
    .sl-url {
        font-size: .8rem;
        color: var(--violet);
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    /* Status badge */
    .badge-on {
        font-size: .68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        background: rgba(34, 197, 94, .1);
        color: #15803d;
    }

    .badge-off {
        font-size: .68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        background: rgba(239, 68, 68, .08);
        color: #dc2626;
    }

    /* Actions */
    .sl-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Empty */
    .sl-empty {
        text-align: center;
        padding: 56px 20px;
        color: var(--muted);
    }

    .sl-empty .icon {
        font-size: 2.8rem;
        margin-bottom: 12px;
    }

    .sl-empty h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-h);
        margin-bottom: 6px;
    }
</style>

<div class="sl-header">
    <div>
        <h2>Social Links</h2>
        <p>{{ $links->count() }} links · drag rows to reorder</p>
    </div>
    <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary">+ Add Link</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    @if($links->count())
    <div class="sl-table-wrap">
        <table class="sl-table">
            <thead>
                <tr>
                    <th style="width:32px;"></th>
                    <th>Platform</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sortableBody">
                @foreach($links as $link)
                <tr data-id="{{ $link->id }}">
                    <td><span class="drag-handle">⠿</span></td>

                    <td>
                        <div class="platform-cell">
                            <div class="platform-icon">{!! $link->icon_svg !!}</div>
                            <div>
                                <div class="platform-label">{{ $link->label }}</div>
                                <div class="platform-platform">{{ $link->platform }}</div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <a href="{{ $link->url }}" target="_blank" class="sl-url">{{ $link->url }}</a>
                    </td>

                    <td>
                        <span style="font-size:.85rem;font-weight:600;color:var(--muted);">{{ $link->sort_order }}</span>
                    </td>

                    <td>
                        <span class="{{ $link->is_active ? 'badge-on' : 'badge-off' }}">
                            {{ $link->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    <td>
                        <div class="sl-actions">
                            <a href="{{ route('admin.social-links.edit', $link) }}"
                                class="btn btn-outline btn-sm">✏️ Edit</a>

                            <form method="POST"
                                action="{{ route('admin.social-links.toggle-status', $link) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm" style="
                                    background:{{ $link->is_active ? 'rgba(239,68,68,.08)' : 'rgba(34,197,94,.08)' }};
                                    color:{{ $link->is_active ? '#dc2626' : '#15803d' }};
                                    border:1px solid {{ $link->is_active ? 'rgba(239,68,68,.2)' : 'rgba(34,197,94,.2)' }};
                                ">{{ $link->is_active ? 'Disable' : 'Enable' }}</button>
                            </form>

                            <form method="POST"
                                action="{{ route('admin.social-links.destroy', $link) }}"
                                onsubmit="return confirm('Delete this link?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="sl-empty">
        <div class="icon">🔗</div>
        <h3>No social links yet</h3>
        <p style="font-size:.85rem;margin-bottom:16px;">Add your first social media link.</p>
        <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary">+ Add Link</a>
    </div>
    @endif
</div>

{{-- Footer snippet hint --}}


<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const tbody = document.getElementById('sortableBody');
    if (tbody) {
        Sortable.create(tbody, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd() {
                const order = [...tbody.querySelectorAll('tr[data-id]')]
                    .map(r => r.dataset.id);
                fetch('{{ route("admin.social-links.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        order
                    })
                });
            }
        });
    }
</script>
@endsection