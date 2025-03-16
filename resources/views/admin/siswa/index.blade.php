@extends('admin.layouts.app')

@section('title', 'Daftar Siswa')
@section('content')
<div class="container-fluid">
    <div class="col-auto d-none d-sm-block">
        <h3>Data Siswa</h3>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <button type="button" class="btn btn-primary mb-3 mx-3" data-bs-toggle="modal" data-bs-target="#tambahSiswaModal">
            Tambah Siswa
        </button>
        <form id="search-form" method="GET" action="{{ route('admin.siswa.index') }}">
            <input type="text" id="search-input" name="search" class="form-control form-control-sm" placeholder="Cari siswa..." value="{{ request('search') }}" style="width: 250px;">
        </form>
    </div>
    <div id="siswa-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.siswa.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalLabel">Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select name="id_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Wali Murid</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">-- Pilih Wali yang Sudah Ada --</option>
                            @foreach ($wali_users as $wali)
                                <option value="{{ $wali->id }}" {{ old('user_id') == $wali->id ? 'selected' : '' }}>
                                    {{ $wali->name }} ({{ $wali->email }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Atau tambahkan wali baru di bawah.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSiswaForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-nisn" class="form-label">NISN</label>
                            <input type="text" id="edit-nisn" name="nisn" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-nis" class="form-label">NIS</label>
                            <input type="text" id="edit-nis" name="nis" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" id="edit-nama" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-id_kelas" class="form-label">Kelas</label>
                            <select id="edit-id_kelas" name="id_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-alamat" class="form-label">Alamat</label>
                            <textarea id="edit-alamat" name="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-telepon" class="form-label">Telepon</label>
                            <input type="text" id="edit-telepon" name="telepon" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-foto" class="form-label">Foto</label>
                            <input type="file" id="edit-foto" name="foto" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-user_id" class="form-label">Wali Murid</label>
                        <select id="edit-user_id" name="user_id" class="form-control">
                            <option value="">-- Pilih Wali yang Sudah Ada --</option>
                            @foreach ($wali_users as $wali)
                                <option value="{{ $wali->id }}">{{ $wali->name }} ({{ $wali->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

