@extends('wali.layouts.app')

@section('content')
<div class="card">
    <h2 class="card-header bg-primary text-white">Riwayat Pembayaran</h2>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>NISN</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Bukti Pembayaran</th>
                    @if($pembayarans->contains('status', 2))
                        <th>Cetak Invoice</th>
                    @endif
                    @if($pembayarans->contains('status', 3))
                        <th>Keterangan</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $pembayaran)
                <tr class="text-center">
                    <td>{{ $pembayaran->tagihan->siswa->nama }}</td>
                    <td>{{ $pembayaran->tagihan->siswa->kelas->nama }}</td>
                    <td>{{ $pembayaran->tagihan->siswa->nisn }}</td>
                    <td>
                        <strong> {{ $pembayaran->tagihan->biaya->nama_biaya }}</strong> <br>
                        Rp {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}

                    </td>
                    <td>{{ date('d M Y', strtotime($pembayaran->tanggal_bayar)) }}</td>
                    <td class="text-white">
                        @if($pembayaran->status == 0)
                            <span class="badge bg-warning">Belum Dibayar</span>
                        @elseif($pembayaran->status == 1)
                            <span class="badge bg-info">Menunggu Konfirmasi</span>
                        @elseif($pembayaran->status == 2)
                            <span class="badge bg-success">Lunas</span>
                        @elseif($pembayaran->status == 3)
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank">Lihat</a>
                    </td>
                    @if($pembayarans->contains('status', 2))
                        <td>
                            @if($pembayaran->status == 2)
                                <a class="btn btn-primary" href="{{ route('wali.pembayaran.invoice', $pembayaran->id) }}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-print"></i></a>
                            @endif
                        </td>
                    @endif
                    @if($pembayarans->contains('status', 3))
                        <td>
                            @if($pembayaran->status == 3)
                                {{ $pembayaran->keterangan }}
                            @endif
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
