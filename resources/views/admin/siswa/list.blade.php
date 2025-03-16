<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr class="text-center">
            <th>No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Profile</th>
            <th>Kelas</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswas as $key => $siswa)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $siswa->nisn }}</td>
            <td class="text-center">{{ $siswa->nis }}</td>
            <td>
                <strong>Nama: {{ $siswa->nama }} </strong><br>
                <small><b>Wali:</b> {{ $siswa->wali->name ?? '-' }}</small>
            </td>
            <td class="text-center">{{ $siswa->kelas->nama }}</td>
            <td class="text-center">{{ $siswa->telepon }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item detail-btn"
                                data-bs-toggle="modal" data-bs-target="#detailSiswaModal"
                                data-nama="{{ $siswa->nama }}"
                                data-nisn="{{ $siswa->nisn }}"
                                data-nis="{{ $siswa->nis }}"
                                data-kelas="{{ $siswa->kelas->nama }}"
                                data-alamat="{{ $siswa->alamat }}"
                                data-telepon="{{ $siswa->telepon }}"
                                data-wali="{{ $siswa->wali->name ?? '-' }}"
                                data-foto="{{ $siswa->foto ? asset('storage/profiles/' . $siswa->foto) : asset('storage/uploads/profiles/avatar.png') }}">
                                Detail
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item edit-btn" data-id="{{ $siswa->id }}" data-bs-toggle="modal" data-bs-target="#editSiswaModal">
                                Edit
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $siswas->links() }}

<div class="modal fade" id="detailSiswaModal" tabindex="-1" aria-labelledby="detailSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailSiswaModalLabel"><i class="bi bi-person-circle"></i> Detail Siswa</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img id="modalFoto" src="" alt="Foto Siswa" class="img-fluid rounded-circle border shadow-sm ms-5" width="150">
                        <h5 class="mt-3" id="modalNama"></h5>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <table class="table">
                                <tr>
                                    <td><strong><i class="bi bi-card-list"></i> NISN</strong></td>
                                    <td>:</td>
                                    <td><span id="modalNisn"></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-credit-card"></i> NIS</strong></td>
                                    <td>:</td>
                                    <td><span id="modalNis"></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-house-door"></i> Kelas</strong></td>
                                    <td>:</td>
                                    <td><span id="modalKelas"></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-geo-alt"></i> Alamat</strong></td>
                                    <td>:</td>
                                    <td><span id="modalAlamat"></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-telephone"></i> Telepon</strong></td>
                                    <td>:</td>
                                    <td><span id="modalTelepon"></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-person"></i> Wali</strong></td>
                                    <td>:</td>
                                    <td><span id="modalWali"></span></td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>


