@extends('admin.layouts.app')

@section('title', 'Wali Murid')
@section('content')
<div class="card">
    <h3 class="card-header bg-primary text-white text-center">Daftar Wali Murid</h3>
    <div class="card-body">
        <div class="d-flex justify-content mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWaliModal">+ Tambah Wali</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wali as $index => $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $data->foto ? asset('storage/profiles/' . $data->foto) : asset('storage/uploads/profiles/avatar.png') }}" alt="Foto" width="80" class="img-thumbnail">
                        </td>

                        <td>{{ $data->name }}</td>
                        <td>{{ $data->alamat ?? '-' }}</td>
                        <td>{{ $data->telepon ?? '-' }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editWaliModal{{ $data->id }}">
                                <i class="fa-solid fa-pen"></i> Edit
                            </button>
                            <form method="POST" action="{{ route('admin.wali.destroy', $data->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editWaliModal{{ $data->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Edit Wali Murid</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.wali.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Password (Opsional)</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" name="telepon" class="form-control" value="{{ $data->telepon }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-warning">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
        {{ $wali->links() }}
    </div>
</div>
<div class="modal fade" id="createWaliModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Wali Murid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.wali.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
