<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';
    protected $fillable = ['siswa_id', 'biaya_id', 'jumlah', 'tanggal_jatuh_tempo', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'biaya_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'tagihan_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            0 => 'Belum Lunas',
            1 => 'Lunas',
            default => 'Unknown',
        };
    }
}
