@extends('admin.layouts.app')

@section('title', 'Daftar Rekening')
@section('content')
<div class="card">
    <h1 class="card-header bg-primary text-white">Daftar Rekening</h1>
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahRekeningModal">Tambah Rekening</button>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Atas Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekenings as $rekening)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekening->bank }}</td>
                    <td>{{ $rekening->nomor_rekening }}</td>
                    <td>{{ $rekening->nama_rekening }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRekeningModal{{ $rekening->id }}">Edit</button>
                        <form action="{{ route('admin.rekening.destroy', $rekening->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editRekeningModal{{ $rekening->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Edit Rekening</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.rekening.update', $rekening->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Bank</label>
                                        <input type="text" name="bank" class="form-control" value="{{ $rekening->bank }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Rekening</label>
                                        <input type="text" name="nomor_rekening" class="form-control" value="{{ $rekening->nomor_rekening }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Atas Nama</label>
                                        <input type="text" name="nama_rekening" class="form-control" value="{{ $rekening->nama_rekening }}" required>
                                    </div>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahRekeningModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white  ">
                <h5 class="modal-title">Tambah Rekening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.rekening.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Bank</label>
                        <input type="text" name="bank" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" name="nama_rekening" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
