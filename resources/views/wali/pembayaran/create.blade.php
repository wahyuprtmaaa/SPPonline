@extends('wali.layouts.app')

@section('content')
<div class="card">
    <h3 class="card-header bg-primary text-center text-white">Form Pembayaran</h3>
    <div class="card-body">
        <form action="{{ route('wali.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tagihan_id" value="{{ $tagihan->id }}">
            <input type="hidden" name="jumlah_dibayar" value="{{ $tagihan->jumlah }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Siswa</label>
                        <input type="text" class="form-control bg-light" value="{{ $tagihan->siswa->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jumlah Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary text-white">Rp</span>
                            <input type="text" class="form-control bg-light fw-bold text-danger fs-5"
                                value="{{ number_format($tagihan->jumlah, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Rekening Pengirim</label>
                        <input type="text" name="nama_rekening_pengirim" class="form-control" required placeholder="Masukkan nama pemilik rekening">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Rekening Pengirim</label>
                        <input type="text" name="no_rekening_pengirim" class="form-control" required placeholder="Masukkan nomor rekening">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Rekening Tujuan</label>
                        <select name="rekening_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Rekening Tujuan</option>
                            @foreach($rekenings as $rekening)
                            <option value="{{ $rekening->id }}">{{ $rekening->bank }} - {{ $rekening->nomor_rekening }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Bukti Transfer</label>
                        <input type="file" name="bukti_bayar" class="form-control" id="buktiBayar" required onchange="previewImage(event)">
                        <div class="mt-2">
                            <img id="preview" src="" class="img-thumbnail d-none" width="200">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg w-10">Kirim Pembayaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
