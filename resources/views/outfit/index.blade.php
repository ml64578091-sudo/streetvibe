@extends('layouts.backend')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --primary: #2563eb;
        --gold: #FFD200;
        --orange: #F7971E;
        --ink: #ffffff;
        --surface: #f8f9fa;
        --card: #ffffff;
        --card-2: #f5f5f7;
        --border: rgba(0,0,0,0.08);
        --border-hover: rgba(0,0,0,0.14);
        --text: #1a1a1a;
        --muted: #6b6b7a;
        --success: #3ddc84;
        --danger: #ff5c5c;
    }

    .admin-wrap {
        background: var(--ink);
        font-family: 'Syne', sans-serif;
        color: var(--text);
        min-height: 100vh;
        padding: 36px 40px;
        position: relative;
        overflow: hidden;
    }

    /* ── DECORATIVE BG ── */
    .bg-orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; }
    .orb-1  { width: 600px; height: 600px; background: radial-gradient(circle, rgba(37,99,235,0.06) 0%, transparent 70%); top: -150px; right: -100px; }
    .orb-2  { width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,210,0,0.05) 0%, transparent 70%); bottom: 100px; left: -100px; }
    .bg-grid {
        position: fixed; inset: 0;
        background-image: linear-gradient(rgba(0,0,0,0.02) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(0,0,0,0.02) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none; z-index: 0;
    }
    .admin-inner { position: relative; z-index: 1; }

    /* ── TOPBAR ── */
    .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; flex-wrap: wrap; gap: 16px; }
    .topbar-eyebrow {
        font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase;
        color: var(--primary); margin-bottom: 4px;
        display: flex; align-items: center; gap: 8px;
    }
    .topbar-eyebrow::before { content: ''; display: block; width: 16px; height: 2px; background: var(--primary); }
    .topbar-title { font-family: 'Bebas Neue', sans-serif; font-size: 42px; letter-spacing: 2px; color: #0b0b0f; line-height: 1; }
    .topbar-title span { -webkit-text-stroke: 1.5px rgba(37,99,235,0.4); color: transparent; }

    .btn-add-top {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 11px 24px; background: linear-gradient(135deg, var(--primary), #1e40af);
        border: none; border-radius: 12px; color: white !important;
        font-family: 'Bebas Neue', sans-serif; font-size: 16px; letter-spacing: 1.5px;
        cursor: pointer; text-decoration: none; transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.25);
    }
    .btn-add-top:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4); }

    /* ── STATS ── */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
    .stat-card {
        background: var(--card); border: 1px solid var(--border); border-radius: 20px;
        padding: 24px; position: relative; overflow: hidden;
        transition: all 0.3s; animation: fadeUp 0.5s ease both;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .stat-card:hover { transform: translateY(-5px); border-color: var(--primary); }
    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px; display: flex;
        align-items: center; justify-content: center; font-size: 20px; margin-bottom: 15px;
    }
    .stat-label { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
    .stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 48px; letter-spacing: 1px; color: #0b0b0f; line-height: 1; }

    /* ── MAIN CARD & TABLE ── */
    .table-card {
        background: var(--card); border: 1px solid var(--border); border-radius: 24px;
        overflow: hidden; animation: fadeUp 0.6s 0.2s ease both;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }
    .table-toolbar { padding: 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 15px; }
    .search-box { position: relative; flex: 1; max-width: 400px; }
    .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--muted); }
    .search-box input {
        width: 100%; padding: 12px 16px 12px 45px;
        background: var(--card-2); border: 1px solid var(--border); border-radius: 12px;
        font-family: 'Syne', sans-serif; transition: all 0.3s;
    }
    .search-box input:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }

    .sv-table { width: 100%; border-collapse: collapse; }
    .sv-table thead th {
        padding: 16px 24px; font-size: 10px; font-weight: 800; letter-spacing: 2px;
        text-transform: uppercase; color: var(--muted); background: var(--card-2); text-align: left;
    }
    .sv-table tbody td { padding: 20px 24px; border-bottom: 1px solid rgba(0,0,0,0.04); vertical-align: middle; }

    .prod-img { width: 70px; height: 70px; border-radius: 14px; object-fit: cover; border: 1px solid var(--border); }
    .look-title { font-weight: 800; font-size: 15px; color: #0b0b0f; margin-bottom: 4px; }
    .look-id { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: var(--muted); }
    .look-desc { font-size: 13px; color: var(--muted); line-height: 1.5; max-width: 300px; }

    /* ── ACTIONS ── */
    .action-btn {
        width: 38px; height: 38px; border-radius: 10px; display: inline-flex;
        align-items: center; justify-content: center; border: 1px solid var(--border);
        background: white; color: var(--muted); transition: all 0.2s; cursor: pointer; text-decoration: none;
    }
    .action-btn:hover { border-color: var(--primary); color: var(--primary); background: rgba(37,99,235,0.05); }
    .action-btn.danger:hover { border-color: var(--danger); color: var(--danger); background: rgba(255,92,92,0.05); }

    /* ── ANIMATION ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .admin-wrap { padding: 20px; }
    }
</style>

<div class="admin-wrap">
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-grid"></div>

    <div class="admin-inner">

        {{-- ── TOPBAR ── --}}
        <div class="topbar">
            <div>
                <div class="topbar-eyebrow">Visual Inventory</div>
                <div class="topbar-title">OUTFIT <span>REFERENCE.</span></div>
            </div>
            <a href="{{ route('admin.outfit.create') }}" class="btn-add-top">
                <i class="fa fa-plus"></i> Tambah Look
            </a>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(37,99,235,0.1);color:var(--primary);"><i class="fa fa-layer-group"></i></div>
                <div class="stat-label">Total Looks</div>
                <div class="stat-num">{{ str_pad($outfits->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(61,220,132,0.1);color:var(--success);"><i class="fa fa-bolt"></i></div>
                <div class="stat-label">Active References</div>
                <div class="stat-num">{{ str_pad($outfits->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(255,210,0,0.1);color:var(--orange);"><i class="fa fa-calendar-day"></i></div>
                <div class="stat-label">Added This Month</div>
                <div class="stat-num">{{ str_pad($outfits->filter(fn($o) => $o->created_at->isCurrentMonth())->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        {{-- ── MAIN TABLE CARD ── --}}
        <div class="table-card">

            <div class="table-toolbar">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchOutfit" placeholder="Cari judul look atau deskripsi...">
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="sv-table">
                    <thead>
                        <tr>
                            <th style="width:80px; text-align:center;">No</th>
                            <th>picture</th>
                            <th>style</th>
                            <th>on insta </th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($outfits as $index => $outfit)
                        <tr class="outfit-row" data-name="{{ strtolower($outfit->judul) }}">
                            <td style="text-align:center; font-family:'JetBrains Mono'; color:var(--muted);">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td>
                                <img src="{{ Storage::url($outfit->gambar) }}" class="prod-img" alt="look">
                            </td>
                            <td>
                                <div class="look-title">{{ $outfit->judul }}</div>
                                <div class="look-id">REF-ID: #{{ str_pad($outfit->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>
                                <div class="look-desc">{{ Str::limit($outfit->deskripsi, 80) }}</div>
                            </td>
                            <td style="text-align:center;">
                                <div style="display:inline-flex; gap:8px;">
                                    <a href="{{ route('admin.outfit.edit', $outfit->id) }}" class="action-btn" title="Edit Look">
                                        <i class="fa fa-pen-nib"></i>
                                    </a>
                                    <button onclick="openDeleteModal({{ $outfit->id }}, '{{ addslashes($outfit->judul) }}')" class="action-btn danger" title="Delete">
                                        <i class="fa fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:60px; color:var(--muted);">
                                <i class="fa fa-folder-open" style="font-size:40px; opacity:0.2; margin-bottom:15px; display:block;"></i>
                                <p>Belum ada referensi outfit yang disimpan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus (Modern Style) --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:24px; border:none; overflow:hidden;">
            <div class="modal-body" style="padding:40px; text-align:center;">
                <div style="width:80px; height:80px; background:rgba(255,92,92,0.1); color:var(--danger); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:32px; margin:0 auto 24px;">
                    <i class="fa fa-triangle-exclamation"></i>
                </div>
                <h3 style="font-family:'Bebas Neue'; letter-spacing:1px; font-size:28px;">Hapus Referensi?</h3>
                <p style="color:var(--muted); margin-bottom:32px;">Look <strong id="deleteName"></strong> akan dihapus permanen dari StreetVibe.</p>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="padding:12px; border-radius:12px; background:var(--card-2); font-weight:700;">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="width:100%; padding:12px; border-radius:12px; background:var(--danger); color:white; border:none; font-weight:700;">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Live Search
    document.getElementById('searchOutfit').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.outfit-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    // Modal Handler
    function openDeleteModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = `{{ url('admin/outfit') }}/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>

@endsection
