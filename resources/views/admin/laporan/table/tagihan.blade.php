<table class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th>#</th>
            <th>Nama Siswa</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($tagihans as $tagihan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tagihan->siswa->nama }}</td>
            <td>Rp {{ number_format($tagihan->biaya->jumlah, 0, ',', '.') }}</td>
            <td>
                @switch($tagihan->status)
                    @case(0) ⏳ Belum Dibayar @break
                    @case(1) 🔄 Pending @break
                    @case(2) ✅ Dikonfirmasi @break
                    @case(3) ❌ Ditolak @break
                @endswitch
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
