@extends('layouts.app')

@section('title', 'Data Sub Bidang')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('datatables/style.css') }}" />
    <style>
        .select {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 6px;
            font-size: 14px;
        }

        .label {
            display: block;
            margin-top: 12px;
            font-weight: 500;
        }

        .btn-add {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background-color: #1d4ed8;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-cancel {
            background-color: #e5e7eb;
        }

        .btn-success {
            background-color: #2563eb;
            color: white;
        }

        .btn-success:hover {
            background-color: #1d4ed8;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }
    </style>
@endpush

@section('content')
    <div class="page-content active" id="subBidangPage">
        <div class="dashboard-content">
            <div class="datatable-container">
                {{-- HEADER --}}
                <div class="datatable-header">
                    <div class="datatable-title">
                        <svg fill="none" stroke="#4b5563" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Data Sub Bidang
                    </div>
                    <div class="datatable-actions">
                        <div class="search-box">
                            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" class="search-input" placeholder="Cari data..." id="searchInput"
                                autocomplete="off">
                        </div>
                        <button class="btn-add" onclick="openModal('tambahSubBidangModal')">+ Tambah Sub Bidang</button>
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="datatable-wrapper">
                    <table id="subBidangTable" class="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sub Bidang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subbidang as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}')">Edit</button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="openDeleteModal({{ $item->id }})">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="datatable-footer">
                    <div class="pagination-info">
                        Menampilkan <strong id="currentRange">1-10</strong> dari <strong id="totalCount">0</strong> data
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn" id="prevPage">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <span id="customPaginationButtons"></span>
                        <button class="pagination-btn" id="nextPage">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <select class="pagination-select" id="itemsPerPage">
                            <option value="10">10 / halaman</option>
                            <option value="25">25 / halaman</option>
                            <option value="50">50 / halaman</option>
                            <option value="100">100 / halaman</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal-overlay" id="tambahSubBidangModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Tambah Sub Bidang</div>
                <button class="modal-close" onclick="closeModal('tambahSubBidangModal')">✕</button>
            </div>
            <div class="modal-body">
                <label class="label">Nama Sub Bidang</label>
                <input type="text" id="namaSubBidangBaru" class="select" placeholder="Masukkan nama sub bidang">
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('tambahSubBidangModal')">Batal</button>
                <button class="btn btn-success" onclick="tambahSubBidang()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal-overlay" id="editSubBidangModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Edit Sub Bidang</div>
                <button class="modal-close" onclick="closeModal('editSubBidangModal')">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editId">
                <label class="label">Nama Sub Bidang</label>
                <input type="text" id="editNamaSubBidang" class="select">
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('editSubBidangModal')">Batal</button>
                <button class="btn btn-success" onclick="simpanEdit()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal-overlay" id="hapusSubBidangModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Konfirmasi Hapus</div>
                <button class="modal-close" onclick="closeModal('hapusSubBidangModal')">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hapusId">
                <p>Apakah Anda yakin ingin menghapus sub bidang ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('hapusSubBidangModal')">Batal</button>
                <button class="btn btn-danger" onclick="hapusSubBidang()">Hapus</button>
            </div>
        </div>
    </div>

    <div id="toast" class="toast"></div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function showToast(msg, type = "success") {
            const toast = document.getElementById("toast");
            toast.className = `toast ${type} show`;
            toast.textContent = msg;
            setTimeout(() => toast.classList.remove("show"), 3000);
        }

        // === TAMBAH SUB BIDANG ===
        function tambahSubBidang() {
            const nama = document.getElementById('namaSubBidangBaru').value.trim();
            if (!nama) return alert('Nama sub bidang harus diisi.');

            $.ajax({
                url: "{{ route('admin.subbidang.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    nama: nama
                },
                success: function() {
                    closeModal('tambahSubBidangModal');
                    showToast('Sub bidang berhasil ditambahkan!', 'success');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showToast('Gagal menambahkan sub bidang.', 'error');
                }
            });
        }

        // === BUKA MODAL EDIT ===
        function openEditModal(id, nama) {
            document.getElementById('editId').value = id;
            document.getElementById('editNamaSubBidang').value = nama;
            openModal('editSubBidangModal');
        }

        // === SIMPAN EDIT ===
        function simpanEdit() {
            const id = document.getElementById('editId').value;
            const nama = document.getElementById('editNamaSubBidang').value.trim();
            if (!nama) return alert('Nama sub bidang harus diisi.');

            $.ajax({
                url: `/admin/subbidang/${id}`,
                type: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    nama: nama
                },
                success: function() {
                    closeModal('editSubBidangModal');
                    showToast('Data sub bidang berhasil diperbarui!', 'success');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showToast('Gagal memperbarui data.', 'error');
                }
            });
        }

        // === MODAL HAPUS ===
        function openDeleteModal(id) {
            document.getElementById('hapusId').value = id;
            openModal('hapusSubBidangModal');
        }

        // === HAPUS SUB BIDANG ===
        function hapusSubBidang() {
            const id = document.getElementById('hapusId').value;
            $.ajax({
                url: `/admin/subbidang/${id}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    closeModal('hapusSubBidangModal');
                    showToast('Data sub bidang berhasil dihapus!', 'info');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showToast('Gagal menghapus data.', 'error');
                }
            });
        }

        // === PAGINATION, SEARCH, DLL ===
        $(document).ready(function() {
            const table = $('#subBidangTable');
            const allRows = table.find('tbody tr');
            let filteredRows = allRows;
            let currentPage = 1;
            let rowsPerPage = parseInt($('#itemsPerPage').val());

            function renderTablePage() {
                const totalRows = filteredRows.length;
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                allRows.hide();
                filteredRows.hide();
                filteredRows.slice(start, end).show();
                $('#currentRange').text(`${Math.min(start + 1, totalRows)}-${Math.min(end, totalRows)}`);
                $('#totalCount').text(totalRows);
                renderPaginationButtons(totalRows);
            }

            function renderPaginationButtons(totalRows) {
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                const container = $('#customPaginationButtons');
                container.empty();
                for (let i = 1; i <= totalPages; i++) {
                    const btn = $(`<button class="pagination-btn">${i}</button>`);
                    if (i === currentPage) btn.addClass('active');
                    btn.click(() => {
                        currentPage = i;
                        renderTablePage();
                    });
                    container.append(btn);
                }
                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages);
            }

            $('#prevPage').click(() => {
                if (currentPage > 1) {
                    currentPage--;
                    renderTablePage();
                }
            });

            $('#nextPage').click(() => {
                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTablePage();
                }
            });

            $('#itemsPerPage').change(function() {
                rowsPerPage = parseInt($(this).val());
                currentPage = 1;
                renderTablePage();
            });

            $('#searchInput').on('keyup', function() {
                const keyword = $(this).val().toLowerCase();
                filteredRows = allRows.filter(function() {
                    return $(this).text().toLowerCase().indexOf(keyword) > -1;
                });
                currentPage = 1;
                renderTablePage();
            });

            renderTablePage();
        });
    </script>
@endpush
