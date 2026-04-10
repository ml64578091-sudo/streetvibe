@extends('layouts.backend')

@section('content')
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1e40af;
        --primary-light: #3b82f6;
        --success: #10b981;
        --info: #06b6d4;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1f2937;
        --light: #f9fafb;
        --border: #e5e7eb;
        --text-muted: #6b7280;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f0f4f8 0%, #f9fafb 100%);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', sans-serif;
    }

    .container-fluid {
        padding: 2rem 2.5rem;
    }

    /* ═══════════════════════════════ HEADER ═══════════════════════════════ */
    .header-section {
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .header-title h5 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        letter-spacing: -0.5px;
        margin: 0 0 0.25rem 0;
    }

    .header-title small {
        color: var(--text-muted);
        font-size: 0.95rem;
        display: block;
    }

    .btn-add {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white !important;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
    }

    .btn-add i {
        font-size: 1.1rem;
    }

    /* ═══════════════════════════════ STATS CARDS ═══════════════════════════════ */
    .stats-section {
        margin-bottom: 2.5rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
    }

    .stat-card:nth-child(2)::before {
        background: linear-gradient(90deg, var(--success), #34d399);
    }

    .stat-card:nth-child(3)::before {
        background: linear-gradient(90deg, var(--info), #22d3ee);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        border-color: var(--primary);
    }

    .stat-card-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 0.625rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
        background: var(--light);
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }

    .stat-card:nth-child(2):hover .stat-icon {
        background: var(--success);
    }

    .stat-card:nth-child(3):hover .stat-icon {
        background: var(--info);
    }

    .stat-text-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .stat-text-value {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--dark);
    }

    /* ═══════════════════════════════ TABLE CARD ═══════════════════════════════ */
    .table-card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .table-card-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search-wrapper {
        position: relative;
        max-width: 350px;
        width: 100%;
    }

    .search-wrapper .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1.1rem;
    }

    .search-wrapper input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: var(--light);
    }

    .search-wrapper input:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* ═════════════════════════════ TABLE STYLES ════════════════════════════ */
    .table-responsive {
        overflow: hidden;
    }

    .table {
        margin: 0;
    }

    .table thead {
        background: var(--light);
    }

    .table th {
        padding: 1rem 1.5rem;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        border: none;
        background: var(--light);
    }

    .table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: var(--light);
        box-shadow: inset 0 0 20px rgba(37, 99, 235, 0.05);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-no {
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .table-image {
        width: 64px;
        height: 64px;
        border-radius: 0.5rem;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .table tbody tr:hover .table-image {
        transform: scale(1.05);
    }

    .table-title {
        font-weight: 700;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .table-id {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .table-desc {
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.5;
        max-width: 300px;
    }

    .table-actions {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
    }

    .btn-action {
        padding: 0.55rem 1rem;
        border-radius: 0.5rem;
        border: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        text-decoration: none;
    }

    .btn-edit {
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
        background: var(--warning);
        color: white;
        border-color: var(--warning);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-action i {
        font-size: 0.95rem;
    }

    /* ═════════════════════════════ EMPTY STATE ════════════════════════════ */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-text {
        color: var(--text-muted);
        font-size: 1rem;
    }

    /* ═════════════════════════════ ALERT ════════════════════════════════ */
    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(52, 211, 153, 0.05) 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #047857;
        border-radius: 0.5rem;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1rem;
        margin-bottom: 0;
    }

    .alert-success i {
        font-size: 1.3rem;
    }

    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        font-size: 1.2rem;
        transition: opacity 0.3s;
    }

    .alert-close:hover {
        opacity: 0.7;
    }

    /* ═════════════════════════════ MODAL ════════════════════════════════ */
    .modal-content {
        border: 1px solid var(--border);
        border-radius: 0.75rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 0.625rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .modal-text {
        color: var(--text-muted);
        text-align: center;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .modal-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .btn-cancel {
        flex: 1;
        padding: 0.75rem;
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 0.5rem;
        color: var(--dark);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: var(--border);
        border-color: var(--text-muted);
    }

    .btn-confirm {
        flex: 1;
        padding: 0.75rem;
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        border: none;
        border-radius: 0.5rem;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    /* ═════════════════════════════ FOOTER ════════════════════════════════ */
    .table-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        background: var(--light);
    }

    .table-footer-text {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* ═════════════════════════════ RESPONSIVE ════════════════════════════════ */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem 1rem;
        }

        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .stats-section {
            grid-template-columns: 1fr;
        }

        .table-actions {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
        }

        .header-title h5 {
            font-size: 1.5rem;
        }

        .search-wrapper {
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .header-title h5 {
            font-size: 1.25rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .table-image {
            width: 48px;
            height: 48px;
        }

        .table-desc {
            max-width: 150px;
        }

        .stat-text-value {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container-fluid">

    {{-- Header --}}
    <div class="header-section">
        <div class="header-content">
            <div class="header-title">
                <h5>📚 Outfit Reference Catalog</h5>
                <small>Kelola semua referensi outfit Anda dengan mudah</small>
            </div>
            <a href="{{ route('admin.outfit.create') }}" class="btn-add">
                <i class="ti ti-plus"></i>
                <span>Tambah Referensi</span>
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon" style="background: rgba(37, 99, 235, 0.15); color: var(--primary);">
                    <i class="ti ti-hanger"></i>
                </div>
                <div>
                    <div class="stat-text-label">Total Referensi</div>
                    <div class="stat-text-value">{{ $outfits->count() }}</div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: var(--success);">
                    <i class="ti ti-circle-check"></i>
                </div>
                <div>
                    <div class="stat-text-label">Outfit Aktif</div>
                    <div class="stat-text-value">{{ $outfits->count() }}</div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-icon" style="background: rgba(6, 182, 212, 0.15); color: var(--info);">
                    <i class="ti ti-calendar"></i>
                </div>
                <div>
                    <div class="stat-text-label">Bulan Ini</div>
                    <div class="stat-text-value">
                        {{ $outfits->filter(fn($o) => $o->created_at->isCurrentMonth())->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">

        {{-- Alert Notifikasi --}}
        @if(session('success'))
            <div class="alert-success">
                <i class="ti ti-circle-check"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        {{-- Table Header dengan Search --}}
        <div class="table-card-header">
            <div class="search-wrapper">
                <i class="ti ti-search search-icon"></i>
                <input type="text" id="searchOutfit" placeholder="Cari outfit berdasarkan judul..." />
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table" id="outfitTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th style="width: 100px;">GAMBAR</th>
                        <th>JUDUL LOOK</th>
                        <th>DESKRIPSI</th>
                        <th style="width: 200px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($outfits as $outfit)
                    <tr class="outfit-row" data-name="{{ strtolower($outfit->judul) }}">
                        <td class="table-no">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ Storage::url($outfit->gambar) }}"
                                 alt="{{ $outfit->judul }}"
                                 class="table-image">
                        </td>
                        <td>
                            <div class="table-title">{{ $outfit->judul }}</div>
                            <div class="table-id">ID: #{{ $outfit->id }}</div>
                        </td>
                        <td>
                            <p class="table-desc">
                                {{ Str::limit($outfit->deskripsi, 100) }}
                            </p>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.outfit.edit', $outfit->id) }}"
                                   class="btn-action btn-edit">
                                    <i class="ti ti-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <button type="button"
                                        class="btn-action btn-delete"
                                        onclick="openDeleteModal({{ $outfit->id }}, '{{ addslashes($outfit->judul) }}')">
                                    <i class="ti ti-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="ti ti-inbox"></i>
                                </div>
                                <p class="empty-text">Belum ada referensi outfit. Mulai buat dengan mengklik tombol "Tambah Referensi"</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table Footer --}}
        <div class="table-footer">
            <span class="table-footer-text">
                Menampilkan <strong>{{ $outfits->count() }}</strong> referensi outfit
            </span>
            @if(method_exists($outfits, 'links'))
                {{ $outfits->links('pagination::bootstrap-5') }}
            @endif
        </div>

    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-icon">
                    <i class="ti ti-trash"></i>
                </div>
                <h6 class="modal-title">Hapus Referensi Outfit?</h6>
                <p class="modal-text">
                    Outfit <strong id="deleteName"></strong> akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="modal-buttons">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-confirm w-100">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('searchOutfit').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.outfit-row').forEach(row => {
            const matches = row.dataset.name.includes(query);
            row.style.display = matches ? '' : 'none';
        });
    });

    // Delete modal handler
    function openDeleteModal(id, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('deleteForm').action = '{{ route("admin.outfit.destroy", ":id") }}'.replace(':id', id);
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    // Auto-hide alerts
    document.querySelectorAll('.alert-success').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 4000);
    });
</script>

@endsection
