<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tagihan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Laporan Tagihan</h2>

    @if(request('start_date') && request('end_date'))
        <p><strong>Periode:</strong> {{ request('start_date') }} - {{ request('end_date') }}</p>
    @else
        <p><strong>Periode:</strong> Semua Data</p>
    @endif

    @if(request('status') !== null)
        <p><strong>Status:</strong>
            @switch(request('status'))
                @case(0) ⏳ Belum Dibayar @break
                @case(1) 🔄 Pending @break
                @case(2) ✅ Dikonfirmasi @break
                @case(3) ❌ Ditolak @break
            @endswitch
        </p>
    @else
        <p><strong>Status:</strong> Semua Status</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Nama Wali</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihans as $tagihan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tagihan->siswa->nama }}</td>
                    <td>{{ $tagihan->siswa->wali->name }}</td>
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

</body>
</html>
