@extends('layouts.backend')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --primary: #2563eb;
        --accent: #8b5cf6;
        --ink: #ffffff;
        --card: #ffffff;
        --card-2: #f8fafc;
        --border: rgba(0,0,0,0.06);
        --text: #0f172a;
        --muted: #64748b;
        --success: #10b981;
        --danger: #ef4444;
    }

    .admin-wrap {
        background: var(--ink);
        font-family: 'Syne', sans-serif;
        color: var(--text);
        min-height: 100vh;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    /* ── DECORATIVE BG ── */
    .bg-orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; }
    .orb-1  { width: 700px; height: 700px; background: radial-gradient(circle, rgba(37,99,235,0.05) 0%, transparent 70%); top: -200px; right: -150px; }
    .orb-2  { width: 500px; height: 500px; background: radial-gradient(circle, rgba(139,92,246,0.04) 0%, transparent 70%); bottom: 50px; left: -150px; }
    .bg-grid {
        position: fixed; inset: 0;
        background-image: linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none; z-index: 0;
    }
    .admin-inner { position: relative; z-index: 1; }

    /* ── TOPBAR (TULISAN TIDAK GEPENG) ── */
    .topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 45px; flex-wrap: wrap; gap: 20px; }
    .topbar-eyebrow {
        font-size: 12px; font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--primary); margin-bottom: 8px; display: flex; align-items: center; gap: 10px;
    }
    .topbar-eyebrow::before { content: ''; display: block; width: 20px; height: 2px; background: var(--primary); }

    .topbar-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 48px;
        letter-spacing: 0.05em; /* Memberi ruang antar huruf agar tidak gepeng */
        color: var(--text);
        line-height: 1.1;
        margin: 0;
    }
    .topbar-title span { -webkit-text-stroke: 1.5px rgba(37,99,235,0.3); color: transparent; }

    .btn-add-top {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 14px 28px; background: linear-gradient(135deg, var(--primary), var(--accent));
        border: none; border-radius: 14px; color: white !important;
        font-family: 'Bebas Neue', sans-serif; font-size: 18px; letter-spacing: 0.08em;
        cursor: pointer; text-decoration: none; transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    }
    .btn-add-top:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(37, 99, 235, 0.3); }

    /* ── STATS ── */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 35px; }
    .stat-card {
        background: var(--card); border: 1px solid var(--border); border-radius: 24px;
        padding: 28px; position: relative; transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }
    .stat-card:hover { transform: translateY(-5px); border-color: var(--primary); box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
    .stat-icon {
        width: 50px; height: 50px; border-radius: 12px; display: flex;
        align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;
    }
    .stat-label { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); }
    .stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 52px; letter-spacing: 0.03em; color: var(--text); line-height: 1; }

    /* ── TABLE CARD ── */
    .table-card {
        background: var(--card); border: 1px solid var(--border); border-radius: 28px;
        overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.03);
    }
    .table-toolbar { padding: 25px 30px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .search-box { position: relative; width: 100%; max-width: 350px; }
    .search-box i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--muted); }
    .search-box input {
        width: 100%; padding: 12px 20px 12px 48px;
        background: var(--card-2); border: 1px solid transparent; border-radius: 12px;
        font-family: 'Syne', sans-serif; font-size: 14px; transition: all 0.3s;
    }
    .search-box input:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.05); }

    .sv-table { width: 100%; border-collapse: collapse; }
    .sv-table thead th {
        padding: 20px 30px; font-size: 11px; font-weight: 800; letter-spacing: 0.15em;
        text-transform: uppercase; color: var(--muted); background: var(--card-2); text-align: left;
    }
    .sv-table tbody td { padding: 24px 30px; border-bottom: 1px solid rgba(0,0,0,0.03); vertical-align: middle; }

    .brand-box { display: flex; align-items: center; gap: 18px; }
    .brand-initial {
        width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--primary), var(--accent)); color: white;
        font-family: 'Bebas Neue', sans-serif; font-size: 22px; letter-spacing: 1px;
    }
    .brand-name { font-weight: 800; font-size: 16px; color: var(--text); text-transform: uppercase; letter-spacing: 0.02em; }
    .brand-id { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: var(--muted); margin-top: 2px; }

    .status-pill {
        display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px;
        border-radius: 12px; font-size: 11px; font-weight: 800; letter-spacing: 0.05em;
        text-transform: uppercase; background: rgba(16,185,129,0.08); color: #107e5e; border: 1px solid rgba(16,185,129,0.1);
    }
    .status-dot { width: 7px; height: 7px; background: var(--success); border-radius: 50%; box-shadow: 0 0 10px var(--success); }

    .action-btn {
        width: 40px; height: 40px; border-radius: 12px; display: inline-flex;
        align-items: center; justify-content: center; border: 1px solid var(--border);
        background: white; color: var(--muted); transition: all 0.2s; cursor: pointer; text-decoration: none;
    }
    .action-btn:hover { border-color: var(--primary); color: var(--primary); background: rgba(37,99,235,0.05); transform: rotate(5deg); }
    .action-btn.danger:hover { border-color: var(--danger); color: var(--danger); background: rgba(239,68,68,0.05); transform: rotate(-5deg); }

    @media (max-width: 992px) { .stats-grid { grid-template-columns: 1fr; } .admin-wrap { padding: 25px; } }
</style>

<div class="admin-wrap">
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-grid"></div>

    <div class="admin-inner">

        {{-- ── TOPBAR ── --}}
        <div class="topbar">
            <div>
                <div class="topbar-eyebrow">Inventory Division</div>
                <h1 class="topbar-title">BRAND <span>AUTHORITY.</span></h1>
            </div>
            <a href="{{ route('admin.brands.create') }}" class="btn-add-top">
                <i class="fa fa-plus"></i> Tambah Brand Baru
            </a>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(37,99,235,0.08);color:var(--primary);"><i class="fa fa-building-shield"></i></div>
                <div class="stat-label">Registered Brands</div>
                <div class="stat-num">{{ str_pad($brands->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(16,185,129,0.08);color:var(--success);"><i class="fa fa-circle-check"></i></div>
                <div class="stat-label">Live Status</div>
                <div class="stat-num">{{ str_pad($brands->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(139,92,246,0.08);color:var(--accent);"><i class="fa fa-calendar-check"></i></div>
                <div class="stat-label">Added This Month</div>
                <div class="stat-num">{{ str_pad($brands->filter(fn($b) => $b->created_at->isCurrentMonth())->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        {{-- ── MAIN TABLE ── --}}
        <div class="table-card">

            <div class="table-toolbar">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchBrand" placeholder="Cari nama brand secara instan...">
                </div>
                @if(session('success'))
                <div style="font-size: 13px; color: var(--success); font-weight: 700;">
                    <i class="fa fa-check-circle"></i> DATA UPDATED
                </div>
                @endif
            </div>

            <div style="overflow-x:auto;">
                <table class="sv-table">
                    <thead>
                        <tr>
                            <th style="width:100px; text-align:center;">No.</th>
                            <th>Brand</th>
                            
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                        <tr class="brand-row" data-name="{{ strtolower($brand->nama_brand) }}">
                            <td style="text-align:center; font-family:'JetBrains Mono'; color:var(--muted);">
                                #{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td>
                                <div class="brand-box">
                                    <div class="brand-initial">{{ substr($brand->nama_brand, 0, 1) }}</div>
                                    <div>
                                        <div class="brand-name">{{ $brand->nama_brand }}</div>
                                        <div class="brand-id">UID: {{ str_pad($brand->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>

                            <td style="text-align:center;">
                                <div style="display:inline-flex; gap:10px;">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="action-btn" title="Edit Entity">
                                        <i class="fa fa-pen-nib"></i>
                                    </a>
                                    <button onclick="openDeleteModal({{ $brand->id }}, '{{ addslashes($brand->nama_brand) }}')" class="action-btn danger" title="Remove">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:80px; color:var(--muted);">
                                <i class="fa fa-box-open" style="font-size:50px; opacity:0.1; margin-bottom:20px; display:block;"></i>
                                <p style="font-weight: 600; letter-spacing: 0.05em;">NO BRAND ENTITIES FOUND</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modern Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
        <div class="modal-content" style="border-radius:30px; border:none; box-shadow: 0 25px 60px rgba(0,0,0,0.2);">
            <div class="modal-body" style="padding:45px; text-align:center;">
                <div style="width:80px; height:80px; background:rgba(239,68,68,0.1); color:var(--danger); border-radius:24px; display:flex; align-items:center; justify-content:center; font-size:32px; margin:0 auto 25px; transform: rotate(-5deg);">
                    <i class="fa fa-ban"></i>
                </div>
                <h3 style="font-family:'Bebas Neue'; letter-spacing:0.05em; font-size:32px; color: var(--text);">DELETE BRAND?</h3>
                <p style="color:var(--muted); font-size:15px; line-height:1.6; margin-bottom:35px;">Entitas <strong id="deleteName" style="color:var(--text)"></strong> akan dihapus secara permanen dari sistem.</p>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                    <button class="btn" data-bs-dismiss="modal" style="padding:14px; border-radius:15px; background:var(--card-2); font-weight:700; border:none; color: var(--muted);">CANCEL</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="width:100%; padding:14px; border-radius:15px; background:var(--danger); color:white; border:none; font-weight:700; box-shadow: 0 8px 15px rgba(239,68,68,0.2);">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Live Instant Search
    document.getElementById('searchBrand').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.brand-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    // Modal Delete Logic
    function openDeleteModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = `{{ url('admin/brands') }}/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>

@endsection
