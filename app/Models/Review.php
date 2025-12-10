<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'produk_id',
        'nama_pengunjung',
        'email',
        'nomor_hp',
        'rating',
        'komentar',
        'provinsi',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
