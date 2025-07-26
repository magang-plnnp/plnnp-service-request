

      @extends('layouts.app')

@section('title', 'Permintaan Makanan')

@section('content')
  <div class="page-content active" id="pengadaanPage">
        <div class="dashboard-content">
          <div class="table-section">
            <div class="table-header">
              <div class="table-title">Data Permintaan Makanan</div>
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
                    placeholder="Cari pengadaan..."
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
                  onclick="openModal('pengadaanModal')"
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
                    <th>Jenis Layanan</th>
                    <th>Tanggal Acara</th>
                    <th>Jumlah Peserta</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="pengadaanTableBody">
                  <tr>
                    <td>PGD-001</td>
                    <td>Maya Sari</td>
                    <td>Prasmanan</td>
                    <td>30 Jul 2025</td>
                    <td>50 orang</td>
                    <td>Ruang Meeting A</td>
                    <td>
                      <span class="status-badge status-pending">Pending</span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPengadaan('PGD-001')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPengadaan('PGD-001')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePengadaan('PGD-001')"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>PGD-002</td>
                    <td>Andi Pratama</td>
                    <td>Nasi Kotak</td>
                    <td>28 Jul 2025</td>
                    <td>25 orang</td>
                    <td>Auditorium</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPengadaan('PGD-002')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPengadaan('PGD-002')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePengadaan('PGD-002')"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>PGD-003</td>
                    <td>Lisa Wati</td>
                    <td>Coffee Break</td>
                    <td>26 Jul 2025</td>
                    <td>15 orang</td>
                    <td>Ruang Rapat B</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button
                          class="btn btn-sm btn-view"
                          onclick="viewPengadaan('PGD-003')"
                        >
                          Detail
                        </button>
                        <button
                          class="btn btn-sm btn-edit"
                          onclick="editPengadaan('PGD-003')"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-sm btn-delete"
                          onclick="deletePengadaan('PGD-003')"
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
