@extends('operator.layouts.app')

@section('content')
<div class="card">
    <h2 class="card-header text-center bg-primary text-white">
        <marquee behavior="scroll" direction="left">SMK JANDA JAYA</marquee>
    </h2>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Tagihan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTagihan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pemasukan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalPembayaran, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tagihan Tertunda</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPembayaranPending }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Transaksi Online Terbaru</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Jenis</th>
                            <th>Jumlah Dibayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $transaksi)
                            <tr>
                                <td>{{ $transaksi->tagihan->siswa->nama }}</td>
                                <td>{{ $transaksi->tagihan->biaya->nama_biaya }}</td>
                                <td>Rp {{ number_format($transaksi->jumlah_dibayar, 0, ',', '.') }}</td>
                                <td>{{ $transaksi->tanggal_bayar }}</td>
                                <td>
                                    <span class="badge
                                    @if($transaksi->status == 0) bg-secondary
                                    @elseif($transaksi->status == 1) bg-warning
                                    @elseif($transaksi->status == 2) bg-success
                                    @elseif($transaksi->status == 3) bg-danger
                                    @endif">
                                    @if($transaksi->status == 0) ⏳ Belum Dibayar
                                    @elseif($transaksi->status == 1) 🔄 Menunggu Konfirmasi
                                    @elseif($transaksi->status == 2) ✅ Dikonfirmasi
                                    @elseif($transaksi->status == 3) ❌ Ditolak
                                    @endif
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada transaksi terbaru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
