@extends('layouts.app')

@section('title', 'Permintaan Kendaraan')

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
    <div class="page-content active" id="peminjamanPage">
        <div class="dashboard-content">
            <div class="datatable-container">
                <div class="datatable-header">
                    <div class="datatable-title">
                        <svg fill="none" stroke="#4b5563" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Data Driver
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
                        <button class="btn-add" onclick="openModal('tambahDriverModal')">+ Tambah Driver</button>
                    </div>
                </div>

                <div class="datatable-wrapper">
                    <table id="driverTable" class="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Driver</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($driver as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_driver }}</td>
                                    <td>{{ $item->nomer_telepon }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ $item->id }}, '{{ $item->nama_driver }}', '{{ $item->nomer_telepon }}')">Edit</button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="openDeleteModal({{ $item->id }}, '{{ $item->nama_driver }}')">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
    <div class="modal-overlay" id="tambahDriverModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Tambah Driver</div>
                <button class="modal-close" onclick="closeModal('tambahDriverModal')">✕</button>
            </div>
            <div class="modal-body">
                <label class="label">Nama Driver</label>
                <input type="text" id="namaDriverBaru" class="select" placeholder="Masukkan nama driver">
                <label class="label">Nomor Telepon</label>
                <input type="text" id="nomorDriverBaru" class="select" placeholder="Masukkan nomor telepon">
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('tambahDriverModal')">Batal</button>
                <button class="btn btn-success" onclick="tambahDriver()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal-overlay" id="editDriverModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Edit Driver</div>
                <button class="modal-close" onclick="closeModal('editDriverModal')">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editDriverId">
                <label class="label">Nama Driver</label>
                <input type="text" id="editNamaDriver" class="select">
                <label class="label">Nomor Telepon</label>
                <input type="text" id="editNomorDriver" class="select">
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('editDriverModal')">Batal</button>
                <button class="btn btn-success" onclick="editDriver()">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal-overlay" id="hapusDriverModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Hapus Driver</div>
                <button class="modal-close" onclick="closeModal('hapusDriverModal')">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hapusDriverId">
                <p>Apakah Anda yakin ingin menghapus <strong id="hapusDriverNama"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal('hapusDriverModal')">Batal</button>
                <button class="btn btn-danger" onclick="hapusDriver()">Hapus</button>
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

        function openEditModal(id, nama, nomor) {
            document.getElementById('editDriverId').value = id;
            document.getElementById('editNamaDriver').value = nama;
            document.getElementById('editNomorDriver').value = nomor;
            openModal('editDriverModal');
        }

        function openDeleteModal(id, nama) {
            document.getElementById('hapusDriverId').value = id;
            document.getElementById('hapusDriverNama').textContent = nama;
            openModal('hapusDriverModal');
        }

        function tambahDriver() {
            const nama = document.getElementById('namaDriverBaru').value.trim();
            const nomor = document.getElementById('nomorDriverBaru').value.trim();

            if (!nama || !nomor) return alert('Semua field harus diisi.');

            $.ajax({
                url: "{{ route('admin.driver.store') }}",
                type: "POST",
                data: {
                    nama_driver: nama,
                    nomer_telepon: nomor,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    closeModal('tambahDriverModal');
                    showToast(res.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function() {
                    alert('Gagal menambah driver.');
                }
            });
        }

        function editDriver() {
            const id = $('#editDriverId').val();
            const nama = $('#editNamaDriver').val().trim();
            const nomor = $('#editNomorDriver').val().trim();

            if (!nama || !nomor) return alert('Semua field harus diisi.');

            $.ajax({
                url: `/admin/driver/${id}`,
                type: "PUT",
                data: {
                    nama_driver: nama,
                    nomer_telepon: nomor,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    closeModal('editDriverModal');
                    showToast(res.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function() {
                    alert('Gagal memperbarui driver.');
                }
            });
        }

        function hapusDriver() {
            const id = $('#hapusDriverId').val();

            $.ajax({
                url: `/admin/driver/${id}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    closeModal('hapusDriverModal');
                    showToast(res.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                },
                error: function() {
                    alert('Gagal menghapus driver.');
                }
            });
        }

        function showToast(message, type = "success") {
            const toast = document.getElementById("toast");
            toast.className = `toast ${type} show`;
            toast.textContent = message;
            setTimeout(() => toast.classList.remove("show"), 4000);
        }

        $(document).ready(function() {
            const table = $('#driverTable');
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
