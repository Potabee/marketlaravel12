<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataBarang;

class KatBarang extends Model
{
    use HasFactory;

    // Nama tabel (kalau beda dengan plural dari model)
    protected $table = 'katbarang';
    public $timestamps = false;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'kategoribarang',
    ];

    /**
     * Relasi ke DataBarang (satu kategori bisa punya banyak barang)
     */
    public function dataBarang()
    {
        return $this->hasMany(DataBarang::class, 'kategori_id', 'id');
    }
}
