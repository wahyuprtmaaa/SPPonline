@extends('admin.layouts.app')

@section('title', 'Tambah Tagihan')
@section('content')
<div class="card">
    <h2 class="card-header bg-primary text-white">Tambah Tagihan</h2>
    <div class="card-body">
        <div class="container">
            <form action="{{ route('admin.tagihan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Jenis Biaya</label>
                    <select name="biaya_id" class="form-control" required>
                        <option value="">-- Pilih Biaya --</option>
                        @forelse($biayas as $biaya)
                            <option value="{{ $biaya->id }}">{{ $biaya->nama_biaya }} - Rp{{ number_format($biaya->jumlah, 0, ',', '.') }}</option>
                        @empty
                            <option value="">Tidak ada biaya tersedia</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan Tagihan</button>
            </form>
        </div>
    </div>
</div>
@endsection
