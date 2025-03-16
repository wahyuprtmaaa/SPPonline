<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $table = 'biayas';
    protected $fillable = ['nama_biaya', 'jumlah', 'status'];

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'biaya_id');
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
