<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $table = 'rekenings';
    protected $fillable = ['nama_rekening', 'bank', 'nomor_rekening', 'status'];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'rekening_id');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            0 => 'Tidak Aktif',
            1 => 'Aktif',
            default => 'Unknown',
        };
    }
}
