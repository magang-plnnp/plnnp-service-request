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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Data Peminjaman Kendaraan
                </div>
                <div class="datatable-actions">
                    <div class="search-box">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" class="search-input" placeholder="Cari data..." id="searchInput">
                    </div>
                     {{-- <button class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export
                    </button>  --}}
                     {{-- <button class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
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
              <th>Agenda</th>
              <th>Tanggal</th>
              <th>Durasi</th>
              <th>Jumlah</th>
              <th>Lokasi</th>
              <th>File</th>
              <th>Status</th>
            
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($permintaanMakanan as $item)
            <tr 
  data-subbidang="{{ $item->sub_bidang_id }}" 
  data-status="{{ $item->status }}" 
  data-tanggal="{{ $item->tanggal }}">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->nid }}</td>
              <td>{{ $item->subBidang->nama ?? '-' }}</td>
              <td>{{ $item->no_hp }}</td>
              <td>{{ $item->judul_agenda }}</td>
              <td>{{ $item->tanggal }}</td>
              <td>{{ $item->durasi }}</td>
              <td>{{ $item->jumlah }}</td>
              <td>{{ $item->lokasi }}</td>
              <td>{{ $item->file ?? '-' }}</td>
              <td>
                <span class="status-badge status-approved">{{ $item->status }}</span>
              </td>
              <td>
                <div class="action-buttons">
                  <button class="btn btn-sm btn-view">Detail</button>
                  {{-- <button class="btn btn-sm btn-edit">Edit</button> --}}
                  <button class="btn btn-sm btn-delete">Hapus</button>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <span id="customPaginationButtons"></span>
        <button class="pagination-btn" id="nextPage">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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
@endsection

@push('scripts')
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- Inisialisasi DataTable -->
  <script>
    $(document).ready(function() {
      $('#peminjamanTable').DataTable({
        paging: false, // Nonaktifkan pagination
  info: false,   // Nonaktifkan "Showing 1 to 10 of 50 entries"
  searching: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data",
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

  {{-- PAGINATION --}}
  <script>
 $(document).ready(function () {
  const table = $('#peminjamanTable');
  const allRows = table.find('tbody tr');
  let filteredRows = allRows;
  let currentPage = 1;
  let rowsPerPage = parseInt($('#itemsPerPage').val());

  function renderTablePage() {
    const totalRows = filteredRows.length;
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    allRows.hide(); // Sembunyikan semua
    filteredRows.hide(); // Sembunyikan hasil filter sebelumnya
    filteredRows.slice(start, end).show(); // Tampilkan hanya data yang sesuai page & filter

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

  function applyAllFilters() {
    const keyword = $('#searchInput').val().toLowerCase();
    const selectedSubBidang = $('#typeFilter').val();
    const selectedStatus = $('#statusFilter').val();
    const selectedPeriod = $('#periodFilter').val();
    const today = new Date();

    filteredRows = allRows.filter(function () {
      const text = $(this).text().toLowerCase();
      const subbid = $(this).data('subbidang');
      const status = $(this).data('status');
      const tanggal = new Date($(this).data('tanggal'));

      let periodMatch = true;
      if (selectedPeriod === 'today') {
        periodMatch = tanggal.toDateString() === today.toDateString();
      } else if (selectedPeriod === 'week') {
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - today.getDay());
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);
        periodMatch = tanggal >= startOfWeek && tanggal <= endOfWeek;
      } else if (selectedPeriod === 'month') {
        periodMatch = tanggal.getMonth() === today.getMonth() && tanggal.getFullYear() === today.getFullYear();
      } else if (selectedPeriod === 'year') {
        periodMatch = tanggal.getFullYear() === today.getFullYear();
      }

      return (
        text.includes(keyword) &&
        (selectedSubBidang === '' || subbid == selectedSubBidang) &&
        (selectedStatus === '' || status == selectedStatus) &&
        periodMatch
      );
    });

    currentPage = 1;
    renderTablePage();
  }

  $('#searchInput').on('keyup', applyAllFilters);
  $('#typeFilter, #statusFilter, #periodFilter').on('change', applyAllFilters);

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

  $('#itemsPerPage').change(function () {
    rowsPerPage = parseInt($(this).val());
    currentPage = 1;
    renderTablePage();
  });

  // Initial render
  renderTablePage();
});

</script>


{{-- UNTUK SEARCH --}}
<script>
  $(document).ready(function () {
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

    $('#itemsPerPage').change(function () {
      rowsPerPage = parseInt($(this).val());
      currentPage = 1;
      renderTablePage();
    });

    $('#searchInput').on('keyup', function () {
      const keyword = $(this).val().toLowerCase();
      filteredRows = allRows.filter(function () {
        return $(this).text().toLowerCase().indexOf(keyword) > -1;
      });
      currentPage = 1;
      renderTablePage();
    });

    renderTablePage(); // Initial render
  });
</script>


  
@endpush
