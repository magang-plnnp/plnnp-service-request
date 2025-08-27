@extends('layouts.app')

@section('title', 'Permintaan Kendaraan')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('datatables/style.css') }}" />
@endpush

@section('content')
    <div class="page-content active" id="peminjamanPage">
        <div class="dashboard-content">
            <div class="datatable-container">
                {{-- HEADER --}}
                <div class="datatable-header">
                    <div class="datatable-title">
                        <svg fill="none" stroke="#4b5563" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />


                        </svg>
                        Data Peminjaman Kendaraan
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
                        {{-- <button class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button> --}}
                        {{-- <button class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export
                    </button> --}}
                        {{-- <button class="btn btn-primary">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Data
                        </button> --}}
                    </div>
                </div>
                <div class="filters-row">
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Sub Bidang</label>
                        <select class="filter-select" id="typeFilter">
                            <option value="">Semua Sub Bidang</option>
                            @foreach ($subBidang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Periode</label>
                        <select class="filter-select" id="periodFilter">
                            <option value="">Semua Periode</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="datatable-wrapper">
                    <table id="peminjamanTable" class="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pemohon</th>
                                <th>NID</th>
                                <th>Sub Bidang</th>
                                <th>No HP</th>
                                <th>Penjemputan</th>
                                <th>Tanggal</th>
                                <th>Tujuan</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permintaanKendaraan as $item)
                                <tr data-id="{{ $item->id }}" data-subbidang="{{ $item->sub_bidang_id }}"
                                    data-status="{{ $item->status }}" data-tanggal="{{ $item->tanggal }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nid }}</td>
                                    <td>{{ $item->subBidang->nama ?? '-' }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->lokasi_penjemputan }}</td>
                                    <td>{{ $item->tanggal_waktu }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->file ?? '-' }} </td>
                                    <td>
                                        <span
                                            class="status-badge 
    {{ $item->status === 'approved'
        ? 'status-approved'
        : ($item->status === 'rejected'
            ? 'status-rejected'
            : 'status-pending') }}">
                                            {{ $item->status }}
                                        </span>

                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-delete"
                                                onclick="openModal('peminjamanAccModal', {{ $item->id }})"
                                                {{ $item->status !== 'pending' ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}>
                                                Acc
                                            </button>

                                            <button class="btn btn-sm btn-delete"
                                                onclick="openModal('peminjamanTolakModal', {{ $item->id }})"
                                                {{ $item->status !== 'pending' ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}>
                                                Tolak
                                            </button>

                                            <button class="btn btn-sm btn-delete"
                                                onclick="openModal('peminjamanHapusModal', {{ $item->id }})">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="datatable-footer">
                        <div class="pagination-info">
                            Menampilkan <strong id="currentRange">1-10</strong> dari <strong id="totalCount">0</strong> data
                        </div>
                        <div class="pagination">
                            <button class="pagination-btn" id="prevPage">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <span id="customPaginationButtons"></span>
                            <button class="pagination-btn" id="nextPage">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
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
    </div>

    <!-- Modal Hapus Peminjaman -->
    <div class="modal-overlay" id="peminjamanHapusModal">
        <div class="modal">
            <input type="hidden" id="hapusId">
            <div class="modal-header">
                <div class="modal-title">Konfirmasi Hapus</div>
                <button class="modal-close" onclick="closeModal('peminjamanHapusModal')">✕</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus peminjaman ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('peminjamanHapusModal')">Batal</button>
                <button class="btn btn-danger" onclick="hapusPeminjaman()">Hapus</button>
            </div>
        </div>
    </div>


    <!-- Modal Acc Peminjaman -->
    <div class="modal-overlay" id="peminjamanAccModal">
        <div class="modal">
            <input type="hidden" id="accId">
            <div class="modal-header">
                <div class="modal-title">Konfirmasi Acc</div>
                <button class="modal-close" onclick="closeModal('peminjamanAccModal')">✕</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui peminjaman ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('peminjamanAccModal')">Batal</button>
                <button class="btn btn-success" onclick="accPeminjaman()">Setujui</button>
            </div>
        </div>
    </div>

    <!-- Modal Tolak Peminjaman -->
    <div class="modal-overlay" id="peminjamanTolakModal">
        <div class="modal">
            <input type="hidden" id="tolakId">
            <div class="modal-header">
                <div class="modal-title">Konfirmasi Tolak</div>
                <button class="modal-close" onclick="closeModal('peminjamanTolakModal')">✕</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menolak peminjaman ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('peminjamanTolakModal')">Batal</button>
                <button class="btn btn-warning" onclick="tolakPeminjaman()">Tolak</button>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Inisialisasi DataTable -->
    <script>
        function accPeminjaman() {
            let id = document.getElementById('accId').value;

            fetch(`/admin/kendaraan/${id}/acc`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    // update tampilan status di row
                    let row = document.querySelector(`tr[data-id="${id}"] .status-badge`);
                    if (row) {
                        row.textContent = "approved";
                        row.classList.remove("status-rejected");
                        row.classList.add("status-approved");
                    }

                    // alert("Peminjaman berhasil di-Acc!");
                    closeModal('peminjamanAccModal');
                });
        }

        function tolakPeminjaman() {
            let id = document.getElementById('tolakId').value;

            fetch(`/admin/kendaraan/${id}/tolak`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    // update tampilan status di row
                    let row = document.querySelector(`tr[data-id="${id}"] .status-badge`);
                    if (row) {
                        row.textContent = "rejected";
                        row.classList.remove("status-approved");
                        row.classList.add("status-rejected");
                    }

                    // alert("Peminjaman berhasil ditolak!");
                    closeModal('peminjamanTolakModal');
                });
        }

        function hapusPeminjaman() {
            let id = document.getElementById('hapusId').value;

            fetch(`/admin/kendaraan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(res => res.json())
                .then(data => {
                    // hapus row dari tabel
                    let row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                    }

                    // alert("Peminjaman berhasil dihapus!");
                    closeModal('peminjamanHapusModal');
                });
        }




        function openModal(modalId, id = null) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'flex'; // atau 'block', sesuai CSS kamu

            // kalau modal Acc → isi hidden input accId
            if (modalId === 'peminjamanAccModal' && id !== null) {
                document.getElementById('accId').value = id;
            }

            // kalau modal Tolak → isi hidden input tolakId
            if (modalId === 'peminjamanTolakModal' && id !== null) {
                document.getElementById('tolakId').value = id;
            }

            // kalau modal Hapus juga mau simpan id, tambahkan hidden input di modal hapus
            if (modalId === 'peminjamanHapusModal' && id !== null) {
                document.getElementById('hapusId').value = id;
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'none';
        }

        // Opsional: menutup modal ketika klik di luar modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('peminjamanModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('peminjamanHapusModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        $(document).ready(function() {
            $('#peminjamanTable').DataTable({
                paging: false, // Nonaktifkan pagination
                info: false, // Nonaktifkan "Showing 1 to 10 of 50 entries"
                searching: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "→",
                        previous: "←"
                    },
                    zeroRecords: "Tidak ditemukan data yang cocok",
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const table = $('#peminjamanTable');
            const allRows = table.find('tbody tr');
            let filteredRows = allRows;
            let currentPage = 1;
            let rowsPerPage = parseInt($('#itemsPerPage').val());

            function applyFilters() {
                const status = $('#statusFilter').val();
                const subBidang = $('#typeFilter').val();
                const period = $('#periodFilter').val();

                filteredRows = allRows.filter(function() {
                    const row = $(this);
                    const rowStatus = row.find('td:nth-child(10)').text().trim().toLowerCase();
                    const rowSubBidang = row.find('td:nth-child(4)').text().trim();
                    const rowDate = new Date(row.find('td:nth-child(7)').text());

                    let match = true;

                    if (status && rowStatus !== status.toLowerCase()) {
                        match = false;
                    }

                    if (subBidang && rowSubBidang !== $('#typeFilter option:selected').text().trim()) {
                        match = false;
                    }

                    if (period) {
                        const now = new Date();
                        const rowTime = new Date(rowDate.getFullYear(), rowDate.getMonth(), rowDate
                            .getDate());
                        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

                        if (period === 'today') {
                            if (rowTime.getTime() !== today.getTime()) match = false;
                        } else if (period === 'week') {
                            const startOfWeek = new Date(today);
                            startOfWeek.setDate(today.getDate() - today.getDay());
                            const endOfWeek = new Date(startOfWeek);
                            endOfWeek.setDate(startOfWeek.getDate() + 6);
                            if (rowTime < startOfWeek || rowTime > endOfWeek) match = false;
                        } else if (period === 'month') {
                            if (
                                rowDate.getMonth() !== now.getMonth() ||
                                rowDate.getFullYear() !== now.getFullYear()
                            ) match = false;
                        } else if (period === 'year') {
                            if (rowDate.getFullYear() !== now.getFullYear()) match = false;
                        }
                    }

                    return match;
                });
            }

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

                $('#prevPage').prop('disabled', currentPage === 1).toggleClass('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages).toggleClass('disabled', currentPage ===
                    totalPages);
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
                applyFilters();
                filteredRows = filteredRows.filter(function() {
                    return $(this).text().toLowerCase().indexOf(keyword) > -1;
                });
                currentPage = 1;
                renderTablePage();
            });

            $('#statusFilter, #typeFilter, #periodFilter').on('change', function() {
                applyFilters();
                const keyword = $('#searchInput').val().toLowerCase();
                if (keyword) {
                    filteredRows = filteredRows.filter(function() {
                        return $(this).text().toLowerCase().indexOf(keyword) > -1;
                    });
                }
                currentPage = 1;
                renderTablePage();
            });

            // Initial render
            applyFilters();
            renderTablePage();
        });
    </script>



    <script>
        $(document).ready(function() {
            const table = $('#peminjamanTable');
            const allRows = table.find('tbody tr');
            let filteredRows = allRows; // Untuk menyimpan hasil pencarian
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

                if (currentPage === 1) {
                    $('#prevPage').attr('disabled', true).addClass('disabled');
                } else {
                    $('#prevPage').removeAttr('disabled').removeClass('disabled');
                }

                if (currentPage === totalPages) {
                    $('#nextPage').attr('disabled', true).addClass('disabled');
                } else {
                    $('#nextPage').removeAttr('disabled').removeClass('disabled');
                }
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

            renderTablePage(); // Initial render
        });
    </script>
@endpush
