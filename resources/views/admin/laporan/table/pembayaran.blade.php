<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nama Siswa</th>
            <th>Jumlah Dibayar</th>
            <th>Tanggal Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayarans as $pembayaran)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><b>Siswa : </b> {{ $pembayaran->siswa->nama ?? '-' }} <br>
                <b>Wali : </b> {{ $pembayaran->wali->name }}

            </td>
            <td>Rp {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</td>
            <td>{{ $pembayaran->tanggal_bayar }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
