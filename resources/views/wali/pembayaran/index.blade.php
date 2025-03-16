@extends('wali.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                @if($tagihans->isNotEmpty() && $tagihans->first()->siswa)
                    @php
                        $foto = $tagihans->first()->siswa->foto
                            ? asset('storage/profiles/' . $tagihans->first()->siswa->foto)
                            : asset('storage/uploads/profiles/avatar.png');
                    @endphp
                    <img src="{{ $foto }}" class="img-fluid rounded-circle" alt="Foto Siswa">
                @else
                    <img src="{{ asset('storage/uploads/profiles/avatar.png') }}"
                        class="img-fluid rounded-circle" alt="Foto Default">
                @endif
            </div>
            <div class="col-md-9">
                @php
                    $siswa = $tagihans->isNotEmpty() ? $tagihans->first()->siswa : App\Models\Siswa::where('user_id', Auth::id())->with(['kelas', 'wali'])->first();
                @endphp

                @if($siswa)
                    <div class="bg-light p-3 rounded">
                        <h5 class="fw-bold mb-3">Informasi Siswa</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-grid">
                                    <div>Nama</div><div>:</div><div>{{ $siswa->nama }}</div>
                                    <div>NIS</div><div>:</div><div>{{ $siswa->nis ?? '-' }}</div>
                                    <div>NISN</div><div>:</div><div>{{ $siswa->nisn ?? '-' }}</div>
                                    <div>Kelas</div><div>:</div><div>{{ $siswa->kelas->nama ?? '-' }}</div>
                                    <div>Alamat</div><div>:</div><div>{{ $siswa->alamat }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-grid">
                                    <div>Telepon</div><div>:</div><div>{{ $siswa->telepon }}</div>
                                    <div>Email</div><div>:</div><div>{{ $siswa->wali->email ?? '-' }}</div>
                                    <div>Wali</div><div>:</div><div>{{ $siswa->wali->name ?? '-' }}</div>
                                    <div>Telepon Wali</div><div>:</div><div>{{ $siswa->wali->telepon ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <h5>Data siswa tidak ditemukan</h5>
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                <h4 class="card-title mt-4">Daftar Tagihan</h4>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Jenis</th>
                            <th>Jumlah Tagihan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tagihans->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada Tagihan</td>
                            </tr>
                        @else
                            @foreach($tagihans as $tagihan)
                                @if($tagihan->siswa)
                                    <tr>
                                        <td>{{ $tagihan->siswa->nama }}</td>
                                        <td>{{ $tagihan->biaya->nama_biaya ?? 'Tidak ada data' }}</td>
                                        <td>Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-white">
                                            @if($tagihan->status == 0)
                                                <span class="badge bg-warning">Belum Dibayar</span>
                                            @elseif($tagihan->status == 1)
                                                <span class="badge bg-info">Menunggu Konfirmasi</span>
                                            @elseif($tagihan->status == 2)
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif($tagihan->status == 3)
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('wali.pembayaran.create', $tagihan->id) }}"
                                                class="btn btn-primary btn-sm">Bayar</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="mt-4">
                    <h5>Keterangan Pembayaran:</h5>
                    <p>Pembayaran bisa dilakukan dengan cara langsung ke Operator sekolah, atau di transfer melalui bank milik sekolah.</p>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Jangan melakukan transfer ke rekening selain dari rekening yang sudah tertera.</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
