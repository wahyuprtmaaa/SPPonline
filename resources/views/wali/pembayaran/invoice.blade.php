<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <title>Invoice</title>
  <link rel="stylesheet" href="/invoice//css/style.css">
</head>
<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type3" id="tm_download_section">
        <div class="tm_shape_1">
          <svg width="850" height="151" viewBox="0 0 850 151" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M850 0.889398H0V150.889H184.505C216.239 150.889 246.673 141.531 269.113 124.872L359.112 58.0565C381.553 41.3977 411.987 32.0391 443.721 32.0391H850V0.889398Z" fill="#007AFF" fill-opacity="0.1"/>
          </svg>
        </div>
        <div class="tm_shape_2">
          <svg width="850" height="151" viewBox="0 0 850 151" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 150.889H850V0.889408H665.496C633.762 0.889408 603.327 10.2481 580.887 26.9081L490.888 93.7224C468.447 110.381 438.014 119.74 406.279 119.74H0V150.889Z" fill="#007AFF" fill-opacity="0.1"/>
          </svg>
        </div>
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_align_center tm_mb20">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="/dist/img/tutwuri.png" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <div class="tm_primary_color tm_f50 tm_text_uppercase">Invoice</div>
            </div>
          </div>
          <div class="tm_invoice_info tm_mb20">
            <div class="tm_invoice_seperator">
              <img src="assets/img/arrow_bg.svg" alt="">
            </div>
            <div class="tm_invoice_info_list">
              <p class="tm_invoice_number tm_m0">No Invoice: <b class="tm_primary_color"> INV-{{ $pembayaran->id }}</b></p>
              <p class="tm_invoice_date tm_m0">Tanggal: <b class="tm_primary_color">{{ $pembayaran->tanggal_bayar }}</b></p>
              <div class="tm_invoice_info_list_bg tm_accent_bg_10"></div>
            </div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Siswa:</b></p>
              <p>
                {{ $pembayaran->tagihan->siswa->nama }} <br>
                {{ $pembayaran->tagihan->siswa->kelas->nama }} <br>
                lowell@gmail.com
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <b>
                SMK JANDA JAYA <br>
                86-90 Paul Street, London<br>
                Jandajaya@gmail.com
              </b>
            </div>
          </div>
          <div class="tm_table tm_style1 tm_mb30">
            <div class="tm_table_responsive">
              <table class="tm_border_bottom">
                <thead>
                  <tr class="tm_border_top">
                    <th class="tm_width_3 tm_semi_bold tm_primary_color tm_accent_bg_10">Pembayaran</th>
                    <th class="tm_width_4 tm_semi_bold tm_primary_color tm_accent_bg_10">Nama Rek Pengirim</th>
                    <th class="tm_width_2 tm_semi_bold tm_primary_color tm_accent_bg_10">No Rek</th>
                    <th class="tm_width_1 tm_semi_bold tm_primary_color tm_accent_bg_10">Jumlah</th>
                    <th class="tm_width_2 tm_semi_bold tm_primary_color tm_accent_bg_10 tm_text_right">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="tm_width_3">{{ $pembayaran->tagihan->biaya->nama_biaya }}</td>
                    <td class="tm_width_4">{{ $pembayaran->nama_rekening_pengirim }}</td>
                    <td class="tm_width_2">{{ $pembayaran->no_rekening_pengirim }}</td>
                    <td class="tm_width_1">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</td>
                    <td class="tm_width_2 tm_text_right">
                        @if($pembayaran->status == 1)
                        <span class="badge bg-warning">Menunggu Konfirmasi</span>
                        @elseif($pembayaran->status == 2)
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tm_invoice_footer">
              <div class="tm_left_footer">
                <p class="tm_mb2"><b class="tm_primary_color">Penerima:</b></p>
                <p class="tm_m0"> {{ $pembayaran->rekening->bank }}-{{ $pembayaran->rekening->nama_rekening }} <br>No Rek: {{ $pembayaran->rekening->nomor_rekening }}</p>
              </div>
              <div class="tm_right_footer">
                <table>
                  <tbody>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtotal</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</td>
                    </tr>
                    @if($pembayaran->status == 2)
                    <tr>
                      <td colspan="2" class="tm_text_center">
                        <img src="/dist/img/lunas.png" alt="LUNAS" width="150">
                      </td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="/invoice/js/jquery.min.js"></script>
  <script src="/invoice/js/jspdf.min.js"></script>
  <script src="/invoice/js/html2canvas.min.js"></script>
  <script src="/invoice/js/main.js"></script>
</body>
</html>
