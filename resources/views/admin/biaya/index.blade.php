@extends('admin.layouts.app')

@section('title', 'Daftar Biaya')
@section('content')
<div class="card">
    <h1 class="card-header bg-primary text-white">Daftar Biaya</h1>
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBiayaModal">Tambah Biaya</button>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Biaya</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biayas as $biaya)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $biaya->nama_biaya }}</td>
                    <td>Rp{{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                    <td>
                        @if($biaya->status == 0)
                        <span class="badge bg-warning">Nonaktif</span>
                        @else
                        <span class="badge bg-success">Aktif</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-id="{{ $biaya->id }}"
                            data-nama="{{ $biaya->nama_biaya }}"
                            data-jumlah="{{ $biaya->jumlah }}"
                            data-status="{{ $biaya->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editBiayaModal">
                            Edit
                        </button>
                        <form action="{{ route('admin.biaya.destroy', $biaya->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="tambahBiayaModal" tabindex="-1" aria-labelledby="tambahBiayaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahBiayaModalLabel">Tambah Biaya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.biaya.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Biaya</label>
                        <input type="text" name="nama_biaya" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editBiayaModal" tabindex="-1" aria-labelledby="editBiayaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editBiayaModalLabel">Edit Biaya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBiayaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Biaya</label>
                        <input type="text" name="nama_biaya" id="edit_nama_biaya" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
