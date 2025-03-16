@extends('admin.layouts.app')

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .ttd-admin {
            display: block !important;
        }
    }
    .ttd-admin {
        display: none;
    }
</style>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Cetak Laporan</h2>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <label>Pilih Jenis Laporan:</label>
                    <select name="laporan" id="laporan" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Pilih Laporan --</option>
                        <option value="wali" {{ request('laporan') == 'wali' ? 'selected' : '' }}>Laporan Wali</option>
                        <option value="siswa" {{ request('laporan') == 'siswa' ? 'selected' : '' }}>Laporan Siswa</option>
                        <option value="tagihan" {{ request('laporan') == 'tagihan' ? 'selected' : '' }}>Laporan Tagihan</option>
                        <option value="pembayaran" {{ request('laporan') == 'pembayaran' ? 'selected' : '' }}>Laporan Pembayaran</option>
                    </select>
                </div>
            </div>
        </form>

        @if(request('laporan'))
        <button onclick="printLaporan()" class="btn btn-outline-primary float-end mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" width="20">
                <path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                <circle cx="392" cy="184" r="24" fill='currentColor'/>
            </svg>
            Print Laporan
        </button>
        @endif

        <div class="print-area">
            @if(isset($walis))
                @include('admin.laporan.table.wali')
            @elseif(isset($siswas))
                @include('admin.laporan.table.siswa')
            @elseif(isset($tagihans))
                @include('admin.laporan.table.tagihan')
            @elseif(isset($pembayarans))
                @include('admin.laporan.table.pembayaran')
            @endif

            <div class="ttd-admin" style="margin-top: 50px; text-align: right;">
                <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p><strong>Admin</strong></p>
                <br><br>
                <p>__________________________</p>
                <p>( Nama Admin )</p>
            </div>
        </div>
    </div>
</div>
<script>
function printLaporan() {
    window.print();
}
</script>
<script src="/invoice/js/jquery.min.js"></script>
<script src="/invoice/js/jspdf.min.js"></script>
<script src="/invoice/js/html2canvas.min.js"></script>
<script src="/invoice/js/main.js"></script>

@endsection
