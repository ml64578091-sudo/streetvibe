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
        --ink: #ffffff;
        --card: #ffffff;
        --card-2: #f5f5f7;
        --border: rgba(0,0,0,0.08);
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
    .orb-2  { width: 400px; height: 400px; background: radial-gradient(circle, rgba(61,220,132,0.05) 0%, transparent 70%); bottom: 100px; left: -100px; }
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
        width: 44px; height: 44px; border-radius: 10px; display: flex;
        align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px;
    }
    .stat-label { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
    .stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 48px; letter-spacing: 1px; color: #0b0b0f; line-height: 1; }

    /* ── TABLE CARD ── */
    .table-card {
        background: var(--card); border: 1px solid var(--border); border-radius: 24px;
        overflow: hidden; animation: fadeUp 0.6s 0.2s ease both;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }
    .table-toolbar { padding: 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 15px; }
    .search-box { position: relative; flex: 1; max-width: 320px; }
    .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--muted); }
    .search-box input {
        width: 100%; padding: 10px 16px 10px 42px;
        background: var(--card-2); border: 1px solid var(--border); border-radius: 10px;
        font-family: 'Syne', sans-serif; font-size: 14px; transition: all 0.3s;
    }
    .search-box input:focus { outline: none; border-color: var(--primary); background: white; }

    .sv-table { width: 100%; border-collapse: collapse; }
    .sv-table thead th {
        padding: 16px 24px; font-size: 10px; font-weight: 800; letter-spacing: 2px;
        text-transform: uppercase; color: var(--muted); background: var(--card-2);
    }
    .sv-table tbody td { padding: 18px 24px; border-bottom: 1px solid rgba(0,0,0,0.04); vertical-align: middle; }

    .cat-badge {
        width: 40px; height: 40px; border-radius: 10px; display: flex;
        align-items: center; justify-content: center; background: rgba(37,99,235,0.08); color: var(--primary);
    }
    .cat-name { font-weight: 800; font-size: 14px; color: #0b0b0f; text-transform: uppercase; }
    .cat-id { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: var(--muted); }

    .status-pill {
        display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px;
        border-radius: 8px; font-size: 10px; font-weight: 800; letter-spacing: 1px;
        text-transform: uppercase; background: rgba(61,220,132,0.1); color: #2d9d66; border: 1px solid rgba(61,220,132,0.2);
    }
    .status-dot { width: 6px; height: 6px; background: #2d9d66; border-radius: 50%; }

    .action-btn {
        width: 36px; height: 36px; border-radius: 10px; display: inline-flex;
        align-items: center; justify-content: center; border: 1px solid var(--border);
        background: white; color: var(--muted); transition: all 0.2s; cursor: pointer; text-decoration: none;
    }
    .action-btn:hover { border-color: var(--primary); color: var(--primary); background: rgba(37,99,235,0.05); }
    .action-btn.danger:hover { border-color: var(--danger); color: var(--danger); background: rgba(255,92,92,0.05); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } .admin-wrap { padding: 20px; } }
</style>

<div class="admin-wrap">
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-grid"></div>

    <div class="admin-inner">

        {{-- ── TOPBAR ── --}}
        <div class="topbar">
            <div>
                <div class="topbar-eyebrow">Category Control</div>
                <div class="topbar-title">SYSTEM <span>GENRE.</span></div>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn-add-top">
                <i class="fa fa-plus"></i> Tambah Kategori
            </a>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(37,99,235,0.1);color:var(--primary);"><i class="fa fa-tags"></i></div>
                <div class="stat-label">Total Categories</div>
                <div class="stat-num">{{ str_pad($categories->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(61,220,132,0.1);color:var(--success);"><i class="fa fa-check-double"></i></div>
                <div class="stat-label">Active Status</div>
                <div class="stat-num">{{ str_pad($categories->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:rgba(255,210,0,0.1);color:var(--gold);"><i class="fa fa-calendar-plus"></i></div>
                <div class="stat-label">New This Month</div>
                <div class="stat-num">{{ str_pad($categories->where('created_at', '>=', now()->startOfMonth())->count(), 2, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        {{-- ── MAIN TABLE ── --}}
        <div class="table-card">

            <div class="table-toolbar">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchCategory" placeholder="Cari nama kategori...">
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="sv-table">
                    <thead>
                        <tr>
                            <th style="width:80px; text-align:center;">#</th>
                            <th>Nama Kategori</th>
                            <th></th>
                            <th style="width:120px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr class="category-row" data-name="{{ strtolower($category->nama_kategori) }}">
                            <td style="text-align:center; font-family:'JetBrains Mono'; color:var(--muted); font-size:12px;">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td>
                                <div style="display:flex; align-items:center; gap:15px;">
                                    <div class="cat-badge"><i class="fa fa-folder-tree"></i></div>
                                    <div>
                                        <div class="cat-name">{{ $category->nama_kategori }}</div>
                                        <div class="cat-id">ID: #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:center;">

                            </td>
                            <td style="text-align:center;">
                                <div style="display:inline-flex; gap:8px;">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="action-btn" title="Edit">
                                        <i class="fa fa-pen-to-square"></i>
                                    </a>
                                    <button onclick="openModal({{ $category->id }}, '{{ $category->nama_kategori }}')" class="action-btn danger" title="Delete">
                                        <i class="fa fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:60px; color:var(--muted);">
                                <i class="fa fa-folder-open" style="font-size:40px; opacity:0.2; margin-bottom:15px; display:block;"></i>
                                <p>Belum ada kategori yang tersedia.</p>
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
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content" style="border-radius:24px; border:none; overflow:hidden;">
            <div class="modal-body" style="padding:40px; text-align:center;">
                <div style="width:70px; height:70px; background:rgba(255,92,92,0.1); color:var(--danger); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:28px; margin:0 auto 20px;">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <h3 style="font-family:'Bebas Neue'; letter-spacing:1px; font-size:26px;">Hapus Kategori?</h3>
                <p style="color:var(--muted); font-size:14px; margin-bottom:30px;">Kategori <strong id="deleteName"></strong> akan dihapus permanen.</p>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                    <button class="btn" data-bs-dismiss="modal" style="padding:10px; border-radius:10px; background:var(--card-2); font-weight:700; border:none;">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="width:100%; padding:10px; border-radius:10px; background:var(--danger); color:white; border:none; font-weight:700;">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search Functionality
    document.getElementById('searchCategory').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.category-row').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });

    // Modal Handler
    function openModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/categories/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>

@endsection
