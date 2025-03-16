@extends('operator.layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Daftar Pembayaran</h4>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Pembayaran</th>
                        <th>penerima</th>
                        <th>Tanggal Bayar</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembayaran->tagihan->siswa->nama ?? '-' }}</td>
                        <td>
                            {{ $pembayaran->tagihan->biaya->nama_biaya }}
                            {{--  <strong>Nama : {{ $pembayaran->nama_rekening_pengirim ?? '-' }}</strong>
                            <br>
                            <small><b>No Rek : </b> {{ $pembayaran->no_rekening_pengirim }}</small>  --}}
                        </td>
                        <td>
                            <strong>{{ $pembayaran->rekening->nama_rekening ?? '-' }}</strong><br>
                            <small> <b>Nominal : </b> Rp {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}</td>
                        <td>
                            @if($pembayaran->bukti_bayar)
                                <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                            @endif
                        </td>
                        <td>
                            <span class="badge
                                @if($pembayaran->status == 0) bg-secondary
                                @elseif($pembayaran->status == 1) bg-warning
                                @elseif($pembayaran->status == 2) bg-success
                                @elseif($pembayaran->status == 3) bg-danger
                                @endif">
                                @switch($pembayaran->status)
                                    @case(0) ⏳ Belum Dibayar @break
                                    @case(1) 🔄 Pending @break
                                    @case(2) ✅ Dikonfirmasi @break
                                    @case(3) ❌ Ditolak @break
                                @endswitch
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-sm btn-light border dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <li>
                                            <a class="dropdown-item" href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#detailModal"
                                               data-id="{{ $pembayaran->id }}"
                                               data-nama="{{ $pembayaran->tagihan->siswa->nama ?? '-' }}"
                                               data-tanggal="{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}"
                                               data-jumlah="Rp {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}"
                                               data-status="{{ $pembayaran->status }}"
                                               data-keterangan="{{ $pembayaran->keterangan ?? '-' }}"
                                               data-rekening-tujuan="{{ $pembayaran->rekening->nama_rekening ?? '-' }}"
                                               data-rekening-pengirim="{{ $pembayaran->nama_rekening_pengirim ?? '-' }}"
                                               data-no-rekening-pengirim="{{ $pembayaran->no_rekening_pengirim ?? '-' }}"
                                               data-bukti-bayar="{{ $pembayaran->bukti_bayar }}"
                                               onclick="fillModal(this)">
                                               <i class="fa fa-eye"></i> Lihat Detail
                                            </a>
                                        </li>
                                    </li>
                                    @if($pembayaran->status < 2)
                                        <li>
                                            <form action="{{ route('operator.pembayaran.updateStatus', $pembayaran->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if($pembayaran->status == 0)
                                                    <button class="dropdown-item" type="submit" name="status" value="1">
                                                        <i class="fa fa-hourglass-half"></i> Pending
                                                    </button>
                                                @endif
                                                @if($pembayaran->status == 1)
                                                    <button class="dropdown-item" type="submit" name="status" value="2">
                                                        <i class="fa fa-check"></i> Dikonfirmasi
                                                    </button>
                                                    <button class="dropdown-item text-danger" type="button" onclick="showRejectModal({{ $pembayaran->id }})">
                                                        <i class="fa fa-times"></i> Ditolak
                                                    </button>
                                                @endif
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header text-white" style="background: linear-gradient(45deg, #007bff, #6610f2);">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fa-solid fa-file-invoice">
                    </i>
                    <b> Detail Pembayaran </b>
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <p class="mb-1 text-muted">ID Pembayaran</p>
                                <h6 id="modal-id" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">Nama Siswa</p>
                                <h6 id="modal-nama" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">Tanggal Bayar</p>
                                <h6 id="modal-tanggal" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">Jumlah Dibayar</p>
                                <h6 id="modal-jumlah" class="fw-bold text-success">-</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <p class="mb-1 text-muted">Rekening Tujuan</p>
                                <h6 id="modal-rekening-tujuan" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">Rekening Pengirim</p>
                                <h6 id="modal-rekening-pengirim" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">No. Rekening Pengirim</p>
                                <h6 id="modal-no-rekening-pengirim" class="fw-bold">-</h6>
                                <p class="mb-1 text-muted">Status</p>
                                <h6 id="modal-status" class="fw-bold badge bg-primary">-</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <p class="mb-1 text-muted">Keterangan</p>
                                <p id="modal-keterangan" class="fw-bold">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-10 text-center">
                        <label class="form-label fw-bold text-muted">Bukti Pembayaran</label>
                        <div id="modal-bukti" class="rounded shadow-sm overflow-hidden">
                            <img src="#" id="modal-bukti-img" class="img-fluid rounded" alt="Bukti Pembayaran" style="max-width: 100%; height: auto;">
                            <a href="#" id="modal-bukti-link" class="btn btn-outline-primary mt-2" target="_blank">Lihat Full Size</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Tolak Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" id="reject-id" name="id">
                    <input type="hidden" name="status" value="3">
                    <div class="mb-3">
                        <label for="reject-keterangan">Keterangan Penolakan</label>
                        <textarea class="form-control" id="reject-keterangan" name="keterangan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fillModal(button) {
        const data = {
            id: button.getAttribute('data-id'),
            nama: button.getAttribute('data-nama'),
            tanggal: button.getAttribute('data-tanggal'),
            jumlah: button.getAttribute('data-jumlah'),
            keterangan: button.getAttribute('data-keterangan'),
            rekeningTujuan: button.getAttribute('data-rekening-tujuan'),
            rekeningPengirim: button.getAttribute('data-rekening-pengirim'),
            noRekeningPengirim: button.getAttribute('data-no-rekening-pengirim'),
            status: button.getAttribute('data-status'),
            buktiBayar: button.getAttribute('data-bukti-bayar'),
        };

        // Fill text data
        document.getElementById('modal-id').innerText = data.id;
        document.getElementById('modal-nama').innerText = data.nama;
        document.getElementById('modal-tanggal').innerText = data.tanggal;
        document.getElementById('modal-jumlah').innerText = data.jumlah;
        document.getElementById('modal-keterangan').innerText = data.keterangan;
        document.getElementById('modal-rekening-tujuan').innerText = data.rekeningTujuan;
        document.getElementById('modal-rekening-pengirim').innerText = data.rekeningPengirim;
        document.getElementById('modal-no-rekening-pengirim').innerText = data.noRekeningPengirim;

        // Fill status
        const statusBadge = document.getElementById('modal-status');
        statusBadge.classList.remove('bg-secondary', 'bg-warning', 'bg-success', 'bg-danger');
        switch (data.status) {
            case '0':
                statusBadge.classList.add('bg-secondary');
                statusBadge.innerText = '⏳ Belum Dibayar';
                break;
            case '1':
                statusBadge.classList.add('bg-warning');
                statusBadge.innerText = '🔄 Pending';
                break;
            case '2':
                statusBadge.classList.add('bg-success');
                statusBadge.innerText = '✅ Dikonfirmasi';
                break;
            case '3':
                statusBadge.classList.add('bg-danger');
                statusBadge.innerText = '❌ Ditolak';
                break;
        }

        // Fill bukti bayar
        const buktiImg = document.getElementById('modal-bukti-img');
        const buktiLink = document.getElementById('modal-bukti-link');
        const buktiContainer = document.getElementById('modal-bukti');

        if (data.buktiBayar) {
            buktiImg.src = `{{ asset('storage') }}/${data.buktiBayar}`;
            buktiLink.href = `{{ asset('storage') }}/${data.buktiBayar}`;
            buktiContainer.style.display = 'block';
        } else {
            buktiContainer.style.display = 'none';
        }
    }

    function showRejectModal(id) {
    if (confirm("Apakah Anda yakin ingin menolak pembayaran ini?")) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/operator/pembayaran/updateStatus/' + id;

        let csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        let method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PATCH';
        form.appendChild(method);

        let status = document.createElement('input');
        status.type = 'hidden';
        status.name = 'status';
        status.value = '3';
        form.appendChild(status);

        document.body.appendChild(form);
        form.submit();
    }
}

    function showRejectModal(id) {
        document.getElementById('reject-id').value = id;
        document.getElementById('rejectForm').action = `/operator/pembayaran/${id}/update-status`;
        new bootstrap.Modal(document.getElementById('rejectModal')).show();
    }
</script>
@endsection
