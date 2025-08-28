<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Pengadaan & Peminjaman</title>
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-content">
            <a href="#" class="logo">PLN-NP</a>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#forms">Formulir</a></li>
                <li><a href="#services">Layanan</a></li>
                <li><a href="#process">Proses</a></li>
                <li><a href="{{ route('login') }}" class="cta-nav">Masuk</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Sistem Permintaan Kendaraan Dinas & Makanan</h1>
                <p class="hero-subtitle">
                    Platform digital yang efisien untuk mengelola Permintaan Kendaraan
                    Dinas & Makanan dengan proses yang mudah, cepat, dan transparan
                </p>
                <div class="hero-cta">
                    <a href="#forms" class="btn-primary">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Ajukan Sekarang
                    </a>
                    <a href="#process" class="btn-secondary">Pelajari Proses</a>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Forms Section -->
    <section id="forms" class="forms-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Formulir Pengajuan</h2>
                <p class="section-subtitle">
                    Pilih layanan yang Anda butuhkan dan isi formulir dengan lengkap
                </p>
            </div>

            <div class="menu-selector">
                <button class="menu-btn active" onclick="showForm('food')" id="foodBtn">

                    Permintaan Makanan
                </button>
                <button class="menu-btn" onclick="showForm('vehicle')" id="vehicleBtn">

                    Permintaan Kendaraan
                </button>
            </div>

            <div class="form-container">
                <!-- Form Pengadaan Makanan -->
                <div class="form-section active" id="foodForm">
                    <div class="form-title">Formulir Permintaan Makanan</div>
                    <p class="form-subtitle">
                        Silakan lengkapi informasi berikut untuk mengajukan permintaan
                        pengadaan makanan
                    </p>

                    <div class="success-message" id="foodSuccess">
                        ✓ Permintaan pengadaan makanan berhasil dikirim dan akan segera
                        diproses
                    </div>

                    <form id="foodFormActual" onsubmit="submitFoodForm(event)" enctype="multipart/form-data">

                        <div class="card">
                            <div class="section-title-form">Informasi Pemohon</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" id="nama" name="nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nid">NID <span class="required">*</span></label>
                                    <input type="number" id="nid" name="nid" required />
                                </div>
                                <div class="form-group">
                                    <label for="sub_bidang_id">Sub Bidang <span class="required">*</span></label>
                                    <select id="sub_bidang_id" name="sub_bidang_id" required>
                                        <option value="">-- Pilih Sub Bidang --</option>
                                        @foreach ($subBidang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">Nomor Telepon<span class="required">*</span></label>
                                    <input type="number" id="no_hp" name="no_hp" required />
                                    <small class="form-text text-muted">
                                        Format yang diperbolehkan: harus seperti <strong>081287651209</strong> (dimulai
                                        dengan 0). Tanpa spasi/tanda baca.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="section-title-form">Detail Acara</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="judul_agenda">Judul Agenda <span class="required">*</span></label>
                                    <input type="text" id="judul_agenda" name="judul_agenda" required />
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Acara <span class="required">*</span></label>
                                    <input type="date" id="tanggal" name="tanggal" required />
                                </div>
                                <div class="form-group">
                                    <label for="durasi">Durasi <span class="required">*</span></label>
                                    <select id="durasi" name="durasi" required>
                                        <option value="">-- Pilih Durasi --</option>
                                        @foreach ($durasi as $d)
                                            <option value="{{ $d->id }}"
                                                data-keterangan="{{ $d->keterangan }}">{{ $d->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small id="durasiKeterangan" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah (Orang)
                                        <span class="required">*</span></label>
                                    <input type="number" id="jumlah" name="jumlah" min="1"
                                        placeholder="0" required />
                                </div>


                                <div class="form-group full-width">
                                    <label for="lokasi">Lokasi Acara <span class="required">*</span></label>
                                    <input type="text" id="lokasi" name="lokasi"
                                        placeholder="Contoh: Ruang A" required />
                                </div>
                                <div class="form-group">
                                    <label for="file">Upload File Pendukung</label>
                                    <input type="file" id="file" name="file"
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                                    <small class="form-text">Format yang diperbolehkan: PDF. Maksimal
                                        5MB.</small>
                                </div>
                            </div>
                        </div>

                        <div class="info-box">
                            <strong>Informasi:</strong> Permintaan akan diproses dalam 1-2
                            hari kerja. Tim akan menghubungi Anda untuk konfirmasi detail
                            dan penawaran harga.
                        </div>

                        <button type="submit" class="submit-btn">
                            <svg width="20" height="20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Permintaan
                        </button>
                    </form>
                </div>

                <!-- Form Peminjaman Kendaraan -->
                <div class="form-section" id="vehicleForm">
                    <div class="form-title">Formulir Permintaan Kendaraan Dinas</div>
                    <p class="form-subtitle">
                        Silakan lengkapi informasi berikut untuk mengajukan permintaan
                        peminjaman kendaraan
                    </p>

                    <div class="success-message" id="vehicleSuccess" style="display: none;">
                        ✓ Permintaan peminjaman kendaraan berhasil dikirim dan akan segera
                        diproses
                    </div>

                    <form id="vehicleFormActual" onsubmit="submitVehicleForm(event)" enctype="multipart/form-data">

                        <div class="card">
                            <div class="section-title-form">Informasi Pemohon</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" id="nama" name="nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nid">NID <span class="required">*</span></label>
                                    <input type="number" id="nid" name="nid" required />
                                </div>
                                <div class="form-group">
                                    <label for="sub_bidang_id">Sub Bidang <span class="required">*</span></label>
                                    <select id="sub_bidang_id" name="sub_bidang_id" required>
                                        <option value="">-- Pilih Sub Bidang --</option>
                                        @foreach ($subBidang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Nomor Telepon <span class="required">*</span></label>
                                    <input type="number" id="no_hp" name="no_hp" required />
                                    <small class="form-text text-muted">
                                        Format yang diperbolehkan: harus seperti <strong>081287651209</strong> (dimulai
                                        dengan 0). Tanpa spasi/tanda baca.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="section-title-form">
                                Detail Kendaraan & Perjalanan
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="tanggal_waktu">Tanggal dan Waktu Penjemputan<span
                                            class="required">*</span></label>
                                    <input type="datetime-local" id="tanggal_waktu" name="tanggal_waktu" required />
                                </div>
                                <div class="form-group">
                                    <label for="file">Upload File Pendukung</label>
                                    <input type="file" id="file" name="file"
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                                    <small class="form-text">Format yang diperbolehkan: PDF. Maksimal
                                        5MB.</small>
                                </div>


                                <div class="form-group full-width">
                                    <label for="lokasi_penjemputan">Lokasi Penjemputan <span
                                            class="required">*</span></label>
                                    <input type="text" id="lokasi_penjemputan" name="lokasi_penjemputan"
                                        placeholder="Contoh: Kantor Cabang Jakarta, Bandara Soekarno-Hatta" required />
                                </div>
                                <div class="form-group full-width">
                                    <label for="tujuan">Tujuan Perjalanan <span class="required">*</span></label>
                                    <input type="text" id="tujuan" name="tujuan"
                                        placeholder="Contoh: Kantor Cabang Jakarta, Bandara Soekarno-Hatta" required />
                                </div>
                            </div>
                        </div>


                        <div class="info-box">
                            <strong>Informasi Penting:</strong> Proses dalam 1 - 2 hari.
                        </div>

                        <button type="submit" class="submit-btn">
                            <svg width="20" height="20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Permintaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">
                    Dua layanan utama yang terintegrasi untuk kebutuhan operasional
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="32" height="32" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3>Permintaan Makanan</h3>
                    <p>
                        Layanan komprehensif untuk kebutuhan catering dan konsumsi acara
                        dengan berbagai pilihan menu dan paket.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg width="32" height="32" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3>Permintaan Kendaraan</h3>
                    <p>
                        Solusi transportasi fleksibel dengan berbagai jenis kendaraan
                        untuk keperluan dinas dan operasional.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="process">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Alur Proses Mudah</h2>
                <p class="section-subtitle">
                    Proses yang sederhana dan transparan untuk memastikan pelayanan yang
                    efisien dan tepat waktu
                </p>
            </div>

            <div class="process-steps">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Pengajuan Online</h3>
                    <p>
                        Isi formulir pengajuan secara online dengan detail kebutuhan Anda.
                    </p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Verifikasi & Konfirmasi</h3>
                    <p>
                        Tim akan memverifikasi data Anda dalam 1-2 hari kerja untuk
                        konfirmasi.
                    </p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Persetujuan & Penjadwalan</h3>
                    <p>
                        Setelah menyetujui penawaran, sistem akan menghubungi anda via
                        whatsapp.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Keunggulan Platform</h2>
                <p class="section-subtitle">
                    Fitur-fitur unggulan yang membuat proses pengajuan menjadi lebih
                    efisien dan nyaman
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3>Proses Cepat</h3>
                    <p>
                        Pengajuan dapat diproses dengan cepat tanpa perlu antri atau
                        datang langsung ke kantor.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3>Transparan</h3>
                    <p>
                        Status pengajuan dapat dipantau secara real-time dengan notifikasi
                        otomatis.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>
                        Data pribadi dan informasi pengajuan dijamin aman dengan enkripsi
                        tingkat tinggi.
                    </p>
                </div>

                {{-- <div class="feature-card">
            <div class="feature-icon">
              <svg
                width="24"
                height="24"
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
            <h3>24/7 Akses</h3>
            <p>
              Platform dapat diakses kapan saja dan dimana saja melalui
              perangkat apapun.
            </p>
          </div>

          <div class="feature-card">
            <div class="feature-icon">
              <svg
                width="24"
                height="24"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                />
              </svg>
            </div>
            <h3>Laporan Digital</h3>
            <p>
              Dapatkan laporan dan dokumentasi digital untuk kebutuhan
              administrasi.
            </p>
          </div> --}}

                {{-- <div class="feature-card">
            <div class="feature-icon">
              <svg
                width="24"
                height="24"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"
                />
              </svg>
            </div>
            <h3>Customer Support</h3>
            <p>
              Tim support yang responsif siap membantu Anda jika mengalami
              kendala.
            </p>
          </div> --}}
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="footer">
        <div class="footer-bottom">
            <p>&copy; 2025 PLN Nusantara Power. Semua hak cipta dilindungi.</p>
        </div>
    </footer>

    <script>
        flatpickr("#tanggal", {
            dateFormat: "d/m/Y",
            defaultDate: "28/08/2025", // format dd/mm/yyyy
        });
    </script>
    <script src="{{ asset('landing/script.js') }}"></script>
    <script>
        function submitFoodForm(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            // Tambahkan CSRF ke FormData
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', token);

            fetch('/permintaan-makanan', {
                    method: 'POST',
                    body: formData
                    // Jangan set headers Content-Type manual
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengirim data');
                    return response.json();
                })
                .then(data => {
                    console.log(data);

                    document.getElementById('foodSuccess').style.display = 'block';
                    event.target.reset();
                    document.getElementById("foodForm").scrollIntoView({
                        behavior: "smooth"
                    });

                    setTimeout(() => {
                        document.getElementById('foodSuccess').style.display = 'none';
                    }, 8000);
                })
                .catch(error => alert('Terjadi kesalahan: ' + error.message));
        }


        function submitVehicleForm(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            // Tambahkan CSRF token ke FormData
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', token);

            fetch('/permintaan-kendaraan', {
                    method: 'POST',
                    body: formData, // FormData otomatis menangani file
                    headers: {
                        'Accept': 'application/json' // wajib agar Laravel balas JSON
                        // Jangan set 'Content-Type' karena akan mengacaukan file upload
                    }
                })
                .then(async response => {
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Error HTML:', errorText);
                        alert('Gagal: ' + errorText);
                        throw new Error('Gagal mengirim data');
                    }
                    return response.json();
                })
                .then(data => {
                    const successEl = document.getElementById('vehicleSuccess');
                    if (successEl) {
                        successEl.style.display = 'block';
                        form.reset();

                        document.getElementById("vehicleForm").scrollIntoView({
                            behavior: "smooth"
                        });

                        setTimeout(() => {
                            successEl.style.display = 'none';
                        }, 8000);
                    } else {
                        alert('Elemen #vehicleSuccess tidak ditemukan di halaman!');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan: ' + error.message);
                });
        }

        const selectDurasi = document.getElementById('durasi');
        const keterangan = document.getElementById('durasiKeterangan');

        selectDurasi.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const desc = selectedOption.getAttribute('data-keterangan');
            keterangan.textContent = desc ? 'Keterangan: ' + desc : '';
        });
    </script>
</body>

</html>
