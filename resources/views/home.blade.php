@extends('layouts.backend')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
*, *::before, *::after { box-sizing: border-box; }

:root {
    --gold:        #C9960C;
    --gold-light:  #F5C842;
    --gold-bg:     #FEFAF0;
    --gold-border: #F0D96A;
    --cream:       #FAFAF7;
    --white:       #FFFFFF;
    --stone-50:    #F7F6F2;
    --stone-100:   #EEECE6;
    --stone-200:   #DEDAD0;
    --stone-400:   #A8A59A;
    --stone-600:   #6B6860;
    --stone-800:   #2E2C27;
    --ink:         #1A1916;

    --success:     #2D7D4F;
    --success-bg:  #EAF5EF;
    --success-bd:  #A8D9BC;
    --danger:      #B53232;
    --danger-bg:   #FBF0F0;
    --danger-bd:   #E8AAAA;
    --sale:        #C06B10;
    --sale-bg:     #FEF4E8;
    --sale-bd:     #F4C48A;

    --shadow-sm:   0 1px 3px rgba(26,25,22,0.07), 0 1px 2px rgba(26,25,22,0.04);
    --shadow-md:   0 4px 12px rgba(26,25,22,0.08), 0 2px 4px rgba(26,25,22,0.04);
    --shadow-lg:   0 10px 32px rgba(26,25,22,0.1), 0 4px 8px rgba(26,25,22,0.04);
}

.admin-wrap {
    background: var(--cream);
    font-family: 'DM Sans', sans-serif;
    color: var(--ink);
    min-height: 100vh;
    padding: 40px 44px;
    position: relative;
}

/* ── NOISE TEXTURE ── */
.admin-wrap::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.025'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
}
.admin-inner { position: relative; z-index: 1; }

/* ── TOPBAR ── */
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 44px;
}
.topbar-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3.5px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.eyebrow-line {
    display: block;
    width: 24px;
    height: 1.5px;
    background: var(--gold-light);
    border-radius: 2px;
}
.topbar-title {
    font-family: 'Playfair Display', serif;
    font-size: 40px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
    letter-spacing: -0.5px;
}
.topbar-title em {
    font-style: italic;
    color: var(--gold);
}
.topbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
}
.topbar-time {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--white);
    border: 1px solid var(--stone-200);
    border-radius: 10px;
    padding: 10px 18px;
    font-family: 'DM Mono', monospace;
    font-size: 13px;
    color: var(--stone-600);
    box-shadow: var(--shadow-sm);
}
.live-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--success);
    animation: pulse 2s ease infinite;
    flex-shrink: 0;
}
@keyframes pulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:0.5; transform:scale(0.8); }
}
.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    background: var(--ink);
    border: 1px solid var(--ink);
    border-radius: 10px;
    color: #FEFAF0;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.3px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
    box-shadow: var(--shadow-sm);
}
.btn-add:hover {
    background: #2E2C27;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    color: #FEFAF0;
}
.btn-add-icon {
    width: 20px; height: 20px;
    border-radius: 5px;
    background: rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px;
}

/* ── DIVIDER ── */
.section-divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}
.divider-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--stone-400);
    white-space: nowrap;
}
.divider-line {
    flex: 1;
    height: 1px;
    background: var(--stone-200);
}

/* ── STAT CARDS ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}
.stat-card {
    background: var(--white);
    border: 1px solid var(--stone-200);
    border-radius: 16px;
    padding: 24px 26px;
    position: relative;
    overflow: hidden;
    transition: transform 0.25s, box-shadow 0.25s;
    animation: fadeUp 0.5s ease both;
    box-shadow: var(--shadow-sm);
}
.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

/* accent strip top */
.stat-card::after {
    content: '';
    position: absolute;
    top: 0; left: 24px; right: 24px;
    height: 2px;
    border-radius: 0 0 4px 4px;
    opacity: 0;
    transition: opacity 0.3s;
}
.stat-card:hover::after { opacity: 1; }
.stat-card.gold-accent::after  { background: linear-gradient(90deg,#C9960C,#F5C842); }
.stat-card.green-accent::after { background: var(--success); }
.stat-card.sale-accent::after  { background: var(--sale); }

.stat-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 18px;
}
.stat-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--stone-400);
}
.stat-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    border: 1px solid transparent;
}
.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 48px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: -1px;
}
.stat-sub {
    font-size: 12px;
    color: var(--stone-400);
    margin-top: 6px;
    font-weight: 400;
}

/* ── TABLE CARD ── */
.table-card {
    background: var(--white);
    border: 1px solid var(--stone-200);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    animation: fadeUp 0.5s 0.2s ease both;
}

.table-header {
    padding: 22px 28px;
    border-bottom: 1px solid var(--stone-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    background: var(--stone-50);
}
.table-header-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--ink);
}
.table-header-sub {
    font-size: 12px;
    color: var(--stone-400);
    margin-top: 2px;
    font-weight: 400;
}

/* search */
.search-box {
    position: relative;
    flex: 1;
    max-width: 280px;
}
.search-box i {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--stone-400);
    font-size: 12px;
    pointer-events: none;
}
.search-box input {
    width: 100%;
    padding: 9px 14px 9px 36px;
    background: var(--white);
    border: 1px solid var(--stone-200);
    border-radius: 9px;
    color: var(--ink);
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-shadow: var(--shadow-sm);
}
.search-box input::placeholder { color: var(--stone-400); }
.search-box input:focus {
    border-color: var(--gold-light);
    box-shadow: 0 0 0 3px rgba(201,150,12,0.1);
}

/* ── TABLE ── */
.sv-table {
    width: 100%;
    border-collapse: collapse;
}
.sv-table thead th {
    padding: 12px 20px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--stone-400);
    border-bottom: 1px solid var(--stone-100);
    background: var(--stone-50);
    white-space: nowrap;
}
.sv-table tbody tr { transition: background 0.15s; }
.sv-table tbody tr:hover { background: var(--stone-50); }
.sv-table tbody td {
    padding: 15px 20px;
    border-bottom: 1px solid var(--stone-100);
    font-size: 13.5px;
    vertical-align: middle;
    color: var(--ink);
}
.sv-table tbody tr:last-child td { border-bottom: none; }

.row-num {
    font-family: 'DM Mono', monospace;
    font-size: 12px;
    color: var(--stone-400);
    text-align: center;
    font-weight: 500;
}

/* product cell */
.prod-cell {
    display: flex;
    align-items: center;
    gap: 14px;
}
.prod-img {
    width: 48px; height: 48px;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid var(--stone-200);
    flex-shrink: 0;
    background: var(--stone-50);
    box-shadow: var(--shadow-sm);
}
.prod-img img { width: 100%; height: 100%; object-fit: cover; }
.prod-name {
    font-weight: 600;
    font-size: 13.5px;
    color: var(--ink);
    margin-bottom: 3px;
}
.prod-id {
    font-family: 'DM Mono', monospace;
    font-size: 11px;
    color: var(--stone-400);
}

/* chips */
.chip {
    display: inline-block;
    padding: 4px 11px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 500;
    letter-spacing: 0.2px;
    border: 1px solid transparent;
}
.chip-cat {
    background: #EEF0FB;
    color: #3A4BAF;
    border-color: #C8CDEE;
}
.chip-brand {
    background: var(--sale-bg);
    color: var(--sale);
    border-color: var(--sale-bd);
}
.chip-price {
    font-family: 'DM Mono', monospace;
    background: var(--success-bg);
    color: var(--success);
    border-color: var(--success-bd);
    letter-spacing: -0.3px;
}

/* status pills */
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 11px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    border: 1px solid transparent;
}
.status-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    flex-shrink: 0;
}
.pill-ready  { background: var(--success-bg); color: var(--success); border-color: var(--success-bd); }
.pill-ready .status-dot { background: var(--success); }
.pill-sale   { background: var(--sale-bg); color: var(--sale); border-color: var(--sale-bd); }
.pill-sale .status-dot { background: var(--sale); }
.pill-sold   { background: var(--danger-bg); color: var(--danger); border-color: var(--danger-bd); }
.pill-sold .status-dot { background: var(--danger); }
.pill-default{ background: var(--stone-100); color: var(--stone-600); border-color: var(--stone-200); }
.pill-default .status-dot { background: var(--stone-400); }

/* actions */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px; height: 32px;
    border-radius: 7px;
    border: 1px solid var(--stone-200);
    background: var(--white);
    color: var(--stone-600);
    font-size: 12px;
    cursor: pointer;
    transition: all 0.18s;
    text-decoration: none;
    box-shadow: var(--shadow-sm);
}
.action-btn:hover {
    border-color: var(--gold-light);
    color: var(--gold);
    background: var(--gold-bg);
    box-shadow: none;
}
.action-btn.danger:hover {
    border-color: var(--danger-bd);
    color: var(--danger);
    background: var(--danger-bg);
    box-shadow: none;
}

/* ── PAGINATION ── */
.product-row { display: none; }
.product-row.active-page { display: table-row; }

.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 28px;
    border-top: 1px solid var(--stone-100);
    background: var(--stone-50);
}
.page-info {
    font-size: 12px;
    color: var(--stone-400);
    font-family: 'DM Mono', monospace;
}
.page-info span { color: var(--gold); font-weight: 500; }
.pag-controls { display: flex; align-items: center; gap: 5px; }
.pag-btn {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 32px; height: 32px;
    border-radius: 7px;
    border: 1px solid var(--stone-200);
    background: var(--white);
    color: var(--stone-600);
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.18s;
    padding: 0 8px;
    box-shadow: var(--shadow-sm);
}
.pag-btn:hover:not(:disabled) {
    border-color: var(--gold-light);
    color: var(--gold);
    background: var(--gold-bg);
}
.pag-btn.active {
    background: var(--ink);
    border-color: var(--ink);
    color: #FEFAF0;
    font-weight: 600;
    box-shadow: var(--shadow-sm);
}
.pag-btn:disabled { opacity: 0.35; cursor: not-allowed; box-shadow: none; }

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center;
    padding: 64px 20px;
    color: var(--stone-400);
}
.empty-state i { font-size: 36px; margin-bottom: 14px; display: block; opacity: 0.4; }
.empty-state p { font-size: 14px; }

/* ── ANIMATIONS ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .admin-wrap { padding: 24px 20px; }
}
@media (max-width: 640px) {
    .stats-grid { grid-template-columns: 1fr; }
    .topbar { flex-direction: column; align-items: flex-start; gap: 14px; }
    .topbar-title { font-size: 30px; }
}
</style>

<div class="admin-wrap">
    <div class="admin-inner">

        {{-- ── TOP BAR ── --}}
        <div class="topbar">
            <div class="topbar-left">
                <div class="topbar-eyebrow">
                    <span class="eyebrow-line"></span>
                    Products Control
                </div>
                <div class="topbar-title">Inventory <em>Hub.</em></div>
            </div>
            <div class="topbar-right">
                <div class="topbar-time">
                    <span class="live-dot"></span>
                    <span id="live-time">--:--:--</span>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn-add">
                    <span class="btn-add-icon"><i class="fa fa-plus"></i></span>
                    Add Product
                </a>
            </div>
        </div>

        {{-- ── SECTION LABEL ── --}}
        <div class="section-divider">
            <span class="divider-label">Overview</span>
            <span class="divider-line"></span>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-grid">

            <div class="stat-card gold-accent">
                <div class="stat-top">
                    <div class="stat-label">Total Items</div>
                    <div class="stat-icon" style="background:var(--gold-bg);color:var(--gold);border-color:var(--gold-border);">
                        <i class="fa fa-boxes-stacked"></i>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--ink);">{{ str_pad(count($products), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">products in inventory</div>
            </div>

            <div class="stat-card green-accent">
                <div class="stat-top">
                    <div class="stat-label">Ready</div>
                    <div class="stat-icon" style="background:var(--success-bg);color:var(--success);border-color:var(--success-bd);">
                        <i class="fa fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--success);">{{ str_pad($products->where('status','ready')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">available for purchase</div>
            </div>

            <div class="stat-card sale-accent">
                <div class="stat-top">
                    <div class="stat-label">On Sale</div>
                    <div class="stat-icon" style="background:var(--sale-bg);color:var(--sale);border-color:var(--sale-bd);">
                        <i class="fa fa-bolt"></i>
                    </div>
                </div>
                <div class="stat-num" style="color:var(--sale);">{{ str_pad($products->where('status','sale')->count(), 2, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-sub">products on discount</div>
            </div>

        </div>

        {{-- ── SECTION LABEL ── --}}
        <div class="section-divider" style="margin-bottom:0;">
            <span class="divider-label">Catalog</span>
            <span class="divider-line"></span>
        </div>

        {{-- ── TABLE CARD ── --}}
        <div class="table-card" style="margin-top:20px;">

            <div class="table-header">
                <div>
                    <div class="table-header-title">Product List</div>
                    <div class="table-header-sub">Manage and monitor your catalog</div>
                </div>
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search product or brand…">
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="sv-table">
                    <thead>
                        <tr>
                            <th style="width:48px; text-align:center;">#</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @forelse ($products as $index => $p)
                        <tr class="product-row" data-index="{{ $index }}"
                            data-name="{{ strtolower($p->nama_produk) }}"
                            data-brand="{{ strtolower($p->brand->nama_brand ?? '') }}">

                            <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>

                            <td>
                                <div class="prod-cell">
                                    <div class="prod-img">
                                        <img src="{{ $p->gambar ? Storage::url($p->gambar) : 'https://placehold.co/48x48/F7F6F2/A8A59A?text=SV' }}"
                                             alt="{{ $p->nama_produk }}">
                                    </div>
                                    <div>
                                        <div class="prod-name">{{ $p->nama_produk }}</div>
                                        <div class="prod-id">#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>

                            <td><span class="chip chip-cat">{{ $p->category->nama_kategori ?? 'N/A' }}</span></td>
                            <td><span class="chip chip-brand">{{ $p->brand->nama_brand ?? 'N/A' }}</span></td>
                            <td><span class="chip chip-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span></td>

                            <td>
                                @php
                                    $pillClass = match($p->status) {
                                        'ready'    => 'pill-ready',
                                        'sale'     => 'pill-sale',
                                        'sold out' => 'pill-sold',
                                        default    => 'pill-default',
                                    };
                                    $pillLabel = match($p->status) {
                                        'ready'    => 'Ready',
                                        'sale'     => 'On Sale',
                                        'sold out' => 'Sold Out',
                                        default    => ucfirst($p->status),
                                    };
                                @endphp
                                <span class="status-pill {{ $pillClass }}">
                                    <span class="status-dot"></span>
                                    {{ $pillLabel }}
                                </span>
                            </td>

                            <td style="text-align:center;">
                                <div style="display:inline-flex;gap:6px;">
                                    <a href="{{ route('admin.products.show', $p->id) }}" class="action-btn" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $p->id) }}" class="action-btn" title="Edit">
                                        <i class="fa fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}"
                                          onsubmit="return confirm('Delete this product?')" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fa fa-box-open"></i>
                                    <p>No products found. Start by adding one.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="page-info" id="pageInfo">—</div>
                <div class="pag-controls">
                    <button class="pag-btn" id="prevBtn" onclick="changePage(-1)">
                        <i class="fa fa-chevron-left" style="font-size:10px;"></i>
                    </button>
                    <div id="pageNumbers" style="display:flex;gap:4px;"></div>
                    <button class="pag-btn" id="nextBtn" onclick="changePage(1)">
                        <i class="fa fa-chevron-right" style="font-size:10px;"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
/* ── LIVE CLOCK ── */
function updateClock() {
    const now = new Date();
    document.getElementById('live-time').textContent =
        now.toLocaleTimeString('id-ID', { hour12: false });
}
updateClock();
setInterval(updateClock, 1000);

/* ── PAGINATION ── */
let currentPage = 1;
const itemsPerPage = 5;
let allRows = Array.from(document.querySelectorAll('.product-row'));
let visibleRows = allRows;

function showPage(page) {
    const total = visibleRows.length;
    const totalPages = Math.max(1, Math.ceil(total / itemsPerPage));
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;
    currentPage = page;

    const start = (page - 1) * itemsPerPage;
    const end   = start + itemsPerPage;

    allRows.forEach(r => r.classList.remove('active-page'));
    visibleRows.forEach((row, i) => {
        if (i >= start && i < end) row.classList.add('active-page');
    });

    const displayEnd = Math.min(end, total);
    const info = document.getElementById('pageInfo');
    info.innerHTML = total > 0
        ? `Showing <span>${start + 1}–${displayEnd}</span> of <span>${total}</span> products`
        : `<span>No results</span>`;

    document.getElementById('prevBtn').disabled = (page === 1);
    document.getElementById('nextBtn').disabled = (page === totalPages || total === 0);
    renderPageNums(totalPages);
}

function changePage(step) { showPage(currentPage + step); }

function renderPageNums(totalPages) {
    const c = document.getElementById('pageNumbers');
    c.innerHTML = '';
    const range = 5;
    let start = Math.max(1, currentPage - Math.floor(range / 2));
    let end   = Math.min(totalPages, start + range - 1);
    if (end - start < range - 1) start = Math.max(1, end - range + 1);
    for (let i = start; i <= end; i++) {
        const btn = document.createElement('button');
        btn.className = 'pag-btn' + (i === currentPage ? ' active' : '');
        btn.textContent = i;
        btn.onclick = () => showPage(i);
        c.appendChild(btn);
    }
}

/* ── SEARCH ── */
document.getElementById('searchInput').addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    visibleRows = allRows.filter(row =>
        row.dataset.name.includes(q) || row.dataset.brand.includes(q)
    );
    showPage(1);
});

document.addEventListener('DOMContentLoaded', () => showPage(1));
</script>

@endsection
