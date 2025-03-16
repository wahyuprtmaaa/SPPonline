@extends('admin.layouts.app')

@section('title', 'Daftar Tagihan')
@section('content')
<div class="card">
    <h2 class="card-header bg-primary text-white">Daftar Tagihan</h2>
    <div class="card-body">
        <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary mb-3">Tambah Tagihan</a>

        <div class="row mb-3">
            <div class="col-md-3">
                <select name="status" id="status-filter" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum Dibayar</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Lunas</option>
                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" id="start-date-filter" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <input type="date" id="end-date-filter" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
        </div>

        <table class="table table-bordered table-hover text-center" id="tagihan-table">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa & Wali</th>
                    <th>Nama Biaya</th>
                    <th>Jumlah</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tagihans as $tagihan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>{{ $tagihan->siswa->nama }}</strong><br>
                        <small>Wali: {{ $tagihan->siswa->wali->name }}</small>
                    </td>
                    <td>{{ $tagihan->biaya->nama_biaya }}</td>
                    <td>Rp{{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y', strtotime($tagihan->tanggal_jatuh_tempo)) }}</td>
                    <td>
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
                        <form action="{{ route('admin.tagihan.destroy', $tagihan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada tagihan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $tagihans->links() }}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusFilter = document.getElementById("status-filter");
        const startDateFilter = document.getElementById("start-date-filter");
        const endDateFilter = document.getElementById("end-date-filter");

        function filterData() {
            const status = statusFilter.value;
            const startDate = startDateFilter.value;
            const endDate = endDateFilter.value;
            const urlParams = new URLSearchParams(window.location.search);

            if (status) urlParams.set('status', status);
            else urlParams.delete('status');

            if (startDate) urlParams.set('start_date', startDate);
            else urlParams.delete('start_date');

            if (endDate) urlParams.set('end_date', endDate);
            else urlParams.delete('end_date');

            window.location.search = urlParams.toString();
        }

        statusFilter.addEventListener("change", filterData);
        startDateFilter.addEventListener("change", filterData);
        endDateFilter.addEventListener("change", filterData);
    });
</script>
@endsection
