@extends('wali.layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="fw-bold">
                    <marquee behavior="scroll" direction="left">🏫 SMK JANDA JAYA</marquee>
                </h2>
                <p class="mb-0">Membangun Generasi Unggul & Berdaya Saing</p>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="text-center mb-4">
                    <h4 class="fw-bold">Selamat Datang di Dashboard Wali Murid</h4>
                    <p class="text-muted">Akses informasi pembayaran, riwayat transaksi, dan perkembangan siswa dengan mudah.</p>
                </div>

                <div class="row">
                    <!-- Info Sekolah -->
                    <div class="col-md-6">
                        <div class="card border-primary shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">📌 Informasi Sekolah</div>
                            <div class="card-body">
                                <p><strong>🏫 Nama:</strong> SMK Janda Jaya</p>
                                <p><strong>📍 Alamat:</strong> Jl. Pendidikan No. 123, Jakarta</p>
                                <p><strong>📞 Kontak:</strong> 0812-3456-7890</p>
                                <p><strong>🌐 Website:</strong> <a href="#" class="text-primary">www.smkjandajaya.sch.id</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Fitur Dashboard -->
                    <div class="col-md-6">
                        <div class="card border-success shadow-sm">
                            <div class="card-header bg-success text-white fw-bold">🛠️ Fitur Dashboard</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">📜 <strong>Riwayat Pembayaran</strong></li>
                                    <li class="list-group-item">💰 <strong>Konfirmasi Pembayaran</strong></li>
                                    <li class="list-group-item">📄 <strong>Cetak Invoice</strong></li>
                                    <li class="list-group-item">📊 <strong>Perkembangan Akademik</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
