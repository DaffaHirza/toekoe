<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{

    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'image',
        'kondisi',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'produk_id');
    }

    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getIsBaruAttribute()
    {
        return $this->kondisi === 'baru';
    }

    public function getIsBekasAttribute()
    {
        return $this->kondisi === 'bekas';
    }

    public function scopeBaru($query)
    {
        return $query->where('kondisi', 'baru');
    }
}
