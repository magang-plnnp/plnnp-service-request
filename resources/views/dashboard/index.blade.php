@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
 <div class="page-content active" id="dashboardPage">
        <div class="dashboard-content">
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-header">
                <div class="stat-title">Total Peminjaman</div>
                <div class="stat-icon">
                  <svg
                    width="20"
                    height="20"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                </div>
              </div>
              <div class="stat-value">156</div>
              <div class="stat-change positive">
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
                    d="M7 17l10-10M17 7v10"
                  />
                </svg>
                +12% dari bulan lalu
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <div class="stat-title">Total Pengadaan</div>
                <div class="stat-icon">
                  <svg
                    width="20"
                    height="20"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                  </svg>
                </div>
              </div>
              <div class="stat-value">89</div>
              <div class="stat-change positive">
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
                    d="M7 17l10-10M17 7v10"
                  />
                </svg>
                +8% dari bulan lalu
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <div class="stat-title">Pending Approval</div>
                <div class="stat-icon">
                  <svg
                    width="20"
                    height="20"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                </div>
              </div>
              <div class="stat-value">24</div>
              <div class="stat-change negative">
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
                    d="M17 17l-10-10M7 7v10"
                  />
                </svg>
                -5% dari bulan lalu
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-header">
                <div class="stat-title">Total Pengguna</div>
                <div class="stat-icon">
                  <svg
                    width="20"
                    height="20"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                    />
                  </svg>
                </div>
              </div>
              <div class="stat-value">342</div>
              <div class="stat-change positive">
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
                    d="M7 17l10-10M17 7v10"
                  />
                </svg>
                +18% dari bulan lalu
              </div>
            </div>
          </div>

          <div class="table-section">
            <div class="table-header">
              <div class="table-title">Aktivitas Terbaru</div>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>26 Jul 2025</td>
                    <td>Peminjaman Kendaraan</td>
                    <td>Ahmssad Rizki</td>
                    <td>
                      <span class="status-badge status-pending">Pending</span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button class="btn btn-sm btn-view">Detail</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>26 Jul 2025</td>
                    <td>Pengadaan Makanan</td>
                    <td>Siti Nurhaliza</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button class="btn btn-sm btn-view">Detail</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>25 Jul 2025</td>
                    <td>Peminjaman Kendaraan</td>
                    <td>Budi Santoso</td>
                    <td>
                      <span class="status-badge status-approved"
                        >Disetujui</span
                      >
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button class="btn btn-sm btn-view">Detail</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>25 Jul 2025</td>
                    <td>Pengadaan Makanan</td>
                    <td>Maya Sari</td>
                    <td>
                      <span class="status-badge status-rejected">Ditolak</span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button class="btn btn-sm btn-view">Detail</button>
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
