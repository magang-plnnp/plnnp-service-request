@extends('layouts.app')

@section('title', 'Permintaan Kendaraan')

@section('content')
  <div class="page-content active" id="peminjamanPage">
        <div class="dashboard-content">
          <div class="table-section">
            <div class="table-header">
              <div class="table-title">Data Peminjaman Kendaraan</div>
              <div class="table-actions">
                <div class="search-box">
                  <svg
                    class="search-icon"
                    width="16"
                    height="16"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                  </svg>
                  <input
                    type="text"
                    class="search-input"
                    placeholder="Cari peminjaman..."
                  />
                </div>
                <button class="btn btn-secondary">
                  <svg
                    width="16"
                    height="16"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                    />
                  </svg>
                  Filter
                </button>
                <button
                  class="btn btn-primary"
                  onclick="openModal('peminjamanModal')"
                >
                  <svg
                    width="16"
                    height="16"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  Tambah Data
                </button>
              </div>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Pemohon</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="peminjamanTableBody">
                  <tr>
                    <td>PMJ-001</td>
                    <td>Ahmasd Rizki fix</td>
                    <td>SUV</td>
                    <td>28 Jul 2025</td>
                    <td>30 Jul 2025</td>
                    <td>Jakarta - Bandusng</td>
                    <td>
                      <span class="status-badge status-pending">Pending</span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPeminjaman('PMJ-001')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPeminjaman('PMJ-001')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePeminjaman('PMJ-001')"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>PMJ-002</td>
                    <td>Siti Nurhaliza</td>
                    <td>Sedan</td>
                    <td>26 Jul 2025</td>
                    <td>26 Jul 2025</td>
                    <td>Kantor Pusat</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPeminjaman('PMJ-002')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPeminjaman('PMJ-002')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePeminjaman('PMJ-002')"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>PMJ-003</td>
                    <td>Budi Santoso</td>
                    <td>Minibus</td>
                    <td>25 Jul 2025</td>
                    <td>27 Jul 2025</td>
                    <td>Surabaya - Malang</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPeminjaman('PMJ-003')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPeminjaman('PMJ-003')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePeminjaman('PMJ-003')"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
