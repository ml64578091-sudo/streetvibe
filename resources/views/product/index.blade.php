@extends('layouts.backend')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
*, *::before, *::after { box-sizing: border-box; }

:root {
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
    --sale: #ff9f40;
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

/* ── BG ── */
.bg-orb { position: fixed; border-radius: 50%; pointer-events: none; z-index: 0; }
.orb-1  { width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,210,0,0.08) 0%, transparent 70%); top: -150px; right: -100px; }
.orb-2  { width: 400px; height: 400px; background: radial-gradient(circle, rgba(247,151,30,0.06) 0%, transparent 70%); bottom: 100px; left: -100px; }
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
    color: var(--gold); margin-bottom: 4px;
    display: flex; align-items: center; gap: 8px;
}
.topbar-eyebrow::before { content: ''; display: block; width: 16px; height: 2px; background: var(--gold); }
.topbar-title { font-family: 'Bebas Neue', sans-serif; font-size: 42px; letter-spacing: 2px; color: #0b0b0f; line-height: 1; }
.topbar-title span { -webkit-text-stroke: 1.5px rgba(255,210,0,0.5); color: transparent; }

.topbar-right { display: flex; align-items: center; gap: 12px; }
.topbar-time {
    background: var(--card); border: 1px solid var(--border); border-radius: 10px;
    padding: 10px 18px; font-family: 'JetBrains Mono', monospace; font-size: 13px; color: var(--muted);
}
.topbar-time span { color: var(--gold); }
.btn-add-top {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 11px 20px; background: linear-gradient(135deg, #FFD200, #F7971E);
    border: none; border-radius: 10px; color: #0b0b0f;
    font-family: 'Bebas Neue', sans-serif; font-size: 15px; letter-spacing: 2px;
    cursor: pointer; text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 6px 24px rgba(255,210,0,0.2);
}
.btn-add-top:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(255,210,0,0.3); color: #0b0b0f; }

/* ── STATS ── */
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px; }
.stat-card {
    background: var(--card); border: 1px solid var(--border); border-radius: 18px;
    padding: 24px 28px; position: relative; overflow: hidden;
    transition: border-color 0.3s, transform 0.3s;
    animation: fadeUp 0.5s ease both;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.10s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 18px;
    opacity: 0; transition: opacity 0.3s;
    background: linear-gradient(135deg, rgba(255,210,0,0.08), transparent);
}
.stat-card:hover { border-color: var(--border-hover); transform: translateY(-3px); }
.stat-card:hover::before { opacity: 1; }
.stat-card-glow { position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; border-radius: 50%; opacity: 0.3; filter: blur(30px); }
.stat-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.stat-label { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); }
.stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
.stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 52px; letter-spacing: 2px; line-height: 1; color: #0b0b0f; }
.stat-sub { font-size: 12px; color: var(--muted); margin-top: 6px; }

/* ── MAIN CARD ── */
.table-card {
    background: var(--card); border: 1px solid var(--border); border-radius: 20px;
    overflow: hidden; animation: fadeUp 0.5s 0.2s ease both;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

/* ── TOOLBAR ── */
.table-toolbar {
    padding: 20px 24px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
}
.search-box { position: relative; flex: 1; max-width: 300px; }
.search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; pointer-events: none; }
.search-box input {
    width: 100%; padding: 10px 16px 10px 40px;
    background: var(--card-2); border: 1px solid var(--border); border-radius: 10px;
    color: var(--text); font-family: 'Syne', sans-serif; font-size: 13px;
    outline: none; transition: border-color 0.25s, box-shadow 0.25s;
}
.search-box input::placeholder { color: var(--muted); }
.search-box input:focus { border-color: rgba(255,210,0,0.4); box-shadow: 0 0 0 3px rgba(255,210,0,0.08); }

.view-toggle { display: flex; gap: 4px; margin-left: auto; }
.vbtn {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px; border-radius: 8px;
    border: 1px solid var(--border); background: transparent;
    color: var(--muted); font-size: 14px; cursor: pointer; transition: all 0.2s;
}
.vbtn:hover { border-color: var(--border-hover); color: var(--text); }
.vbtn.active { background: rgba(255,210,0,0.1); border-color: rgba(255,210,0,0.35); color: var(--gold); }

/* ── TABLE ── */
.sv-table { width: 100%; border-collapse: collapse; }
.sv-table thead th {
    padding: 14px 20px; font-size: 10px; font-weight: 700; letter-spacing: 2.5px;
    text-transform: uppercase; color: var(--muted);
    border-bottom: 1px solid var(--border); background: var(--card-2); white-space: nowrap;
}
.sv-table tbody tr { transition: background 0.2s; }
.sv-table tbody tr:hover { background: rgba(255,210,0,0.04); }
.sv-table tbody td { padding: 15px 20px; border-bottom: 1px solid rgba(0,0,0,0.04); font-size: 14px; vertical-align: middle; }
.sv-table tbody tr:last-child td { border-bottom: none; }

.row-num { font-family: 'JetBrains Mono', monospace; font-size: 12px; color: var(--muted); text-align: center; font-weight: 600; }
.prod-cell { display: flex; align-items: center; gap: 14px; }
.prod-img { width: 50px; height: 50px; border-radius: 12px; overflow: hidden; border: 1px solid var(--border); flex-shrink: 0; background: var(--card-2); }
.prod-img img { width: 100%; height: 100%; object-fit: cover; }
.prod-name { font-weight: 700; font-size: 14px; color: #0b0b0f; margin-bottom: 3px; }
.prod-id { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: var(--muted); }

.chip { display: inline-block; padding: 5px 12px; border-radius: 7px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; }
.chip-cat   { background: rgba(100,140,255,0.12); color: #6a8cff; border: 1px solid rgba(100,140,255,0.2); }
.chip-brand { background: rgba(255,159,64,0.1);  color: #ff9f40; border: 1px solid rgba(255,159,64,0.2); }
.chip-price { font-family: 'JetBrains Mono', monospace; background: rgba(61,220,132,0.12); color: #2d9d66; border: 1px solid rgba(61,220,132,0.2); letter-spacing: 0; }

.status-pill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
.status-dot { width: 6px; height: 6px; border-radius: 50%; }
.pill-ready  { background: rgba(61,220,132,0.12);  color: #2d9d66; border: 1px solid rgba(61,220,132,0.2); }
.pill-ready .status-dot  { background: #2d9d66; box-shadow: 0 0 6px rgba(61,220,132,0.4); }
.pill-sale   { background: rgba(255,159,64,0.12);  color: #cc7f1f;    border: 1px solid rgba(255,159,64,0.2); }
.pill-sale .status-dot   { background: #cc7f1f; box-shadow: 0 0 6px rgba(255,159,64,0.4); }
.pill-sold   { background: rgba(255,92,92,0.12);   color: #d63c3c;  border: 1px solid rgba(255,92,92,0.2); }
.pill-sold .status-dot   { background: #d63c3c; box-shadow: 0 0 6px rgba(255,92,92,0.4); }
.pill-default{ background: rgba(0,0,0,0.05); color: var(--muted);  border: 1px solid var(--border); }
.pill-default .status-dot { background: var(--muted); }

.action-btn {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 8px;
    border: 1px solid var(--border); background: transparent;
    color: var(--muted); font-size: 13px; cursor: pointer;
    transition: all 0.2s; text-decoration: none;
}
.action-btn:hover         { border-color: var(--gold);   color: var(--gold);   background: rgba(255,210,0,0.08); }
.action-btn.danger:hover  { border-color: var(--danger); color: var(--danger); background: rgba(255,92,92,0.08); }

/* ── GRID VIEW ── */
#gridView { display: none; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 14px; padding: 20px; }
#gridView.on { display: grid; }
.g-card {
    background: var(--card); border: 1px solid var(--border); border-radius: 14px;
    overflow: hidden; transition: border-color 0.25s, transform 0.25s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.g-card:hover { border-color: var(--border-hover); transform: translateY(-3px); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
.g-img { width: 100%; height: 140px; object-fit: cover; display: block; background: var(--card-2); }
.g-body { padding: 14px; }
.g-name { font-size: 13px; font-weight: 700; color: #0b0b0f; margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.g-price { font-family: 'JetBrains Mono', monospace; font-size: 12px; color: #2d9d66; margin: 8px 0 10px; display: block; font-weight: 600; }
.g-actions { display: flex; gap: 6px; }
.g-btn {
    flex: 1; padding: 7px 0; border-radius: 8px; border: 1px solid var(--border);
    background: transparent; color: var(--muted); font-size: 12px; font-family: 'Syne', sans-serif;
    font-weight: 600; cursor: pointer; text-align: center; text-decoration: none;
    transition: all 0.2s; display: inline-block;
}
.g-btn:hover      { border-color: var(--gold);   color: var(--gold);   background: rgba(255,210,0,0.08); }
.g-btn.del:hover  { border-color: var(--danger); color: var(--danger); background: rgba(255,92,92,0.08); }

/* ── EMPTY ── */
.empty-state { text-align: center; padding: 64px 20px; color: var(--muted); }
.empty-state i { font-size: 40px; margin-bottom: 16px; opacity: 0.3; display: block; }

/* ── PAGINATION ── */
.product-row { display: none; }
.product-row.active-page { display: table-row; }
.g-card { display: none; }
.g-card.active-page { display: block; }

.table-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px; border-top: 1px solid var(--border); background: var(--card-2);
}
.page-info { font-size: 12px; color: var(--muted); font-family: 'JetBrains Mono', monospace; }
.page-info span { color: var(--gold); font-weight: 600; }
.pag-controls { display: flex; align-items: center; gap: 5px; }
.pag-btn {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 34px; height: 34px; border-radius: 8px;
    border: 1px solid var(--border); background: transparent;
    color: var(--muted); font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 600;
    cursor: pointer; transition: all 0.2s; padding: 0 8px;
}
.pag-btn:hover:not(:disabled) { border-color: var(--gold); color: var(--gold); background: rgba(255,210,0,0.08); }
.pag-btn.active { background: linear-gradient(135deg, #FFD200, #F7971E); border-color: transparent; color: #0b0b0f; font-weight: 800; }
.pag-btn:disabled { opacity: 0.3; cursor: not-allowed; }

/* ── ANIM ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) { .stats-grid { grid-template-columns: 1fr 1fr; } .admin-wrap { padding: 24px 20px; } }
@media (max-width: 640px)  { .stats-grid { grid-template-columns: 1fr; } .topbar-title { font-size: 32px; } }
</style>

<div class="admin-wrap">
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-grid"></div>

    <div class="admin-inner">

        {{-- ── TOPBAR ── --}}
        <div class="topbar">
            <div>
                <div class="topbar-eyebrow">Product Management</div>
                <div class="topbar-title">CATALOG <span>HUB.</span></div>
            </div>
            <div class="topbar-right">
                <div class="topbar-time">
                    <i class="fa fa-circle-dot" style="color:var(--success);font-size:8px;"></i>
                    &nbsp;<span id="live-time">--:--:--</span>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn-add-top">
                    <i class="fa fa-plus" style="font-size:12px;"></i> Tambah Produk
                </a>
            </div>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-glow" style="background:rgba(255,210,0,0.5);"></div>
                <div class="stat-top">
                    <div class="stat-label">Total Produk</div>
                    <div class="stat-icon" style="background:rgba(255,210,0,0.1);color:var(--gold);"><i class="fa fa-boxes-stacked"></i></div>
                </div>
                <div class="stat-num" style="color:var(--gold);">{{ str_pad($products->count(), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">produk dalam katalog</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-glow" style="background:rgba(61,220,132,0.5);"></div>
                <div class="stat-top">
                    <div class="stat-label">Ready Stock</div>
                    <div class="stat-icon" style="background:rgba(61,220,132,0.1);color:var(--success);"><i class="fa fa-circle-check"></i></div>
                </div>
                <div class="stat-num" style="color:var(--success);">{{ str_pad($products->where('status','ready')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">tersedia untuk dibeli</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-glow" style="background:rgba(255,159,64,0.5);"></div>
                <div class="stat-top">
                    <div class="stat-label">On Sale</div>
                    <div class="stat-icon" style="background:rgba(255,159,64,0.1);color:var(--sale);"><i class="fa fa-bolt"></i></div>
                </div>
                <div class="stat-num" style="color:var(--sale);">{{ str_pad($products->where('status','sale')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">sedang promo diskon</div>
            </div>
        </div>

        {{-- ── MAIN CARD ── --}}
        <div class="table-card">

            {{-- Toolbar --}}
            <div class="table-toolbar">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari produk atau brand...">
                </div>
                <div class="view-toggle">
                    <button class="vbtn active" id="btnList" onclick="setView('list')" title="List View">
                        <i class="fa fa-list"></i>
                    </button>
                    <button class="vbtn" id="btnGrid" onclick="setView('grid')" title="Grid View">
                        <i class="fa fa-grid-2"></i>
                    </button>
                </div>
            </div>

            {{-- ── LIST VIEW ── --}}
            <div id="listView">
                <div style="overflow-x:auto;">
                    <table class="sv-table">
                        <thead>
                            <tr>
                                <th style="width:50px;text-align:center;">#</th>
                                <th>Produk</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            @forelse($products as $index => $p)
                            <tr class="product-row"
                                data-index="{{ $index }}"
                                data-name="{{ strtolower($p->nama_produk) }}"
                                data-brand="{{ strtolower($p->brand->nama_brand ?? '') }}">

                                <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>

                                <td>
                                    <div class="prod-cell">
                                        <div class="prod-img">
                                            <img src="{{ $p->gambar ? Storage::url($p->gambar) : 'https://placehold.co/50x50/f5f5f7/999?text=SV' }}" alt="{{ $p->nama_produk }}">
                                        </div>
                                        <div>
                                            <div class="prod-name">{{ $p->nama_produk }}</div>
                                            <div class="prod-id">#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @php
                                        $pillClass = match($p->status) { 'ready' => 'pill-ready', 'sale' => 'pill-sale', 'sold out' => 'pill-sold', default => 'pill-default' };
                                        $pillLabel = match($p->status) { 'ready' => 'Ready', 'sale' => 'On Sale', 'sold out' => 'Sold Out', default => ucfirst($p->status) };
                                    @endphp
                                    <span class="status-pill {{ $pillClass }}">
                                        <span class="status-dot"></span>{{ $pillLabel }}
                                    </span>
                                </td>

                                <td><span class="chip chip-cat">{{ $p->category->nama_kategori ?? 'N/A' }}</span></td>
                                <td><span class="chip chip-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span></td>

                                <td style="text-align:center;">
                                    <div style="display:inline-flex;gap:6px;">
                                        <a href="{{ route('admin.products.edit', $p->id) }}" class="action-btn" title="Edit">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}"
                                              onsubmit="return confirm('Hapus produk ini?')" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-btn danger" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fa fa-box-open"></i>
                                        <p>Belum ada produk. Mulai tambahkan sekarang.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── GRID VIEW ── --}}
            <div id="gridView">
                @foreach($products as $index => $p)
                <div class="g-card"
                     data-index="{{ $index }}"
                     data-name="{{ strtolower($p->nama_produk) }}"
                     data-brand="{{ strtolower($p->brand->nama_brand ?? '') }}">
                    <img src="{{ $p->gambar ? Storage::url($p->gambar) : 'https://placehold.co/200x140/f5f5f7/999?text=SV' }}"
                         class="g-img" alt="{{ $p->nama_produk }}">
                    <div class="g-body">
                        <div class="g-name" title="{{ $p->nama_produk }}">{{ $p->nama_produk }}</div>
                        @php
                            $pc = match($p->status) { 'ready' => 'pill-ready', 'sale' => 'pill-sale', 'sold out' => 'pill-sold', default => 'pill-default' };
                            $pl = match($p->status) { 'ready' => 'Ready', 'sale' => 'On Sale', 'sold out' => 'Sold Out', default => ucfirst($p->status) };
                        @endphp
                        <span class="status-pill {{ $pc }}" style="font-size:10px;padding:4px 10px;">
                            <span class="status-dot"></span>{{ $pl }}
                        </span>
                        <span class="g-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                        <div class="g-actions">
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="g-btn">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}"
                                  onsubmit="return confirm('Hapus produk ini?')" style="flex:1;">
                                @csrf @method('DELETE')
                                <button type="submit" class="g-btn del" style="width:100%;">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Footer / Pagination --}}
            <div class="table-footer">
                <div class="page-info" id="pageInfo">—</div>
                <div class="pag-controls">
                    <button class="pag-btn" id="prevBtn" onclick="changePage(-1)">
                        <i class="fa fa-chevron-left" style="font-size:11px;"></i>
                    </button>
                    <div id="pageNumbers" style="display:flex;gap:5px;"></div>
                    <button class="pag-btn" id="nextBtn" onclick="changePage(1)">
                        <i class="fa fa-chevron-right" style="font-size:11px;"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
/* ── CLOCK ── */
function updateClock() {
    document.getElementById('live-time').textContent =
        new Date().toLocaleTimeString('id-ID', { hour12: false });
}
updateClock(); setInterval(updateClock, 1000);

/* ── STATE ── */
let currentPage = 1;
const itemsPerPage = 8;
let currentView = 'list';
let allRows  = Array.from(document.querySelectorAll('.product-row'));
let allCards = Array.from(document.querySelectorAll('.g-card'));
let visibleRows  = [...allRows];
let visibleCards = [...allCards];

/* ── VIEW TOGGLE ── */
function setView(v) {
    currentView = v;
    const isList = v === 'list';
    document.getElementById('listView').style.display = isList ? '' : 'none';
    document.getElementById('gridView').classList.toggle('on', !isList);
    document.getElementById('btnList').classList.toggle('active', isList);
    document.getElementById('btnGrid').classList.toggle('active', !isList);
    showPage(1);
}

/* ── SEARCH ── */
document.getElementById('searchInput').addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    visibleRows  = allRows.filter(r  => r.dataset.name.includes(q) || r.dataset.brand.includes(q));
    visibleCards = allCards.filter(c => c.dataset.name.includes(q) || c.dataset.brand.includes(q));
    showPage(1);
});

/* ── PAGINATION ── */
function showPage(page) {
    const items   = currentView === 'list' ? visibleRows  : visibleCards;
    const allItem = currentView === 'list' ? allRows      : allCards;
    const total      = items.length;
    const totalPages = Math.max(1, Math.ceil(total / itemsPerPage));
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;
    currentPage = page;

    const start = (page - 1) * itemsPerPage;
    const end   = start + itemsPerPage;

    allItem.forEach(r => r.classList.remove('active-page'));
    items.forEach((r, i) => { if (i >= start && i < end) r.classList.add('active-page'); });

    const displayEnd = Math.min(end, total);
    const info = document.getElementById('pageInfo');
    info.innerHTML = total > 0
        ? `Showing <span>${start + 1}–${displayEnd}</span> of <span>${total}</span> produk`
        : `<span>Tidak ada hasil</span>`;

    document.getElementById('prevBtn').disabled = (page === 1);
    document.getElementById('nextBtn').disabled = (page === totalPages || total === 0);
    renderPageNums(totalPages);
}

function changePage(step) { showPage(currentPage + step); }

function renderPageNums(totalPages) {
    const c = document.getElementById('pageNumbers');
    c.innerHTML = '';
    let start = Math.max(1, currentPage - 2);
    let end   = Math.min(totalPages, start + 4);
    if (end - start < 4) start = Math.max(1, end - 4);
    for (let i = start; i <= end; i++) {
        const btn = document.createElement('button');
        btn.className = 'pag-btn' + (i === currentPage ? ' active' : '');
        btn.textContent = i;
        btn.onclick = () => showPage(i);
        c.appendChild(btn);
    }
}

document.addEventListener('DOMContentLoaded', () => showPage(1));
</script>

@endsection
