@extends('operator.layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-4">Daftar Tagihan</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
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
                        @if($tagihan->status == 0)
                            <div class="dropdown">
                                <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="statusDropdown{{ $tagihan->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    🔄 Pending
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $tagihan->id }}">
                                    <li>
                                        <form method="POST" action="{{ route('operator.tagihan.updateStatus', $tagihan->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="dropdown-item">✅ Dikonfirmasi</button>
                                        </form>
                                    </li>
                                    {{--  <li>
                                        <form method="POST" action="{{ route('operator.tagihan.updateStatus', $tagihan->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="3">
                                            <button type="submit" class="dropdown-item text-danger">❌ Ditolak</button>
                                        </form>
                                    </li>  --}}
                                </ul>
                            </div>
                        @else
                            <span class="badge
                                @if($tagihan->status == 0) bg-secondary
                                @elseif($tagihan->status == 2) bg-success
                                @elseif($tagihan->status == 3) bg-danger
                                @endif">
                                @switch($tagihan->status)
                                    @case(0) ⏳ Belum Dibayar @break
                                    @case(2) ✅ Dikonfirmasi @break
                                    @case(3) ❌ Ditolak @break
                                @endswitch
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        {{ $tagihans->links() }}
    </div>
</div>
@endsection
