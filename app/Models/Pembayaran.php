<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $fillable = ['tagihan_id', 'user_id', 'rekening_id', 'jumlah_dibayar', 'tanggal_bayar', 'bukti_bayar', 'status', 'nama_rekening_pengirim', 'no_rekening_pengirim'];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    public function wali()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOneThrough(Siswa::class, Tagihan::class, 'id', 'id', 'tagihan_id', 'siswa_id');
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'rekening_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            0 => 'Belum Dibayar',
            1 => 'Menunggu Konfirmasi',
            2 => 'Dikonfirmasi',
            3 => 'Ditolak',
            default => 'Unknown',
        };
    }


}
