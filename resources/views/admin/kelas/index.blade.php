@extends('admin.layouts.app')

@section('title', 'Daftar Kelas')
@section('content')
<div class="card">
    <h1 class="card-header bg-primary text-white">Daftar Kelas</h1>
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Kelas</button>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $key => $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->kompetensi_keahlian }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit"
                            data-id="{{ $k->id }}"
                            data-nama="{{ $k->nama }}"
                            data-kompetensi="{{ $k->kompetensi_keahlian }}"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit">Edit</button>

                        <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
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

<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCreateLabel">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kelas</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" name="kompetensi_keahlian" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditLabel">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama Kelas</label>
                        <input type="text" id="edit-nama" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-kompetensi" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" id="edit-kompetensi" name="kompetensi_keahlian" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const kompetensi = this.getAttribute('data-kompetensi');

            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-kompetensi').value = kompetensi;

            document.getElementById('formEdit').setAttribute('action', '/admin/kelas/' + id);
        });
    });
});
</script>

@endsection
