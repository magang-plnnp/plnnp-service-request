@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="page-content active" id="dashboardPage">
        <div class="dashboard-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Permintaan Kendaraan</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $totalKendaraan }}</div>
                    {!! renderStatChange($totalKendaraanPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Kendaraan Pending</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $kendaraanPending }}</div>
                    {!! renderStatChange($kendaraanPendingPercentage) !!}
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Kendaraaan Approved</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $kendaraanApproved }}</div>
                    {!! renderStatChange($kendaraanApprovedPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Kendaraaan Rejected</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $kendaraanRejected }}</div>
                    {!! renderStatChange($kendaraanRejectedPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Permintaan Makanan</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $totalMakanan }}</div>
                    {!! renderStatChange($totalMakananPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Makanan Pending</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $makananPending }}</div>
                    {!! renderStatChange($makananPendingPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Makanan Approved</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $makananApproved }}</div>
                    {!! renderStatChange($makananApprovedPercentage) !!}
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Makanan Rejected</div>
                        <div class="stat-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $makananRejected }}</div>

                    {!! renderStatChange($makananRejectedPercentage) !!}
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
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aktivitasTerbaru as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }}
                                    </td>

                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <span
                                            class="status-badge {{ $item->status === 'approved'
                                                ? 'status-approved'
                                                : ($item->status === 'rejected'
                                                    ? 'status-rejected'
                                                    : 'status-pending') }}">{{ $item->status }}</span>
                                    </td>
                                    {{-- <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-view">Detail</button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
