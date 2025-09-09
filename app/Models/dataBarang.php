<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KatBarang;

class DataBarang extends Model
{
    protected $table = 'databarang';
    public $timestamps = false;

    // Kolom yang bisa diisi mass assignment

    protected $fillable = [
        'kodebarang',
        'namabarang',
        'kategori_id',
        'satuan',
        'hargabeli',
        'hargajual1',
        'hargajual2',
        'hargajual3',
    ];

    public function kategori()
    {
        // relasi ke tabel katbarang
        return $this->belongsTo(KatBarang::class, 'kategori_id', 'id');
    }
}
